<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.app-final', function ($view) {
            $footerData = [
                'contact' => [
                    'email' => 'info@edubridge.com',
                    'phone' => '(021) 1234-5678',
                    'address' => 'Jakarta, Indonesia'
                ],
                'quickLinks' => [
                    ['title' => 'Kursus', 'url' => '#'],
                    ['title' => 'Pendaftaran', 'url' => '#'],
                    ['title' => 'Tentang Kami', 'url' => route('about')]
                ],
                'description' => 'Platform pembelajaran digital yang menghubungkan siswa dengan mentor terbaik.'
            ];

            $view->with('footerData', $footerData);
        });
    }
}
