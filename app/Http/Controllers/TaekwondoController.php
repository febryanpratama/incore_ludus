<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Articles;
use App\Models\Engaging;
use App\Models\ArticleClick;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TaekwondoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Categories::where('name', 'taekwondo')
            ->orWhere('name', 'Taekwondo')
            ->first();
        $user = auth()->user();
        if($categories==!null){
            if($request->search!=null){
                $articles = Articles::where('category_id', $categories->id)
                    ->where('headlineUtamaArtikel', 'LIKE', '%' . $request->search . '%')
                    ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
                    ->latest()->paginate(7);
            } else {
                $articles = Articles::where('category_id', $categories->id)
                ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
                ->latest()->paginate(7);
            }
            $highlightPost = DB::table('artikels')
                ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
                ->where('artikels.category_id', $categories->id) // Filter by specific category
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(14)) // Filter articles from last 14 days
                ->whereRaw("artikels.image1 IS NOT NULL AND TRIM(image1) != ''")
                ->select(
                    'artikels.*', 
                    'categories.name as category_name', // Example of selecting category name
                    'engagings.count as engagements_count' // Selecting the actual engagements count column
                )
                ->orderByDesc('engagings.count') // Correctly order by engagements count
                ->first(); // Get the most engaged article
            
            $trendingPosts = DB::table('artikels')
                ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
                ->where('artikels.category_id', $categories->id) // Filter by specific category
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(14)) // Filter articles from last 14 days
                ->whereRaw("artikels.image1 IS NOT NULL AND TRIM(image1) != ''")
                ->select(
                    'artikels.*', 
                    'categories.name as category_name', // Example of selecting category name
                    'engagings.count as engagements_count' // Selecting the actual engagements count column
                )
                ->orderByDesc('engagings.count') // Correctly order by engagements count
                ->skip(4)                   // Skip the first post (index starts at 0)
                ->take(3)                   // Take the next 3 posts (2nd, 3rd, and 4th)
                ->get();
            $sideHighlight = DB::table('artikels')
                ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
                ->where('artikels.category_id', $categories->id) // Filter by specific category
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(14)) // Filter articles from last 14 days
                ->whereRaw("artikels.image1 IS NOT NULL AND TRIM(image1) != ''")
                ->select(
                    'artikels.*', 
                    'categories.name as category_name', // Example of selecting category name
                    'engagings.count as engagements_count' // Selecting the actual engagements count column
                )
                ->orderByDesc('engagings.count') // Correctly order by engagements count
                ->skip(1)                   // Skip the first post (index starts at 0)
                ->take(3)                   // Take the next 3 posts (2nd, 3rd, and 4th)
                ->get();
                
            if($user!=null) {
                $articleClick = ArticleClick::where('category_id', $categories->id)->where('user_id', $user->id)->first();
                if($articleClick!=null){
                    $recommendations = Articles::where('category_id', $categories->id)
                    ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
                    ->latest()->paginate(2);
                } else {
                    $recommendations = DB::table('artikels')
                        ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                        ->where('artikels.category_id', $categories->id)
                        ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                        ->whereRaw("artikels.image1 IS NOT NULL AND TRIM(image1) != ''")
                        ->orderBy('engagings.count', 'desc')
                        ->paginate(2);
                }
            } else {
                $recommendations = DB::table('artikels')
                    ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                    ->where('artikels.category_id', $categories->id)
                    ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                    ->whereRaw("artikels.image1 IS NOT NULL AND TRIM(image1) != ''")
                    ->orderBy('engagings.count', 'desc')
                    ->paginate(2);
            }
        } else {
            $articles = [];
            $highlightPost = [];
            $trendingPosts = [];
            $recommendations = [];
            $sideHighlight = [];
        }

        return view('taekwondo.index', [
            'articles' => $articles,
            'highlightPost' => $highlightPost,
            'sideHighlight' => $sideHighlight,
            'recommendations' => $recommendations,
            'trendingPosts' => $trendingPosts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Articles::where('slug', $id)->first();

        if(!$article) {
            return redirect()->route('taekwondo.index');
        }
        $eng = Engaging::where('artikel_id', $article->id)->first();
        $user = auth()->user(); // Get the authenticated user
        if($user!=null) {
            $articleClick = ArticleClick::where('category_id', $article->category_id)->where('user_id', $user->id)->first();
            if($articleClick==null){
                $articleClick = ArticleClick::create([
                    'user_id' => $user->id,
                    'category_id' => $article->category_id,
                    'clicked_at' => now()
                ]);
            }  
        }
        if($eng==!null){
            $eng->update([
                'count' => $eng->count + 1
            ]);
        } else {
            $eng = Engaging::create([
                'artikel_id' => $article->id,
                'count' => 1
            ]);
        }

        $recommendations = DB::table('artikels')
            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
            ->whereRaw("artikels.image1 IS NOT NULL AND TRIM(image1) != ''")
            ->orderBy('artikels.created_at', 'desc')
            ->paginate(4);

        return view('taekwondo.show', [
            'article' => $article,
            'recommendations' => $recommendations
        ]);
    }

    public function series($id, Request $request)
    {
        $article = Articles::where('slug', $id)->first();

        if(!$article) {
            return redirect()->route('taekwondo.index');
        }
        $eng = Engaging::where('artikel_id', $article->id)->first();
        $user = auth()->user(); // Get the authenticated user
        if($user!=null) {
            $articleClick = ArticleClick::where('category_id', $article->category_id)->where('user_id', $user->id)->first();
            if($articleClick==null){
                $articleClick = ArticleClick::create([
                    'user_id' => $user->id,
                    'category_id' => $article->category_id,
                    'clicked_at' => now()
                ]);
            } 
        }
        $recommendations = DB::table('artikels')
            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
            ->whereRaw("artikels.image1 IS NOT NULL AND TRIM(image1) != ''")
            ->orderBy('artikels.created_at', 'desc')
            ->paginate(4);
        if($eng==!null){
            $eng->update([
                'count' => $eng->count + 1
            ]);
        } else {
            $eng = Engaging::create([
                'artikel_id' => $article->id,
                'count' => 1
            ]);
        }

        // Get the current page from the query parameter (default to 1 if not provided)
        $currentPage = $request->input('number', 1);

        // Get the previous and next articles based on the categories
        $previousArticle = Articles::where('category_id', $article->category_id)
            ->where('type', 'series')
            ->where('id', '<', $article->id)
            ->whereRaw("artikels.image1 IS NOT NULL AND TRIM(image1) != ''")
            ->orderBy('id', 'desc')
            ->first();

        $nextArticle = Articles::where('category_id', $article->category_id)
            ->where('type', 'series')
            ->where('id', '>', $article->id)
            ->whereRaw("artikels.image1 IS NOT NULL AND TRIM(image1) != ''")
            ->orderBy('id', 'asc')
            ->first();
        
        // Get the page numbers for previous and next
        $previousPage = $previousArticle ? $this->getPageForArticle($previousArticle->id, $currentPage) : null;
        $nextPage = $nextArticle ? $this->getPageForArticle($nextArticle->id, $currentPage) : null;


        return view('taekwondo.series', [
            'article' => $article,
            'recommendations' => $recommendations,
            'previousArticle' => $previousArticle,
            'nextArticle' => $nextArticle,
            'previousPage' => $previousPage,
            'nextPage' => $nextPage
        ]);
    }

    // Helper function to calculate the page number of an article based on its ID
    protected function getPageForArticle($articleId, $currentPage)
    {
        $perPage = 1; // Number of articles per page

        // Count how many articles are before the current article (with ID less than $articleId)
        $articleIndex = Articles::where('id', '<', $articleId)->count();

        // Calculate the page number based on the article index
        return (int) floor($articleIndex / $perPage) + 1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function viewAll(Request $request){
        $categories = Categories::where('name', 'taekwondo')->orWhere('name', 'Taekwondo')->first();
        if($request->search!=null){
            if($categories==!null){
                $articles = Articles::where('category_id', $categories->id)
                    ->where('headlineUtamaArtikel', 'LIKE', '%' . $request->search . '%')
                    ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
                    ->latest()->paginate(20);
            } else {
                $articles = [];
            }
        } else {
            if($categories==!null){
                $articles = Articles::where('category_id', $categories->id)
                ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
                ->latest()->paginate(20);
            } else {
                $articles = [];
            }
        }
        
        return view('taekwondo.viewall', [
            'articles' => $articles
        ]);
    }

    public function viewHighlight(Request $request){
        $categories = Categories::where('name', 'taekwondo')->orWhere('name', 'Taekwondo')->first();
        if($request->search!=null){
            if($categories==!null){
                $articles = DB::table('artikels')
                ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                ->where('artikels.category_id', $categories->id)
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                ->where('artikels.headlineUtamaArtikel', 'LIKE', '%' . $request->search . '%')
                ->whereRaw("artikels.image1 IS NOT NULL AND TRIM(image1) != ''")
                ->orderBy('engagings.count', 'desc')
                ->paginate(20);
            } else {
                $articles = [];
            }
        } else {
            if($categories==!null){
                $articles = DB::table('artikels')
                ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                ->where('artikels.category_id', $categories->id)
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                ->whereRaw("artikels.image1 IS NOT NULL AND TRIM(image1) != ''")
                ->orderBy('engagings.count', 'desc')
                ->paginate(20);
            } else {
                $articles = [];
            }
        }

        return view('taekwondo.viewhighlight', [
            'articles' => $articles
        ]);
    }

    public function viewRecommendation(Request $request) {
        $categories = Categories::where('name', 'taekwondo')
            ->orWhere('name', 'Taekwondo')
            ->first();
        $user = auth()->user(); // Get the authenticated user

        if($request->search!=null) {
            if($categories==!null){
                if($user!=null){
                    $articleClick = ArticleClick::where('category_id', $categories->id)
                        ->where('user_id', $user->id)
                        ->first();
                    if($articleClick!=null){
                        $recommendations = Articles::where('category_id', $categories->id)
                        ->where('headlineUtamaArtikel', 'LIKE', '%' . $request->search . '%')
                        ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
                        ->latest()->paginate(2);
                    } else {
                        $recommendations = DB::table('artikels')
                            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                            ->where('artikels.category_id', $categories->id)
                            ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                            ->where('headlineUtamaArtikel', 'LIKE', '%' . $request->search . '%')
                            ->whereRaw("artikels.image1 IS NOT NULL AND TRIM(image1) != ''")
                            ->orderBy('engagings.count', 'desc')
                            ->paginate(20);
                    }
                } else {
                    $recommendations = DB::table('artikels')
                        ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                        ->where('artikels.category_id', $categories->id)
                        ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                        ->where('headlineUtamaArtikel', 'LIKE', '%' . $request->search . '%')
                        ->whereRaw("artikels.image1 IS NOT NULL AND TRIM(image1) != ''")
                        ->orderBy('engagings.count', 'desc')
                        ->paginate(20);
                }
            } else {
                $recommendations = [];
            }
        } else {
            if($categories==!null){
                if($user!=null){
                    $articleClick = ArticleClick::where('category_id', $categories->id)->where('user_id', $user->id)->first();
                    if($articleClick!=null){
                        $recommendations = Articles::where('category_id', $categories->id)
                        ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
                        ->latest()->paginate(2);
                    } else {
                        $recommendations = DB::table('artikels')
                            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                            ->where('artikels.category_id', $categories->id)
                            ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                            ->whereRaw("artikels.image1 IS NOT NULL AND TRIM(image1) != ''")
                            ->orderBy('engagings.count', 'desc')
                            ->paginate(20);
                    }
                } else {
                    $recommendations = DB::table('artikels')
                        ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                        ->where('artikels.category_id', $categories->id)
                        ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                        ->whereRaw("artikels.image1 IS NOT NULL AND TRIM(image1) != ''")
                        ->orderBy('engagings.count', 'desc')
                        ->paginate(20);
                }
            } else {
                $recommendations = [];
            }
        }

        return view('taekwondo.viewrecommendation', [
            'recommendations' => $recommendations
        ]);
    }
}
