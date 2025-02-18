<?php

namespace App\Core;

use Illuminate\Support\Facades\Http;

class AiApi
{

    protected $url;

    public function __construct()
    {
        $this->url = 'https://ai.indonesiacore.com/api/';
    }

    public function get($endpoint, $param)
    {
        try {
            //code...
            // $url= 'https://apirs.indonesiacore.com/api/auth/login';
            $url = env('AI_API_URL') . $endpoint;
            dd($url);
            $data = json_encode($param);

            $result =  Http::withOptions(
                [
                    'verify' => false,
                ]
            )->withHeaders(
                [
                    'Content-Type' => 'application/json',
                    // 'Authorization' => 'Bearer ' . session('token') ?? null,

                ]
            )->get($url, $param);

            $resData =  json_decode($result, true);

            // dd($resData);
            if ($resData['status'] == 'success') {
                return [
                    'status' => true,
                    'message' => $resData['message'],
                    'data' => $resData['data']
                ];
            } else {
                return [
                    'status' => false,
                    'message' => $resData['message'],
                    'data' => null
                ];
            }
        } catch (\Throwable $th) {
            //throw $th;

            return [
                'status' => false,
                'message' => $th->getMessage(),
                'data' => null
            ];
        }
    }

    public function post($endpoint, $param)
    {
        try {
            $url  = env('AI_API_URL') . $endpoint;

            $listdata = [
                "prompt" => $param
            ];

            // dd($url,$listdata);

            $data = json_encode($listdata);


            // dd($data);
            $result =  Http::withOptions(
                [
                    'verify' => storage_path('cacert.pem'),
                ]
            )->withHeaders(
                [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . session('token') ?? null,

                ]
            )->post($url, $listdata);

            $resData = json_decode($result, true);
            // dd($result);
            // dd($resData['result']['response']);

            if ($resData['status'] == true) {
                return [
                    'status' => true,
                    'message' => $resData['message'],
                    'data' => $resData['result']
                ];
            } else {
                return [
                    'status' => false,
                    'message' => $resData['message'],
                    'data' => null
                ];
            }
        } catch (\Throwable $th) {
            // throw $th;

            return [
                'status' => false,
                'data' => $th->getMessage()
            ];
        }
    }

    public function put($endpoint, $param)
    {
        try {

            $url = env('AI_API_URL') . $endpoint;

            $data = json_encode($param);

            $result =  Http::withOptions(
                [
                    'verify' => false,
                ]
            )->withHeaders(
                [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . session('token') ?? null,
                ]
            )->put($url, $param);

            $resData =  json_decode($result, true);

            if ($resData['status'] == 'success') {
                return [
                    'status' => true,
                    'message' => $resData['message'],
                    'data' => $resData['data']
                ];
            } else {
                return [
                    'status' => false,
                    'message' => $resData['message'],
                    'data' => null
                ];
            }
        } catch (\Throwable $th) {
            //throw $th;
            return [
                'status' => false,
                'data' => $th->getMessage()
            ];
        }
    }

    public function delete($endpoint, $param)
    {
        try {

            $url = env('AI_API_URL') . $endpoint;

            $data = json_encode($param);

            $result =  Http::withOptions(
                [
                    'verify' => false,
                ]
            )->withHeaders(
                [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . session('token') ?? null,
                ]
            )->delete($url, $param);

            $resData =  json_decode($result, true);

            if ($resData['status'] == 'success') {
                return [
                    'status' => true,
                    'message' => $resData['message'],
                    'data' => $resData['data']
                ];
            } else {
                return [
                    'status' => false,
                    'message' => $resData['message'],
                    'data' => null
                ];
            }
        } catch (\Throwable $th) {
            //throw $th;
            return [
                'status' => false,
                'data' => $th->getMessage()
            ];
        }
    }

    public function curlImage($endpoint, $param)
    {

        $url  = env('AI_API_URL') . $endpoint;
        $data = [
            'prompt' => 'Gambar Hris Application dan Hris, Application System'
        ];
        
        // Inisialisasi cURL
        $ch = curl_init();
        
        // Opsi cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Eksekusi request dan mendapatkan respons
        $response = curl_exec($ch);
        
        // Cek kesalahan
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);

            return [
                'status' => false,
                'message' => curl_error($ch),
                'data' => null
            ];
        } else {
            // Cetak hasil
            $resp = json_decode($response, true);

            // dd($resp['result']);
            return [
                'status' => true,
                'message' => 'Success',
                'data' => $resp['result']
            ];
        }
        
        // Tutup cURL
        curl_close($ch);
    }

}
