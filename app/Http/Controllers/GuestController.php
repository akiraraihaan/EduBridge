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
                'requirement' => 'Selama berdomisili di Indonesia'
            ]
        ];

        return view('welcome', compact('requirements'));
    }
}
