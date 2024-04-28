<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Items;

class ItemsControllers extends Controller
{
    public function getData()
    {
        $jsonFile = file_get_contents(public_path('assets/case.json'));
        $data = json_decode($jsonFile, true);

        $result = [
            'total' => 0,
            'data' => []
        ];

        $categoryData = [];

        foreach($data['data'] as $item){
            $category = $item['category'];
            $code = $item['code'];
            $name = $item['name'];
            $total = $item['total'];

            if(!isset($categoryData[$category])){
                $categoryData[$category] = [
                    'total' => 0,
                    'data' => []

                ];
            }

            if(!isset($categoryData[$category]['data'][$code])){
                $categoryData[$category]['data'][$code] = [
                    'total' => 0,
                    'data' => []
                ];
            }

            $categoryData[$category]['total'] += $total;
            $categoryData[$category]['data'][$code]['total'] += $total;

            $categoryData[$category]['data'][$code]['data'][] = [
                'name' => $name,
                'total' => $total,
            ];

            $result['total'] += $total;
        }

        foreach($categoryData as $categoryData => $categoryInfo){
            $result['data'][] = [
                'category' => $category,
                'total' => $categoryInfo['total'],
                'data' => $categoryInfo['data'],
            ];
        }

        return response()->json($result);
    }
}
