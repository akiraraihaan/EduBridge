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

        $courses = [
            [
                'name' => "FrontEnd Course",
                'status' => "Available",
                'img' => '/img/course-1.png'
            ],
            [
                'name' => "BackEnd Course",
                'status' => "Available",
                'img' => '/img/course-2.png'
            ],
            [
                'name' => "UI/UX Design Course",
                'status' => "Available",
                'img' => '/img/course-3.png'
            ],
            [
                'name' => "Data Science Course",
                'status' => "Available",
                'img' => '/img/course-4.png'
            ],
            [
                'name' => "Artificial Intelligence",
                'status' => "Available",
                'img' => '/img/course-1.png'
            ],
            [
                'name' => "Machine Learning",
                'status' => "Available",
                'img' => '/img/course-2.png'
            ],
        ];

        return view('welcome', compact(['requirements', 'definition', 'courses']));
    }
}
