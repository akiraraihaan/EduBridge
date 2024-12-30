<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function welcoming(){
        $requirements = [
            [
                'img' => '/img/req-1.png',
                'statement' => 'Kursus yang mengingkatkan kemampuan untuk bekerja',
                'requirement' => 'Usia 17 - 30 tahun'
            ],
            [
                'img' => '/img/req-2.png',
                'statement' => 'Menjadi pengganti pendidikan formal bagi yang belum berkesempatan',
                'requirement' => 'Tidak sedang menempuh pendidikan formal'
            ],
            [
                'img' => '/img/req-3.png',
                'statement' => 'Tidak membatasi domisili geografis (daerah)',
                'requirement' => 'Berdomisili di Indonesia'
            ]
        ];

        $definition = "Platform digital penyedia kursus dalam bidang Teknologi Informasi dan Bisnis Digital.";

        $contact = [
                    "phone" => "0812-3456-7890",
                    "email" => "edubridge@email.com",
                    "address" => "Jakarta Selatan, Indonesia"
        ];

        return view('welcome', compact(['requirements', 'definition', 'contact']));
    }
}
