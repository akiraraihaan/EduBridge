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
                    'ig' => 'https://www.instagram.com/benonygabriel/',
                    'github' => 'https://github.com/benonygabriel'
                ],
                [
                    'name' => 'Raihan Akira R',
                    'position' => 'Owner and Founder',
                    'description' => 'Spesialis kurikulum dengan pengalaman mengajar 10+ tahun.',
                    'image' => '/img/Akira.png',
                    'ig' => 'https://www.instagram.com/raihaan_ar/',
                    'github' => 'https://github.com/akiraraihaan'
                ],
                [
                    'name' => 'Arshanda Geulis N',
                    'position' => 'Head of Education',
                    'description' => 'Spesialis kurikulum dengan pengalaman mengajar 10+ tahun.',
                    'image' => '/img/Arshan.png',
                    'ig' => 'https://www.instagram.com/arshanda_geulis/',
                    'github' => 'https://github.com/arshanda-geulis'
                ],
                [
                    'name' => 'Fitria Nurhaliza',
                    'position' => 'Head of Education',
                    'description' => 'Spesialis kurikulum dengan pengalaman mengajar 10+ tahun.',
                    'image' => '/img/Arshan.png',
                    'ig' => 'https://www.instagram.com/fitrianurhaliza/',
                    'github' => 'https://github.com/fitrianurhaliza'
                ],
                [
                    'name' => 'Felix Joshua P',
                    'position' => 'Head of Education',
                    'description' => 'Spesialis kurikulum dengan pengalaman mengajar 10+ tahun.',
                    'image' => '/img/Arshan.png',
                    'ig' => 'https://www.instagram.com/felixjoshua_/',
                    'github' => 'https://github.com/felixjoshua'
                ],
                [
                    'name' => 'David Wilson',
                    'position' => 'Head of Technology',
                    'description' => 'Ahli teknologi dengan fokus pada pengembangan platform edukasi.',
                    'image' => '/img/Arshan.png',
                    'ig' => 'https://www.instagram.com/davidwilson_/',
                    'github' => 'https://github.com/davidwilson'
                ]
            ],
            'contact' => [
                'email' => 'info@edubridge.com',
                'phone' => '(021) 1234-5678',
                'address' => 'Jakarta, Indonesia'
            ],
            'vision' => 'Menjadi platform pendidikan terdepan yang memfasilitasi akses ke pendidikan berkualitas tinggi dan menghubungkan talenta dengan peluang karir yang sesuai.',
            'missions' => [
                'Menyediakan pendidikan berkualitas yang terjangkau',
                'Memfasilitasi kolaborasi antara siswa dan mentor profesional',
                'Menciptakan ekosistem pembelajaran yang inovatif',
                'Membantu siswa meraih karir impian mereka'
            ]
        ];

        return view('about', compact('data'));
    }
}
