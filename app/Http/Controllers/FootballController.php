<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Articles;
use Illuminate\Http\Request;

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
        $articles = Articles::where('category_id', $categories->id)->latest()->paginate(7);

        return view('football.index', [
            'articles' => $articles
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

        return view('football.show', [
            'article' => $article
        ]);
    }

    public function series($id)
    {
        $article = Articles::find($id);
        // dd($article->image1);

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
        $articles = Articles::where('category_id', $categories->id)->latest()->paginate(16);
        
        return view('football.viewall', [
            'articles' => $articles
        ]);
    }
}
