<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CompressImageController extends Controller
{
    public function compressAll()
    {
        $folderPath = public_path('images_download');
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        $files = File::files($folderPath);
        $results = [];

        foreach ($files as $file) {
            $filename = $file->getFilename();
            $extension = strtolower($file->getExtension());

            if (!in_array($extension, $allowedExtensions)) {
                continue;
            }

            $fileSizeKB = filesize($file->getRealPath()) / 1024;
            if ($fileSizeKB <= 300) {
                continue;
            }

            $sourcePath = $file->getRealPath();
            $tempOutputPath = $folderPath . '/compressed_' . $filename;

            $compressed = false;
            for ($q = 14; $q <= 40; $q += 2) {
                $command = "ffmpeg -i " . escapeshellarg($sourcePath)
                         . " -q:v $q -y " . escapeshellarg($tempOutputPath);
                exec($command . ' 2>&1', $output, $returnCode);

                if (file_exists($tempOutputPath) && filesize($tempOutputPath) / 1024 <= 300) {
                    $compressed = true;
                    break;
                }
            }

            if ($compressed) {
                // File::delete($sourcePath);
                // File::move($tempOutputPath, $sourcePath);
                $backupPath = $sourcePath . '.bak';
                File::move($sourcePath, $backupPath);
                File::move($tempOutputPath, $sourcePath);
                $results[] = "✅ Compressed: $filename";
            } else {
                if (file_exists($tempOutputPath)) {
                    File::delete($tempOutputPath);
                }
                $results[] = "❌ Failed: $filename";
            }
        }

        return response()->json($results);
    }
}
