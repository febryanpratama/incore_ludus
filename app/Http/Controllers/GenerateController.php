<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Services\GenerateServices;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Articles;

class GenerateController extends Controller
{
    //
    protected $generateServices;

    public function __construct(GenerateServices $generateServices)
    {
        $this->generateServices = $generateServices;
    }

    public function generateTitle($cat_id)
    {
        $resp = $this->generateServices->generateTitle($cat_id);

        return response()->json($resp);
    }

    public function generateArtikel()
    {

        $resp = $this->generateServices->generateArtikel();
    }

    public function generateArtikelCat($cat_id)
    {

        $resp = $this->generateServices->generateArtikelCatId($cat_id);
    }

    public function generateRandomImage()
    {
        $resp = $this->generateServices->generateRandomImage();
    }

    public function generateImageId()
    {
        $resp = $this->generateServices->generateImage();
    }

    public function generateNewsbyTrend()
    {
        // $topik = $this->generateServices->fetchListTrending();

        $resp = $this->generateServices->fetchArtikelByTrend();
        if ($resp) {
            var_dump("New topic created.");
            \Log::info('New topic created.');
        } else {
            var_dump("No new topic not created.");
            \Log::info('No new topic not created.');
        }
    }

    public function regenerateImagesDeepAi(){
        $artikels = Articles::whereNull('image1')
        ->take(2)
        ->orderBy('created_at', 'desc')
        ->get();
        foreach ($artikels as $artikel) {
            $resp = $this->generateServices->generateFromDeepAi($artikel->headlineUtamaArtikel, $artikel);
            if($resp){
                var_dump("New image created.".$artikel->healineUtamaArtikel);
                \Log::info('New image created.'.$artikel->id);
            }else{
                var_dump("No new image not created.");
                \Log::info('No new image not created.');
            }
        }
    }
}
