namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CompressImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $imagePath;

    public function __construct($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function handle()
    {
        $tempOutputPath = $this->imagePath . '_temp.jpg';

        for ($q = 20; $q <= 40; $q += 2) {
            $command = "ffmpeg -i " . escapeshellarg($this->imagePath) . " -q:v $q -y " . escapeshellarg($tempOutputPath);
            exec($command, $output, $returnVar);

            if (file_exists($tempOutputPath) && filesize($tempOutputPath) / 1024 <= 300) {
                File::move($tempOutputPath, $this->imagePath);
                Log::info("Compressed: " . $this->imagePath);
                return;
            }
        }

        Log::warning("Failed to compress: " . $this->imagePath);
    }
}
