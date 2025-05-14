<?php

namespace App\Http\Controllers;

use App\Services\GenerateServices;
use App\Models\Artikel;
use App\Jobs\GenerateImageJob;

class GenerateImageQueueController extends Controller
{
    protected $generateService;

    // Inject GenerateService into the controller
    public function __construct(GenerateServices $generateService)
    {
        $this->generateService = $generateService; // Initialize the property
    }

    public function regenerateImages()
    {
        // Fetch all Artikel entries with null values for image1, image2, image3, or image4
        $artikels = Artikel::whereNull('image1')
            ->whereNull('image2')
            ->whereNull('image3')
            ->whereNull('image4')
            ->get();

        $dispatchedCount = 0;
        $failedCount = 0;

        foreach ($artikels as $artikel) {
            try {
                GenerateImageJob::dispatch($artikel);
                $dispatchedCount++;
            } catch (\Exception $e) {
                // Log the error or handle it as needed
                \Log::error("Failed to dispatch job for artikel ID {$artikel->id}: " . $e->getMessage());
                $failedCount++;
            }
        }


        return response()->json([
            'message' => 'Image generation jobs dispatched for ' . count($artikels) . ' articles.'
        ]);
    }
}

