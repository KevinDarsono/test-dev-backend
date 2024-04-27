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

    public function jsonUpdateAverage()
    {
        $jsonResponse = $this->jsonData();
        $data = $jsonResponse->getData(true);

        $totalProjectKabupaten = 0;
        $countKabupaten = count($data['kabupaten']);

        foreach ($data['kabupaten'] as &$kabupaten) {
            $totalProjectKecamatan = 0;
            $countKecamatan = 0;

            foreach ($kabupaten['kecamatan'] as &$kecamatan) {
                $totalProjectDesa = 0;
                $totalDesa = 0;

                foreach ($kecamatan['desa'] as &$desa) {
                    $totalProjectDesa += $desa['nilai-project'];
                    $totalDesa++;
                }

                $avgProjectKecamatan = $totalProjectDesa / $totalDesa;
                $kecamatan['nilai-project'] = $avgProjectKecamatan;

                $totalProjectKecamatan += $avgProjectKecamatan;
                $countKecamatan++;
            }

            $avgKabupaten = $totalProjectKecamatan / $countKecamatan;
            $kabupaten['nilai-project'] = $avgKabupaten;

            $totalProjectKabupaten += $avgKabupaten;
        }

        $avgProvinsi = $totalProjectKabupaten / $countKabupaten;
        $data['nilai-project'] = $avgProvinsi;


        return response()->json($data);
    }


    public function JsonUpdateSUM(){

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
}
