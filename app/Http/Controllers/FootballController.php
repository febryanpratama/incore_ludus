<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Articles;
use App\Models\Engaging;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FootballController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::where('name', 'football')->first();
        if($categories==!null){
            $articles = Articles::where('category_id', $categories->id)->latest()->paginate(7);
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
        } else {
            $articles = [];
            $highlightPost = [];
            $sideHighlight = [];
            $trendingPosts = [];
        }

        return view('football.index', [
            'articles' => $articles,
            'highlightPost' => $highlightPost,
            'sideHighlight' => $sideHighlight,
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

        return view('football.show', [
            'article' => $article
        ]);
    }

    public function series($id)
    {
        $article = Articles::find($id);
        $eng = Engaging::where('artikel_id', $article->id)->first();
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

        return view('football.series', [
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

    public function viewAll(){
        $categories = Categories::where('name', 'football')->first();
        // Artikel baru dan yang sedang trending
        if($categories==!null){
            $articles = Articles::where('category_id', $categories->id)->latest()->paginate(16);
        } else {
            $articles = [];
        }
        
        return view('football.viewall', [
            'articles' => $articles
        ]);
    }

    public function viewHighlight(){
        $categories = Categories::where('name', 'football')->first();
        if($categories==!null){
            $articles = DB::table('artikels')
            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
            ->where('artikels.category_id', $categories->id)
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 7 days
            ->orderBy('engagings.count', 'desc')
            ->limit(40)
            ->get();
        } else {
            $articles = [];
        }
        return view('football.viewhighlight', [
            'articles' => $articles
        ]);
    }
}
