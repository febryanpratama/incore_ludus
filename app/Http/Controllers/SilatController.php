<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Articles;
use App\Models\Engaging;
use App\Models\ArticleClick;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SilatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Categories::where('name', 'pencaksilat')
            ->orWhere('name', 'pencak silat')
            ->orWhere('name', 'Pencak Silat')
            ->orWhere('name', 'Pencak silat')
            ->first();
        $user = auth()->user();
        if($categories==!null){
            if($request->search!=null){
                $articles = Articles::where('category_id', $categories->id)
                    ->where('headlineUtamaArtikel', 'LIKE', '%' . $request->search . '%')
                    ->latest()->paginate(7);
            } else {
                $articles = Articles::where('category_id', $categories->id)->latest()->paginate(7);
            }
            $highlightPost = DB::table('artikels')
                    ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                    ->where('artikels.category_id', $categories->id)
                    ->where('artikels.created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
                    ->orderBy('engagings.count', 'desc')
                    ->first();
            $trendingPosts = DB::table('artikels')
                    ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                    ->where('artikels.category_id', $categories->id)
                    ->where('artikels.created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
                    ->orderBy('engagings.count', 'desc')
                    ->limit(7)
                    ->get();
            $sideHighlight = DB::table('artikels')
                ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                ->where('artikels.category_id', $categories->id)
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
                ->orderBy('engagings.count', 'desc')
                ->skip(1)                   // Skip the first post (index starts at 0)
                ->take(3)                   // Take the next 3 posts (2nd, 3rd, and 4th)
                ->get();
            if($user!=null) {
                $articleClick = ArticleClick::where('category_id', $categories->id)->where('user_id', $user->id)->first();
                if($articleClick!=null){
                    $recommendations = Articles::where('category_id', $categories->id)->latest()->paginate(2);
                } else {
                    $recommendations = DB::table('artikels')
                        ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                        ->where('artikels.category_id', $categories->id)
                        ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                        ->orderBy('engagings.count', 'desc')
                        ->paginate(2);
                }
            } else {
                $recommendations = DB::table('artikels')
                    ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                    ->where('artikels.category_id', $categories->id)
                    ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
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

        return view('silat.index', [
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
        $article = Articles::find($id);
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

        return view('silat.show', [
            'article' => $article
        ]);
    }

    public function series($id)
    {
        $article = Articles::find($id);
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

        return view('silat.series', [
            'article' => $article
        ]);
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
        $categories = Categories::where('name', 'pencaksilat')
            ->orWhere('name', 'pencak silat')
            ->orWhere('name', 'Pencak Silat')
            ->orWhere('name', 'Pencak silat')
            ->first();
        if($request->search!=null){
            if($categories==!null){
                $articles = Articles::where('category_id', $categories->id)
                    ->where('headlineUtamaArtikel', 'LIKE', '%' . $request->search . '%')
                    ->latest()->paginate(20);
            } else {
                $articles = [];
            }
        } else {
            if($categories==!null){
                $articles = Articles::where('category_id', $categories->id)->latest()->paginate(20);
            } else {
                $articles = [];
            }
        }
        
        return view('silat.viewall', [
            'articles' => $articles
        ]);
    }

    public function viewHighlight(Request $request){
        $categories = Categories::where('name', 'pencaksilat')
            ->orWhere('name', 'pencak silat')
            ->orWhere('name', 'Pencak Silat')
            ->orWhere('name', 'Pencak silat')
            ->first();
        if($request->search!=null){
            if($categories==!null){
                $articles = DB::table('artikels')
                ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                ->where('artikels.category_id', $categories->id)
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                ->where('artikels.headlineUtamaArtikel', 'LIKE', '%' . $request->search . '%')
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
                ->orderBy('engagings.count', 'desc')
                ->paginate(20);
            } else {
                $articles = [];
            }
        }

        return view('silat.viewhighlight', [
            'articles' => $articles
        ]);
    }

    public function viewRecommendation(Request $request) {
        $categories = Categories::where('name', 'pencaksilat')
            ->orWhere('name', 'pencak silat')
            ->orWhere('name', 'Pencak Silat')
            ->orWhere('name', 'Pencak silat')
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
                        ->latest()->paginate(2);
                    } else {
                        $recommendations = DB::table('artikels')
                            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                            ->where('artikels.category_id', $categories->id)
                            ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                            ->where('headlineUtamaArtikel', 'LIKE', '%' . $request->search . '%')
                            ->orderBy('engagings.count', 'desc')
                            ->paginate(20);
                    }
                } else {
                    $recommendations = DB::table('artikels')
                        ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                        ->where('artikels.category_id', $categories->id)
                        ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                        ->where('headlineUtamaArtikel', 'LIKE', '%' . $request->search . '%')
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
                        $recommendations = Articles::where('category_id', $categories->id)->latest()->paginate(2);
                    } else {
                        $recommendations = DB::table('artikels')
                            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                            ->where('artikels.category_id', $categories->id)
                            ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                            ->orderBy('engagings.count', 'desc')
                            ->paginate(20);
                    }
                } else {
                    $recommendations = DB::table('artikels')
                        ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
                        ->where('artikels.category_id', $categories->id)
                        ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                        ->orderBy('engagings.count', 'desc')
                        ->paginate(20);
                }
            } else {
                $recommendations = [];
            }
        }

        return view('silat.viewrecommendation', [
            'recommendations' => $recommendations
        ]);
    }
}
