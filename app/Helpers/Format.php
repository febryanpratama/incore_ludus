<?php 

namespace App\Helpers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

use App\Todo;

class Format {

    public static function getCachedMeta(?string $targetUrl = null)
    {
        // Jika tidak diberikan URL, pakai URL default
        $targetUrl = $targetUrl ?? Request::fullUrl();
        // $targetUrl = $targetUrl ?? 'https://balltrend.com';

        if (!filter_var($targetUrl, FILTER_VALIDATE_URL)) {
            return null;
        }

        $cacheKey = 'meta_' . md5($targetUrl);

        return Cache::remember($cacheKey, now()->addHours(6), function () use ($targetUrl) {
            $apiUrl = 'https://blog.indonesiacore.com/api/meta-domains';
            $headers = [
                'Accept: application/json',
                'x-api-key: sk-5d8a894adea243f88c850e9ea72a393d'
            ];
            $query = http_build_query(['url' => $targetUrl]);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiUrl . '?' . $query);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // equivalent to withoutVerifying()

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            // dd($response);
            if ($httpCode === 200 && $response) {
                $json = json_decode($response, true);
                if (isset($json['status']) && $json['status'] === true && isset($json['data'])) {
                    // dd($json);
                    return $json['data'];
                }
            }

            return null;
        });
    }

}