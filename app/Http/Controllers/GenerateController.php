<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Services\GenerateServices;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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

    public function generateImage()
    {
        $resp = $this->generateServices->generateImage();
    }
}
