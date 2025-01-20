<?php

namespace App\Services;

use App\Core\AiApi;
use App\Models\Artikel;

class GenerateServices
{
    public function generateArtikel()
    {
        // 
        $topic = "masa remaja Cristiano Ronaldo";

        // dd($topic);

        $resp = $this->fetchArtikel($topic);
    }


    private function fetchArtikel($topic)
    {
        $api = new AiApi();
        $prompt = "Sebagai seorang profesional pembuat konten web, tolong buatkan satu artikel berisi maksimal 300 kata mengenai ".$topic.", dibagi menjadi dua paragraf, dengan ketentuan yaitu ada headline utama artikel, highlight 1 maksimal 300 huruf, paragraf 1 maksimal 370 huruf, paragraf 2 maksimal 290 huruf, highlight 2 maksimal 150 huruf, paragraf 3 maksimal 320 huruf, dan paragraf 4 maksimal 500 huruf. Formatkan hasilnya ke dalam JSON dengan struktur berikut: { \"headlineUtamaArtikel\": \"\",\"highlight1\": \"\", \"paragraf1\": \"\",\"paragraf2\": \"\", \"highlight2\": \"\", \"paragraf3\": \"\", \"paragraf4\":} tanpa ada tag html";
        $response = $api->post('/api/generate/text', $prompt);

        // Respons mentah dari API
        $rawResponse = $response['data']['response'];

        try {
            $jsonObject = $this->extractJsonObject($rawResponse);

            // dd($jsonObject);


            // Simpan artikel ke database

            $artikel = new Artikel();

            $artikel->headlineUtamaArtikel = $jsonObject['headlineUtamaArtikel'];
            $artikel->highlight1 = $jsonObject['highlight1'];
            $artikel->paragraf1 = $jsonObject['paragraf1'];
            $artikel->paragraf2 = $jsonObject['paragraf2'];
            $artikel->highlight2 = $jsonObject['highlight2'];
            $artikel->paragraf3 = $jsonObject['paragraf3'];
            $artikel->paragraf4 = $jsonObject['paragraf4'];
            $artikel->save();

            // Debugging (opsional)
            dd($artikel);
            // dd($jsonObject);
        } catch (\Exception $e) {
            // Tangani error
            // continue;
            dd($e->getMessage());
        }
    }

    private function extractJsonObject($rawText)
    {
        // Gunakan regex untuk mencari JSON object
        if (preg_match('/\{.*?\}/s', $rawText, $matches)) {
            $jsonString = $matches[0];

            // Decode JSON menjadi array
            $jsonObject = json_decode($jsonString, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                // Jika decoding berhasil, kembalikan hasilnya
                return $jsonObject;
            } else {
                // Tangani error jika decoding gagal
                throw new \Exception("Error decoding JSON: " . json_last_error_msg());
            }
        } else {
            // Tangani kasus di mana JSON tidak ditemukan
            throw new \Exception("JSON tidak ditemukan dalam teks.");
        }
    }

    public function generateImage()
    {
        $getArtikel = Artikel::whereNull('image1')
            ->whereNull('image2')
            ->whereNull('image3')
            ->whereNull('image4')
            ->first();

        $respImage = $this->fetchImage($getArtikel);

    }

    
    private function fetchImage($data)
    {

            // dd($data);
            // $prompt = "buatkan gambar manusia nyata bangsa Asia atau lingkungan nyata di Asia tanpa ada huruf, angka, coretan apapun untuk sosial media marketing berdasarkan deskripsi: ".$data['headlineUtamaArtikel']."";

            // Find the position of the comma
            $position = strpos($data['headlineUtamaArtikel'], ':');
            if($position === true) {
                
                $result_string = substr($data['headlineUtamaArtikel'], 0, $position);
                $prompt = $result_string;
            } else {
                $prompt = $data['headlineUtamaArtikel'];
            }

            // Extract the part of the string before the comma

             // Kirim prompt ke API
             $api = new AiApi();
             // $response = $api->post('/api/generate/generate-images-deepai', $prompt);
             $response = $api->post('/api/generate/generate-images-google', $prompt);
            //  foreach($response['data'] as $image){
            //     print_r($image[]);
            //  }
            // dd($prompt);
            if(count($response['data'])>=4){
                $data->update([
                    'image1' => $response['data'][0]['link'],
                    'image2' => $response['data'][1]['link'],
                    'image3' => $response['data'][2]['link'],
                    'image4' => $response['data'][3]['link']
                ]);
            }else if(count($response['data'])!=0 && count($response['data'])<4){ 
                for($i=0; $i<count($response['data']); $i++){
                    $data->update([
                        'image'.($i+1) => $response['data'][$i]['link']
                    ]);
                }
            }
            // dd($data);

        // foreach ($getArtikel as $key) {
        //     // Membuat prompt untuk API
        //     // $prompt = "Sebagai seorang profesional pembuat konten web, tolong buatkan satu artikel berisi maksimal 500 kata, dibagi menjadi tiga paragraf, memiliki link http://www.cerita.ceritain.com/".$key->slug." serta sajikan dalam bentuk kode HTML yang optimal untuk tampil di halaman pertama mesin pencarian. Selain itu, formatkan hasilnya ke dalam JSON dengan struktur berikut: { \"content\": \"\", \"meta_html\": \"\" } tanpa ada teks tambahan lain. Dalam pembuatan artikel itu wajib menggunakan deskripsi berikut ini sebagai referensi kamu: Meta Title: ".$key['title'].", Meta Description: ".$key->category->meta_category->meta_description.", Meta Keywords: ".$key->category->meta_category->meta_keywords.", Meta Hashtags: ".$key->category->meta_category->meta_hashtags.".";

        //     // save to public path

        //     $imageContent = file_get_contents($responseImagePath);

        //     if ($imageContent !== false) {
        //         // Buat nama file unik
        //         $filename = 'image_' . rand(111, 9999) . time() . '.jpg';
            
        //         // Tentukan folder penyimpanan gambar di public path
        //         $savePath = public_path('artikel/images'); // Anda dapat mengganti 'images' dengan folder lain yang diinginkan
            
        //         // Pastikan folder tujuan ada
        //         if (!is_dir($savePath)) {
        //             mkdir($savePath, 0755, true); // Membuat folder jika belum ada
        //         }
            
        //         // Simpan gambar ke folder public/images
        //         file_put_contents($savePath . '/' . $filename, $imageContent);
            
        //         // URL untuk mengakses gambar
        //         $imageUrl = asset('artikel/images/' . $filename);
        //         // dd($prompt, $response,$responseImagePath);

        //         $updateArtikel = Artikel::find($key->id);
                
        //         $updateArtikel->path_image = $imageUrl;
        //         $updateArtikel->save();

        //     } else {
        //         continue;
        //     }

        // }
    }
}