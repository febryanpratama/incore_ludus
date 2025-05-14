namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Jobs\CompressImageJob;

class CompressImageController extends Controller
{
    public function __invoke()
    {
        $folder = public_path('images_download');
        $images = File::files($folder);

        foreach ($images as $image) {
            CompressImageJob::dispatch($image->getPathname());
        }

        return response()->json([
            'message' => 'Compression jobs dispatched',
            'total_images' => count($images)
        ]);
    }
}
