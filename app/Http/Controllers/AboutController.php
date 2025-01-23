<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $data = [
            'team' => [
                [
                    'name' => 'Benony Gabriel',
                    'position' => 'CEO',
                    'description' => '15+ tahun pengalaman di bidang edukasi dan teknologi.',
                    'image' => '/img/Ony.png',
                    'ig' => 'https://www.instagram.com/benogabriel_27',
                    'github' => 'https://github.com/iambeno1'
                ],
                [
                    'name' => 'Raihan Akira R',
                    'position' => 'Owner and Founder',
                    'description' => 'Spesialis tidur, bersyukur, dan belajar mengikhlaskan.',
                    'image' => '/img/Akira.png',
                    'ig' => 'https://www.instagram.com/raihaan_ar/',
                    'github' => 'https://github.com/akiraraihaan'
                ],
                [
                    'name' => 'Arshanda Geulis N',
                    'position' => 'Head of Education',
                    'description' => 'Spesialis kurikulum dengan pengalaman mengajar 10+ tahun.',
                    'image' => '/img/Arshan.png',
                    'ig' => 'https://www.instagram.com/arshndaagn',
                    'github' => 'https://github.com/ArshandaGN'
                ],
                [
                    'name' => 'Fitria Nurhaliza',
                    'position' => 'Master of Science',
                    'description' => 'Spesialis kurikulum dengan pengalaman mengajar 10+ tahun.',
                    'image' => '/img/Fitria.png',
                    'ig' => 'https://www.instagram.com/fitrianlz_',
                    'github' => 'https://github.com/FitriaaN'
                ],
                [
                    'name' => 'Felix Joshua P',
                    'position' => 'Master of Code',
                    'description' => 'Spesialis kurikulum dengan pengalaman mengajar 10+ tahun.',
                    'image' => '/img/Felix.png',
                    'ig' => 'https://www.instagram.com/felixjoshua_/',
                    'github' => 'https://github.com/felixjoshua'
                ],
                [
                    'name' => 'Anom Wajawening',
                    'position' => 'Mewing Boy',
                    'description' => 'Ahli teknologi dengan fokus pada pengembangan platform edukasi.',
                    'image' => '/img/anom.png',
                    'ig' => 'https://www.instagram.com/a_wajawening',
                    'github' => 'https://github.com/Nommmz'
                ]
            ],
            'contact' => [
                'email' => 'info@edubridge.com',
                'phone' => '(021) 1234-5678',
                'address' => 'Jakarta, Indonesia'
            ],
            'vision' => 'Menjadi platform pendidikan terdepan yang memfasilitasi akses ke pendidikan berkualitas tinggi dan menghubungkan talenta dengan peluang karir yang sesuai.',
            'missions' => [
                'Menyediakan pendidikan berkualitas tanpa pungutan biaya',
                'Memfasilitasi kolaborasi antara siswa dan mentor berpengalaman',
                'Membantu siswa meraih karir impian mereka'
            ]
        ];

        return view('about', compact('data'));
    }
}
