<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Core\AiApi;
use App\Models\Artikel;
use App\Models\Categories;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Models\Category;

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
        $prompt = "berikan 5 topic artikel web yang sedang populer saat ini dengan deskripsi website terkait informasi seputar olahraga / sport terkini baik itu selebgram, artis sport maupun lain sebagainya berdasarkan kategori ".$cat.".  dan tolong sajikan dalam bentuk json seperti ini{ \"title1\": \"\",\"title2\": \"\", \"title3\": \"\",\"title4\": \"\", \"title5\": \"\":}";
    
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
    public function generateArtikelCatId($catId)
    {
        // 
        // $topic = "Tangerang Hawks Basketball Club";
        // $topic = "Pemain voli megawati";
        // $topic = "Badminton Jonatan Cristie";

        // dd($topic);

        $topic = $this->_fetchTopicCatId($catId);
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
    private function _fetchTopicCatId($catId)
    {
        $data = Topic::where('category_id', $catId)->where('is_generated', 'N')->get();

        $randomTopic = $data->random();

        return $randomTopic;
    }



    private function fetchArtikel($topic, $category_id)
    {
        $api = new AiApi();
        // $prompt = "Sebagai seorang profesional pembuat konten web, tolong buatkan satu artikel berisi maksimal 300 kata mengenai ".$topic.", dibagi menjadi dua paragraf, dengan ketentuan yaitu ada headline utama artikel, highlight 1 maksimal 300 huruf, paragraf 1 maksimal 370 huruf, paragraf 2 maksimal 290 huruf, highlight 2 maksimal 150 huruf, paragraf 3 maksimal 320 huruf, dan paragraf 4 maksimal 500 huruf. Formatkan hasilnya ke dalam JSON dengan struktur berikut: { \"headlineUtamaArtikel\": \"\",\"highlight1\": \"\", \"paragraf1\": \"\",\"paragraf2\": \"\", \"highlight2\": \"\", \"paragraf3\": \"\", \"paragraf4\":} tanpa ada tag html";
        $prompt = "Sebagai seorang profesional pembuat konten web, tolong buatkan satu artikel berisi maksimal 300 kata mengenai ".$topic.", dibagi menjadi dua paragraf, dengan ketentuan yaitu ada headline utama artikel, highlight 1 maksimal 300 huruf, paragraf 1 maksimal 370 huruf, paragraf 2 maksimal 290 huruf, highlight 2 maksimal 150 huruf, paragraf 3 maksimal 320 huruf, dan paragraf 4 maksimal 500 huruf. Lalu dapatkan nama orang atau nama tempat atau nama organisasi atau nama peralatan atau nama lainnya dari paragraf 1, paragraf 2, paragraf 3, dan paragraf 4. Formatkan hasilnya ke dalam JSON dengan struktur berikut: { \"headlineUtamaArtikel\": \"\",\"highlight1\": \"\", \"paragraf1\": \"\", \"image1\": \"\",\"paragraf2\": \"\", \"highlight2\": \"\", \"image2\": \"\", \"paragraf3\": \"\", \"image3\": \"\", \"paragraf4\", \"image4\":} tanpa ada tag html";
        $response = $api->post('/api/generate/text', $prompt);

        // dd($response);
        // Respons mentah dari API
        $rawResponse = $response['data']['response'];

        // dd($rawResponse);

        try {
            $jsonObject = $this->extractJsonObject($rawResponse);


            $artikel = new Artikel();

            $artikel->category_id = $category_id;
            $artikel->slug = Str::slug($jsonObject['headlineUtamaArtikel'].'-'.Carbon::now()->format('Ymd'));
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

    public function generateImage()
    {
        $getArtikel = Artikel::with('category')
            ->whereNull('image1')
            ->whereNull('image2')
            ->whereNull('image3')
            ->whereNull('image4')
            ->get();

            // dd($getArtikel);

        $getOneArtikel = $getArtikel->random();
        // $getOneArtikel = $getArtikel[2];
        // dd($getArtikel[2]);
        $respTextImage = $this->fetchPromptImage($getOneArtikel);

        $maxTries = 5;
        $rejectedPrompts = [];
        $success = false;

        for ($i = 0; $i < $maxTries; $i++) {
            // Ambil prompt yang belum ditolak
            $availablePrompts = array_diff($respTextImage, $rejectedPrompts);

            if (empty($availablePrompts)) {
                break; // Semua prompt ditolak
            }

            $randKey = array_rand($availablePrompts);
            $selectedPrompt = $availablePrompts[$randKey];

            $success = $this->fetchImage($selectedPrompt, $getOneArtikel, $rejectedPrompts);

            if ($success) {
                break;
            }
        }
    }


    public function generateRandomImage()
    {
        $getArtikel = Artikel::with('category')
        // ->where('id', $id)
        ->whereNull('image1')
        ->whereNull('image2')
        ->whereNull('image3')
        ->whereNull('image4')
        ->get();

        $getOneArtikel = $getArtikel->random();
        
        // Generate Kata Kunci
        $respTextImage = $this->fetchPromptImage($getOneArtikel);
        
        // sample
        // $resp = [
        //     "serat karbon",
        //     "grafit",
        //     "pegangan ergonomis",
        //     "bantalan ekstra",
        //     "teknologi ventilasi",
        // ];
        
        // get rand array
        // Coba generate pertama kali
        // $rand = array_rand($respTextImage, 1);
        
        // $respImage = $this->fetchImage($respTextImage[$rand], $getOneArtikel);
        
        // Coba beberapa kali jika gagal
        $maxTries = 5;
        $success = false;
        $invalidPrompts = [];

        for ($i = 0; $i < $maxTries; $i++) {
            // Filter prompt yang sudah gagal sebelumnya
            $validPrompts = array_diff($respTextImage, $invalidPrompts);

            // Jika tidak ada prompt yang tersisa, keluar dari loop
            if (empty($validPrompts)) {
                break;
            }

            $rand = array_rand($validPrompts);
            $selectedPrompt = is_array($validPrompts) ? array_values($validPrompts)[$rand] : $validPrompts;

            $result = $this->fetchImage($selectedPrompt, $getOneArtikel);

            // Cek apakah salah satu image sudah terisi
            if (
                $getOneArtikel->image1 !== null ||
                $getOneArtikel->image2 !== null ||
                $getOneArtikel->image3 !== null ||
                $getOneArtikel->image4 !== null
            ) {
                $success = true;
                break;
            } else {
                // Simpan prompt yang gagal supaya tidak digunakan lagi
                $invalidPrompts[] = $selectedPrompt;
            }
        }

    }

    private function artikelStillEmpty($data)
    {
        return empty($data->image1) && empty($data->image2) && empty($data->image3) && empty($data->image4);
    }

    public function fetchPromptImage($artikel)
    {
        $api = new AiApi();
        // $prompt = "Temukan dan informasikan kepada saya semua nama orang atau nama tempat atau nama entitas atau nama peralatan atau nama teknologi dari '{$artikel->paragraf1}', '{$artikel->paragraf2}', '{$artikel->paragraf3}', '{$artikel->paragraf4}' Prioritaskan nama orang atau nama tempat atau nama entitas dahulu, kalau tidak ada semuanya maka cari nama peralatan atau nama teknologi dan sajikan dalam bentuk JSON dengan struktur berikut: { \"entitas\": [ { \"paragraf1\": \"{$artikel->paragraf1}\", \"result\": \"result kamu\" }, { \"paragraf2\": \"{$artikel->paragraf2}\", \"result\": \"result kamu\" }, { \"paragraf3\": \"{$artikel->paragraf3}\", \"result\": \"result kamu\" }, { \"paragraf4\": \"{$artikel->paragraf4}\", \"result\": \"result kamu\" } ] } tanpa ada teks tambahan lain.";
        // $prompt = "Temukan dan informasikan kepada saya semua nama orang atau nama tempat atau nama entitas atau nama peralatan atau nama teknologi dari '{$artikel->paragraf1}', '{$artikel->paragraf2}', '{$artikel->paragraf3}', '{$artikel->paragraf4}' Dapatkan nama orang atau nama tempat dahulu, kalau tidak ada semuanya maka cari nama peralatan atau nama teknologi. dan sajikan dalam bentuk JSON dengan struktur berikut: { \"entities\": [\"\", \"\", \"\", \"\", \"\"] } tanpa ada teks tambahan lain.";
        // $prompt = "Temukan dan informasikan kepada saya nama orang atau nama tempat dahulu, kalau tidak ada maka temukan nama peralatan atau nama teknologi, dari '{$artikel->paragraf1}', '{$artikel->paragraf2}', '{$artikel->paragraf3}', '{$artikel->paragraf4}', sajikan dalam bentuk JSON dengan struktur berikut: { \"entities\": [\"\", \"\", \"\", \"\", \"\"] } tanpa ada teks tambahan lain.";
        // $prompt = "Temukan dan informasikan kepada saya nama orang atau nama tempat, kalau tidak ada maka temukan nama peralatan atau nama teknologi dari '{$artikel->paragraf1}', '{$artikel->paragraf2}', '{$artikel->paragraf3}', '{$artikel->paragraf4}', sajikan dalam bentuk JSON dengan struktur berikut: { \"entities\": [\"\", \"\", \"\", \"\", \"\"] } tanpa ada teks tambahan lain.";
        $prompt = "Temukan dan informasikan kepada saya nama orang atau nama tempat atau nama peralatan atau nama organisasi atau nama club dari '{$artikel->paragraf1}', '{$artikel->paragraf2}', '{$artikel->paragraf3}', '{$artikel->paragraf4}', sajikan dalam bentuk JSON dengan struktur berikut: { \"entities\": [\"\", \"\", \"\", \"\", \"\"] } tanpa ada teks tambahan lain.";
        $response = $api->post('/api/generate/text', $prompt);

        // Ekstrak entities dari response
        $entities = $this->extractEntitiesFromResponse($response);

        // dd($response, $entities); // Debugging, pastikan hasilnya sesuai
        // return 
        return $entities;
    }

    /**
     * Ekstrak daftar entities dari response API
     */
    /**
     * Ekstrak daftar entities dari response API
     */
    private function extractEntitiesFromResponse($response)
    {
        // Pastikan response memiliki data yang diperlukan
        if (!isset($response['data']['response'])) {
            return [];
        }

        // 1. Ambil response JSON yang masih dalam string
        $jsonString = trim($response['data']['response']);

        // 2. Hapus blok kode ```json ... ``` dan karakter whitespace berlebih
        $jsonString = preg_replace('/^```json/', '', $jsonString); // Hapus ```json di awal
        $jsonString = preg_replace('/```$/', '', $jsonString); // Hapus ``` di akhir
        $jsonString = trim($jsonString); // Hapus whitespace tambahan

        // 3. Decode JSON menjadi array
        $jsonData = json_decode($jsonString, true);

        // 4. Debugging jika decoding gagal
        if (json_last_error() !== JSON_ERROR_NONE) {
            dd("JSON Error: " . json_last_error_msg(), $jsonString);
        }

        // 5. Ambil daftar entities, atau kembalikan array kosong jika tidak ditemukan
        return $jsonData['entities'] ?? [];
    }

    public function fetchImage($kata_kunci, $data, &$rejectedPrompts = [])
    {
        if (preg_match('/^([a-zA-Z\s]+)(?=:)|(?<=: )([a-zA-Z\s]+)$/', $data['headlineUtamaArtikel'], $matches)) {
            $name = $matches[1] ?? $matches[2]; 
        } else if (preg_match('/\b([A-Z][a-z]+(?:\s[A-Z][a-z]+)+)\b/', $data['headlineUtamaArtikel'], $matches)) {
            $name = $matches[0]; 
        } else {
            $name = $data['headlineUtamaArtikel'];
        }

        $prompt = "{$kata_kunci}";
        $api = new AiApi();
        $response = $api->post('/api/generate/generate-images-google', $prompt);

        $success = false;

        // dd($response);

        foreach ($response['data'] as $image) {
            if (preg_match('/\.(jpg|jpeg|png)$/i', $image['link'])) {
                $string = strtolower($image['title']);
                $kataArray = explode(" ", strtolower($name));

                // ✅ Filter berdasarkan kecocokan nama (aktifkan) INI MASIH SAYA HIDE, JIKA SUDAH BISA DOWNLOAD DAN TERSIMPAN DI DATABASE, BARU DI UNHIDE
                // if (array_intersect($kataArray, explode(" ", strtolower($string))) === []) {
                //     // dd('intersect');
                //     continue; // skip gambar ini jika tidak cocok
                // }

                // dd($image);

                for ($i = 1; $i <= 4; $i++) {
                    
                    if (empty($data["image{$i}"])) {
                        // dd($image['link'], $data["image_{$i}"]);  
                        $save = $this->saveImage($image['link'], $data);
                        // dd($save);
                        $data->update(["image{$i}" => $save]);
                        
                        // dd($save,$data);
                        $success = true;
                        break 2;
                    }
                }
            }
        }

        if (!$success) {
            $rejectedPrompts[] = $kata_kunci; // ❌ Simpan prompt yang gagal
        }

        return $success;
    }

    private function saveImage($url, $data)
    {
        try {
            $response = Http::withOptions([
                'verify' => false,
            ])->get($url);

            if (!$response->successful()) {
                throw new \Exception("Failed to fetch image from URL: {$url}");
            }

            $path = parse_url($url, PHP_URL_PATH);
            $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            if (!in_array($extension, $allowedExtensions)) {
                throw new \Exception("Invalid image extension: .{$extension}");
            }

            $mime = $response->header('Content-Type');
            $allowedMimes = ['image/jpeg', 'image/png'];
            if (!in_array($mime, $allowedMimes)) {
                throw new \Exception("Invalid MIME type: {$mime}");
            }

            $baseName = Str::slug(Str::limit($data->headlineUtamaArtikel, 100, ''));
            $timestamp = now()->format('YmdHis');
            $random = Str::random(5);
            $filenameBase = "{$baseName}-{$timestamp}-{$random}";
            $filename = $filenameBase . ".jpg"; // force jpg as output
            $originalDir = storage_path('app/public/images_download');
            $publicDir = public_path('images_download');
            $tempOriginalPath = $originalDir . '/original_' . $filename;
            $finalPath = $publicDir . '/' . $filename;

            if (!File::exists($originalDir)) {
                File::makeDirectory($originalDir, 0755, true);
            }
            if (!File::exists($publicDir)) {
                File::makeDirectory($publicDir, 0755, true);
            }

            if (file_put_contents($tempOriginalPath, $response->body()) === false) {
                throw new \Exception("Failed to write image to temporary file.");
            }
            // $ffmpegPath = 'C:\\ffmpeg\\ffmpeg-2025-05-12-git-8ce32a7cbb-essentials_build\\bin\\ffmpeg.exe';
            $compressed = false;
            for ($q = 14; $q <= 40; $q += 2) {
                $tempCompressedPath = $publicDir . "/{$filenameBase}_q{$q}.jpg";

                $command = "ffmpeg -i " . escapeshellarg($tempOriginalPath)
                        . " -q:v {$q} -y -f image2 " . escapeshellarg($tempCompressedPath);
                exec($command . ' 2>&1', $output, $returnCode);
                Log::debug("FFmpeg Output:\n" . implode("\n", $output));
                Log::debug("Return code: {$returnCode}");

                if (file_exists($tempCompressedPath)) {
                    $sizeKB = filesize($tempCompressedPath) / 1024;
                    if ($sizeKB <= 300) {
                        // Simpan file ini sebagai final output
                        rename($tempCompressedPath, $finalPath);
                        $compressed = true;
                        $filename = basename($finalPath);
                        break;
                    } else {
                        unlink($tempCompressedPath); // hapus yang kebesaran
                    }
                }
            }

            if (file_exists($tempOriginalPath)) {
                unlink($tempOriginalPath);
            }

            if (!$compressed) {
                if (file_exists($finalPath)) {
                    unlink($finalPath);
                }
                throw new \Exception("Image compression failed or result too large.");
            }

            return $filename;

        } catch (\Exception $e) {
            Log::error("Image saving failed: " . $e->getMessage());
            return null;
        }
    }

    private function limit_words($string, $word_limit)
    {
        $words = explode(" ",$string);
        return implode(" ",array_splice($words,0,$word_limit));
    }

    public function fetchListTrending()
    {
        $api = new AiApi();
        // get list trending filter by category Sport
        // kategori sport masih belum tau idnya berapa, harus dicoba dulu di postman
        $response = $api->get('/api/google-trends/list-trends', 'sport');

        $rawResponse = $response['data']['response'];

        try {
            $jsonObject = $this->extractJsonObject($rawResponse);
            
            foreach ($jsonObject as $key => $value) {
                $title = $value['title'] ?? null;

                if ($title && !$this->isTopikExist($title)) {
                    Topik::create([
                        'topic_name' => $title,
                        // 'category_id' => $cat_id,
                        'slug' => Str::slug($title),
                        'link' => $value['link'],
                        'time_start_trend' => $value['time_start_trend'],
                        'is_generated' => 'N'
                    ]);
                }
            }


        } catch (\Exception $e) {
            // Tangani error
            // continue;
            // dd($e->getMessage());
            \Log::error('Error fetchListTrending: ' . $e->getMessage());
        }
    }

    private function fetchArtikelByTrend(Topic $topic)
    {
        $api = new AiApi();
        // list berita
        $responseNewsTrend = $api->get('api/google-trends/news?trend_title', $judultrend);

        $rawResponseTrend = $responseNewsTrend['data']['response'];

        try {
            $jsonObjectTrend = $this->extractJsonObject($rawResponseTrend);
            $response = $api->post('/api/google-trends/article', $topic['link']);
            $rawResponse = $response['data']['response'];    
    
            try {
                $jsonObject = $this->extractJsonObject($rawResponse);    
    
                $artikel = new Artikel();
                foreach ($jsonObject as $key => $value) {
                    $headings = $value['seo']['headings'] ?? [];

                    $h1 = $headings['h1'] ?? [];
                    $h2 = $headings['h2'] ?? [];
                    $h3 = $headings['h3'] ?? [];
                    $h4 = $headings['h4'] ?? [];
                    $h5 = $headings['h5'] ?? [];
                    $h6 = $headings['h6'] ?? [];
                    $prompt = "Sebagai seorang profesional pembuat konten web, tolong buatkan satu artikel berisi maksimal 300 kata mengenai ".$value['title'].", seperti berita berikut ".$h1." ".$h2." ".$h3." ".$h4." ".$h5." ".$h6.", dalam periode ".$topic['time_start_trend'].". Artikel dibagi menjadi dua paragraf, dengan ketentuan yaitu ada headline utama artikel, highlight 1 maksimal 300 huruf, paragraf 1 maksimal 370 huruf, paragraf 2 maksimal 290 huruf, highlight 2 maksimal 150 huruf, paragraf 3 maksimal 320 huruf, dan paragraf 4 maksimal 500 huruf. Formatkan hasilnya ke dalam JSON dengan struktur berikut: { \"headlineUtamaArtikel\": \"\",\"highlight1\": \"\", \"paragraf1\": \"\", \"image1\": \"\",\"paragraf2\": \"\", \"highlight2\": \"\", \"image2\": \"\", \"paragraf3\": \"\", \"image3\": \"\", \"paragraf4\", \"image4\":} tanpa ada tag html";
                    $responseArtikel = $api->post('/api/generate/text', $prompt);
                    
                    $artikel->category_id = getCategory($jsonObjectTrend['title']);
                    $artikel->slug = Str::slug($jsonObjectTrend['title'].'-'.Carbon::now()->format('Ymd'));
                    $artikel->headlineUtamaArtikel = $value['headlineUtamaArtikel'];
                    $artikel->highlight1 = $value['highlight1'];
                    $artikel->paragraf1 = $value['paragraf1'];
                    $artikel->paragraf2 = $value['paragraf2'];
                    $artikel->highlight2 = $value['highlight2'];
                    $artikel->paragraf3 = $value['paragraf3'];
                    $artikel->paragraf4 = $value['paragraf4'];
                    $artikel->save();

                    $topic->update([
                        'category_id' => $artikel->category_id,
                        'is_generated' => 'Y',
                    ]);
                }
    
    
            } catch (\Exception $e) {
                \Log::error('Error fetchArtikelByTrend get Artikel: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            \Log::error('Error fetchArtikelByTrend get News: ' . $e->getMessage());
        }
    }

    public function getCategory($judulArtikel){
        $api = new AiApi();
        $promptcategory = "Berdasarkan ".$jsonObjectTrend['title']." sebutkan kategori olahraga terkait berita tersebut. Formatkan hasilnya ke dalam JSON dengan struktur berikut: { \"kategori\": } tanpa ada tag html".
        $responsecategory = $api->post('/api/generate/text', $promptcategory);
        $rawResponsecategory = $responsecategory['data']['response'];
        $category_id = "";

        try{
            $jsonObjectcategory = $this->extractJsonObject($rawResponsecategory);
            // Cari di database
            foreach ($jsonObjectcategory as $value) {
                $kategoriApi = mb_strtolower(trim($value['kategori']), 'UTF-8');
                
                $kategori = Category::whereRaw('LOWER(name) = ?', [$kategoriApi])->first();
                if ($kategori) {
                    $category_id = $kategori->id;
                    break;
                }
            }

        } catch (\Exception $e) {
            // Tangani error
            // continue;
            // dd($e->getMessage());
        }

    }
}