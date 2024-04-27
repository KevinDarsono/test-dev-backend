<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainanController extends Controller
{
    private $mainan = [
        'kotak' => [
            'merah' => 4,
            'hijau' => 9,
            'hitam' => 10
        ],

        'lingkaran' => [
            'hijau' => 40,
            'hitam' => 23,
            'kuning' => 7
        ],
        'bintang' => [
            'kuning' => 10,
            'merah' => 8,
            'hijau' => 7,
            'hitam' => 9,
            'jingga' => 10
        ],
        'segitiga' => [
            'merah' => 8,
            'kuning' => 9,
            'hijau' => 19,
            'hitam' => 10
        ]

    ];


    public function mainanMerah(){
        $merah = [];

        foreach ($this->mainan as $bentuk => $mainanMerah){
            if(isset($mainanMerah['merah'])){
                $merah[$bentuk] = $mainanMerah['merah'];
            }
        }

        return $merah;
    }

    public function gantiHijau(){
        if(isset($this->mainan['lingkaran']['hijau'])){
            $this->mainan['lingkaran']['hitam'] += $this->mainan['lingkaran']['hijau'];
            unset($this->mainan ['lingkaran']['hijau']);
        }

        return $this->mainan;
    }

    public function urutMainan(){
        $warna = ['merah', 'kuning', 'hijau', 'hitam', 'jingga'];
        $urutan = [];


        foreach ($warna as $w){
            foreach($this->mainan as $bentuk => $mainan){
                if(isset($mainan[$w])){
                    $urutan[$bentuk][$w] = $mainan[$w];
                }
            }
        }

        return $urutan;
    }
}


