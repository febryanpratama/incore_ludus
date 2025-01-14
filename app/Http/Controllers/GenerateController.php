<?php

namespace App\Http\Controllers;

use App\Services\GenerateServices;
use Illuminate\Http\Request;

class GenerateController extends Controller
{
    //
    protected $generateServices;

    public function __construct(GenerateServices $generateServices)
    {
        $this->generateServices = $generateServices;
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
