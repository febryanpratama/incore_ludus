<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Core\AiApi;
use App\Models\Artikel;
use App\Models\Categories;
use App\Models\Topic;
use Illuminate\Support\Facades\File;

class GenerateServices
{
    public function generateTitle($cat_id)
    {
        $cat = $this->_getRandomCategory($cat_id);

        // dd($cat->name);
        $this->fetchTitle($cat->name, $cat->id);

        return true;
    }

    private function _getRandomCategory($cat_id)
    {
        $data = Categories::where('id', $cat_id)->first();

        if(!$data){
            return [
                'status' => false,
                'message' => 'Data not found'
            ];
        }

        return $data;
    }

    public function fetchTitle($cat, $cat_id)
    {
        $api = new AiApi();
        $prompt = "buatkan 5 title artikel web yang sedang populer saat ini dengan deskripsi website terkait informasi seputar olahraga / sport terkini baik itu selebgram, artis sport maupun lain sebagainya berdasarkan kategori ".$cat.". dan tolong sajikan dalam bentuk json seperti ini{ \"title1\": \"\",\"title2\": \"\", \"title3\": \"\",\"title4\": \"\", \"title5\": \"\":}";
    
        $response = $api->post('/api/generate/text', $prompt);

        $rawResponse = $response['data']['response'];

        try {
            $jsonObject = $this->extractJsonObject($rawResponse);

            // dd($jsonObject);
            foreach ($jsonObject as $key => $value) {
                // $artikel = new Artikel();
                // $artikel->title = $value;
                // $artikel->save();
                $topic = new Topic();

                $topic->category_id = $cat_id;
                $topic->topic_name = $value;
                $topic->slug = Str::slug($value);

                $topic->save();
            }


        } catch (\Exception $e) {
            // Tangani error
            // continue;
            // dd($e->getMessage());
        }
    }


    public function generateArtikel()
    {
        // 
        // $topic = "Tangerang Hawks Basketball Club";
        // $topic = "Pemain voli megawati";
        // $topic = "Badminton Jonatan Cristie";

        // dd($topic);

        $topic = $this->_fetchTopicRandom();
        // dd($topic);

        $resp = $this->fetchArtikel($topic->topic_name, $topic->category_id);

        $topic->update([
            'is_generated' => 'Y'
        ]);


    }

    private function _fetchTopicRandom()
    {
        $data = Topic::all();

        $randomTopic = $data->random();

        return $randomTopic;
    }



    private function fetchArtikel($topic, $category_id)
    {
        $api = new AiApi();
        $prompt = "Sebagai seorang profesional pembuat konten web, tolong buatkan satu artikel berisi maksimal 300 kata mengenai ".$topic.", dibagi menjadi dua paragraf, dengan ketentuan yaitu ada headline utama artikel, highlight 1 maksimal 300 huruf, paragraf 1 maksimal 370 huruf, paragraf 2 maksimal 290 huruf, highlight 2 maksimal 150 huruf, paragraf 3 maksimal 320 huruf, dan paragraf 4 maksimal 500 huruf. Formatkan hasilnya ke dalam JSON dengan struktur berikut: { \"headlineUtamaArtikel\": \"\",\"highlight1\": \"\", \"paragraf1\": \"\",\"paragraf2\": \"\", \"highlight2\": \"\", \"paragraf3\": \"\", \"paragraf4\":} tanpa ada tag html";
        $response = $api->post('/api/generate/text', $prompt);

        // dd($response);
        // Respons mentah dari API
        $rawResponse = $response['data']['response'];

        try {
            $jsonObject = $this->extractJsonObject($rawResponse);


            $artikel = new Artikel();

            $artikel->category_id = $category_id;
            $artikel->headlineUtamaArtikel = $jsonObject['headlineUtamaArtikel'];
            $artikel->highlight1 = $jsonObject['highlight1'];
            $artikel->paragraf1 = $jsonObject['paragraf1'];
            $artikel->paragraf2 = $jsonObject['paragraf2'];
            $artikel->highlight2 = $jsonObject['highlight2'];
            $artikel->paragraf3 = $jsonObject['paragraf3'];
            $artikel->paragraf4 = $jsonObject['paragraf4'];
            $artikel->save();

        } catch (\Exception $e) {
            // Tangani error
            // continue;
            // dd($e->getMessage());
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

    public function generateImage($id)
    {
        $getArtikel = Artikel::where('id', $id)
            ->whereNull('image1')
            ->whereNull('image2')
            ->whereNull('image3')
            ->whereNull('image4')
            ->first();

        // dd($getArtikel);

        $respImage = $this->fetchImage($getArtikel);

    }

    
    private function fetchImage($data)
    {
            // $prompt = "buatkan gambar manusia nyata bangsa Asia atau lingkungan nyata di Asia tanpa ada huruf, angka, coretan apapun untuk sosial media marketing berdasarkan deskripsi: ".$data['headlineUtamaArtikel']."";

            $prompt = preg_replace("/[^A-Za-z0-9\  ]/", "", $data['headlineUtamaArtikel']);
            // $replace_characters = preg_replace("/[^A-Za-z0-9\  ]/", "", $data['headlineUtamaArtikel']);
            // $prompt = $this->limit_words("foto atau gambar ".$replace_characters, 6);

            // Match name at the beginning or end
            if (preg_match('/^([a-zA-Z\s]+)(?=:)|(?<=: )([a-zA-Z\s]+)$/', $data['headlineUtamaArtikel'], $matches)) {
                $name = $matches[1] ?? $matches[2]; 
            } else if (preg_match('/\b([A-Z][a-z]+(?:\s[A-Z][a-z]+)+)\b/', $data['headlineUtamaArtikel'], $matches)) {
                $name = $matches[0]; 
            } else {
                $name = $data['headlineUtamaArtikel']; // If no name is found
            }
            // print_r($prompt);
            // dd($name);
             // Kirim prompt ke API
             $api = new AiApi();
             // $response = $api->post('/api/generate/generate-images-deepai', $prompt);
             $response = $api->post('/api/generate/generate-images-google', $prompt);
            //  dd($response);
            
            foreach($response['data'] as $image){
                // try {
                    //code...
                    if(strpos($image['link'], 'jpg')||strpos($image['link'], 'png')||strpos($image['link'], 'jpeg')||strpos($image['link'], 'JPG')||strpos($image['link'], 'PNG')||strpos($image['link'], 'JPEG') ){
                        $string = strtolower($image['title']);
                        $kataArray = explode(" ", $string);
                        $katacari = explode(" ", strtolower($name));
                        // var_dump($kataArray);
                        // var_dump($katacari);
                        // print_r(array_intersect($katacari, $kataArray));
                        // print_r(count(array_intersect($katacari, $kataArray)));
                        
                        if (array_intersect($katacari, $kataArray)!=[]) {
                            if(count(array_intersect($katacari, $kataArray))!=0 && count(array_intersect($katacari, $kataArray))<=4){

                                // print_r($image);
                                if($data->image1==null){
                                    $save = $this->saveImage($image['link']);
                                        $data->update([
                                            'image1' => $save
                                        ]);
    
                                } elseif($data->image2==null){
                                    $save = $this->saveImage($image['link']);
                                    $data->update([
                                        'image2' => $save
                                    ]);
                                } elseif($data->image3==null){
                                    $save = $this->saveImage($image['link']);
                                    $data->update([
                                        'image3' => $save
                                    ]);
                                } elseif($data->image4==null){
                                    $save = $this->saveImage($image['link']);
                                    $data->update([
                                        'image4' => $save
                                    ]);
                                }
                            }
                        } else {
                            // echo "Kata tidak ditemukan dalam string.";
                        }
                    }
                // } catch (\Throwable $th) {
                //     //throw $th;
                //     continue;
                // }
            }
            // dd();
            // if(count($response['data'])>=4){
            //     $data->update([
            //         'image1' => $response['data'][0]['link'],
            //         'image2' => $response['data'][1]['link'],
            //         'image3' => $response['data'][2]['link'],
            //         'image4' => $response['data'][3]['link']
            //     ]);
            // }else if(count($response['data'])!=0 && count($response['data'])<4){ 
            //     for($i=0; $i<count($response['data']); $i++){
            //         $data->update([
            //             'image'.($i+1) => $response['data'][$i]['link']
            //         ]);
            //     }
            // }
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
    // private function saveImage($url){
    //     $response = Http::get($url);
    //         if($response->successful()){
    //             $dateTime = now();
    //             $randomString = Str::random(5);
    //             // Mengambil ekstensi file
    //             $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
    //             $filename = $dateTime->format('YmdHis').$randomString.".".$extension;
                
    //             $filePath = 'images_download/' . $filename;
    //             // dd($filePath);

    //             // Validasi path folder
    //             if (!Storage::disk('public')->exists('images_download')) {
    //                 // Membuat folder jika belum ada
    //                 Storage::disk('public')->makeDirectory('images_download'); 
    //             }

    //                 // Simpan file ke folder 'public/images_download'
    //             Storage::disk('public')->put($filePath, $response->body());
    //             return $filename;
    //         } else {
    //             return null;
    //         }
    // }

    private function saveImage($url)
    {
        $response = Http::get($url);
        if ($response->successful()) {
            $dateTime = now();
            $randomString = Str::random(5);
            
            // Mengambil ekstensi file
            $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
            $filename = $dateTime->format('YmdHis') . $randomString . "." . $extension;
            
            $filePath = public_path('images_download/' . $filename);

            // Pastikan folder 'public/images_download' ada
            if (!File::exists(public_path('images_download'))) {
                File::makeDirectory(public_path('images_download'), 0755, true);
            }

            // Simpan file ke folder 'public/images_download'
            file_put_contents($filePath, $response->body());

            return $filename;
        } else {
            return null;
        }
    }

    private function limit_words($string, $word_limit)
    {
        $words = explode(" ",$string);
        return implode(" ",array_splice($words,0,$word_limit));
    }
}