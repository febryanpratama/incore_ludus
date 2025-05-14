<?php

namespace App\Jobs;

use App\Models\Artikel;
use App\Services\GenerateServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $artikel;

    public function __construct(Artikel $artikel)
    {
        $this->artikel = $artikel;
    }

    public function handle(GenerateServices $generateService)
    {
        try {
            // Call fetchPromptImage method on the injected GenerateServices instance
            $prompts = $generateService->fetchPromptImage($this->artikel);

            // Proceed with image generation logic
            if (empty($this->artikel->image1)) {
                foreach ($prompts as $prompt) {
                    $generateService->fetchImage($prompt, $this->artikel);
                    $this->artikel->refresh();

                    if (!empty($this->artikel->image1)) {
                        break;
                    }
                }
            }

            // Check for other images (if applicable)
            if (empty($this->artikel->image2)) {
                foreach ($prompts as $prompt) {
                    $generateService->fetchImage($prompt, $this->artikel);
                    $this->artikel->refresh();
                    
                    if (!empty($this->artikel->image2)) {
                        break;
                    }
                }
            }
            if (empty($this->artikel->image3)) {
                foreach ($prompts as $prompt) {
                    $generateService->fetchImage($prompt, $this->artikel);
                    $this->artikel->refresh();
                    
                    if (!empty($this->artikel->image2)) {
                        break;
                    }
                }
            }
            if (empty($this->artikel->image4)) {
                foreach ($prompts as $prompt) {
                    $generateService->fetchImage($prompt, $this->artikel);
                    $this->artikel->refresh();
                    
                    if (!empty($this->artikel->image2)) {
                        break;
                    }
                }
            }

        } catch (\Exception $e) {
            Log::error("Failed to generate image for artikel ID {$this->artikel->id}: " . $e->getMessage());
        }
    }
}
