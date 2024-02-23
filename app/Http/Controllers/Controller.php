<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function apiResponse($data, $status = 200)
    {
        return response()->json([
            'data' => $data
        ], $status);
    }
    public function apiPaginatedResponse($data, $status = 200)
    {
        return response()->json([
            'data' =>  [
                'items' => $data->items(),
                'pagination' => [
                    'total' => $data->total(),
                    'per_page' => $data->perPage(),
                    'current_page' => $data->currentPage(),
                    'last_page' => $data->lastPage(),
                    'next_page_url' => $data->nextPageUrl(),
                    'prev_page_url' => $data->previousPageUrl(),
                    'path' => $data->path(),
                ]
            ],
        ], $status);
    }
}
