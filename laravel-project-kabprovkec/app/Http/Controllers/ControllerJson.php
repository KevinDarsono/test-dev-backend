<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ControllerJson extends Controller
{
    public function JsonData()
    {
        $jsonData = file_get_contents(public_path('assets/json1.json'));
        $data = json_decode($jsonData, true);

        return response()->json($data);
    }

    public function JsonUpdateSUM()
    {

        $jsonData = $this->JsonData();
        $data = $jsonData->getData(true);

        $projectProv = 0;

        foreach ($data['kabupaten'] as &$kab) {
            $projectKab = 0;

            foreach ($kab['kecamatan'] as &$kec) {
                $projectKec = 0;
                $projectDesa = 0;

                foreach ($kec['desa'] as &$desa) {
                    $projectDesa += $desa['nilai-project'];
                }
                $projectKec += $projectDesa;
                $kec['nilai-project'] = $projectKec;

                $projectKab += $projectKec;
            }

            $kab['nilai-project'] = $projectKab;
            $projectProv += $projectKab;
        }
        $data['nilai-project'] = $projectProv;

        return response()->json($data);
    }


    public function JsonDataDesa()
    {

        $jsonData = $this->jsonData();
        $data = $jsonData->getData(true);

        $dataDesa = [];

        foreach ($data['kabupaten'] as &$kab) {
            foreach ($kab['kecamatan'] as &$kec) {
                foreach ($kec['desa'] as &$desa) {
                    if ($desa['nilai-project'] > 300) {
                        $dataDesa[] = $desa;
                    }
                }
            }
        }

        return response()->json($dataDesa);
    }

    public function JsonDataKab()
    {

        $jsonData = $this->jsonData();
        $data = $jsonData->getData(true);

        $tampung = [];

        foreach ($data['kabupaten'] as &$kab) {
            if ($kab['nama'] == 'kab2') {
                $projectKab = 0;
                foreach($kab['kecamatan'] as &$kec){
                    $projectKec = 0;
                    $projectDesa = 0;

                    foreach($kec['desa'] as $desa){
                        $projectDesa += $desa['nilai-project'];
                    }
                    $projectKec += $projectDesa;
                    $kec['nilai-project'] = $projectKec;

                    $projectKab += $projectKec;
                }
                $tampung = [
                    'nama' => $kab['nama'],
                    'nilai-project' => $projectKab,

                ];
            }
        }

        return response()->json($tampung);
    }
}
