<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Articles;
use Illuminate\Http\Request;

class TaekwondoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::where('name', 'taekwondo')->first();
        if($categories==!null){
            $articles = Articles::where('category_id', $categories->id)->latest()->paginate(7);
        } else {
            $articles = [];
        }

        return view('taekwondo.index', [
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

        return view('taekwondo.show', [
            'article' => $article
        ]);
    }

    public function series($id)
    {
        $article = Articles::find($id);
        // dd($article->image1);

        return view('taekwondo.series', [
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
        $categories = Categories::where('name', 'taekwondo')->first();
        // Artikel baru dan yang sedang trending
        if($categories==!null){
            $articles = Articles::where('category_id', $categories->id)->latest()->paginate(16);
        } else {
            $articles = [];
        }
        
        return view('taekwondo.viewall', [
            'articles' => $articles
        ]);
    }
}
