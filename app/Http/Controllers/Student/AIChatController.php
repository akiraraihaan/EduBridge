<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google\Cloud\Core\ServiceBuilder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AIChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        try {
            // Set timeout untuk HTTP request
            $timeout = 25; // 25 detik

            // Get chat history from session
            $chatHistory = Session::get('chat_history', []);

            // Add user message to history
            $chatHistory[] = [
                'role' => 'user',
                'content' => $request->message
            ];

            // Prepare context from chat history (last 5 messages)
            $context = array_slice($chatHistory, -5);
            $contextText = "";
            foreach ($context as $message) {
                $role = $message['role'] === 'user' ? 'User' : 'Assistant';
                $contextText .= "$role: " . $message['content'] . "\n";
            }

            // Add current context to the prompt
            $prompt = "Berikut adalah riwayat percakapan sebelumnya:\n\n" .
                     $contextText .
                     "\nBerdasarkan konteks di atas, tolong berikan respons untuk pesan berikut:\n" .
                     $request->message;

            $response = Http::timeout($timeout)->withHeaders([
                'Content-Type' => 'application/json',
                'x-goog-api-key' => config('services.gemini.api_key'),
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent', [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'topK' => 40,
                    'topP' => 0.95,
                    'maxOutputTokens' => 1024,
                ]
            ]);

            if (!$response->successful()) {
                throw new \Exception('Gagal mendapatkan respons dari Gemini API');
            }

            $aiResponse = $response->json();

            if (isset($aiResponse['candidates'][0]['content']['parts'][0]['text'])) {
                $aiMessage = $aiResponse['candidates'][0]['content']['parts'][0]['text'];

                // Add AI response to history
                $chatHistory[] = [
                    'role' => 'assistant',
                    'content' => $aiMessage
                ];

                // Store updated history in session (keep last 10 messages)
                Session::put('chat_history', array_slice($chatHistory, -10));

                return response()->json([
                    'success' => true,
                    'message' => $aiMessage
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat memproses respons dari AI'
            ], 500);

        } catch (\Exception $e) {
            \Log::error('AI Chat Error: ' . $e->getMessage());

            $errorMessage = 'Terjadi kesalahan: ';
            if ($e instanceof \Illuminate\Http\Client\ConnectionException) {
                $errorMessage .= 'Gagal terhubung ke server AI. Mohon coba lagi.';
            } else {
                $errorMessage .= $e->getMessage();
            }

            return response()->json([
                'success' => false,
                'message' => $errorMessage
            ], 500);
        }
    }

    public function getChatHistory()
    {
        return response()->json([
            'success' => true,
            'history' => Session::get('chat_history', [])
        ]);
    }
}
