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
                    'image' => 'https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80'
                ],
                [
                    'name' => 'Raihan Akira R',
                    'position' => 'Owner and Founder',
                    'description' => 'Spesialis kurikulum dengan pengalaman mengajar 10+ tahun.',
                    'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80'
                ],
                [
                    'name' => 'Arshanda Geulis N',
                    'position' => 'Head of Education',
                    'description' => 'Spesialis kurikulum dengan pengalaman mengajar 10+ tahun.',
                    'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80'
                ],
                [
                    'name' => 'Fitria Nurhaliza',
                    'position' => 'Head of Education',
                    'description' => 'Spesialis kurikulum dengan pengalaman mengajar 10+ tahun.',
                    'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80'
                ],
                [
                    'name' => 'Felix Joshua P',
                    'position' => 'Head of Education',
                    'description' => 'Spesialis kurikulum dengan pengalaman mengajar 10+ tahun.',
                    'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80'
                ],
                [
                    'name' => 'David Wilson',
                    'position' => 'Head of Technology',
                    'description' => 'Ahli teknologi dengan fokus pada pengembangan platform edukasi.',
                    'image' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80'
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
