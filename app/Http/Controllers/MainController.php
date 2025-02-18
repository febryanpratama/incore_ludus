<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Articles;
use App\Models\Engaging;
use App\Models\ArticleClick;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::get();

        $trendingPosts = DB::table('artikels')
            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
            ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
            ->orderBy('engagings.count', 'desc')
            ->limit(3)
            ->select('artikels.*', 'categories.name as category_name') // Select category name as category_name
            ->get();
            $footballTranding = DB::table('artikels')
            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
            ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
            ->where(function ($query) {
                $query->where('categories.name', 'Football')
                      ->orWhere('categories.name', 'football');
            })
            ->select('artikels.*', 'categories.name as category_name')
            ->orderBy('engagings.count', 'desc')
            ->first();
        
        if($footballTranding==null){
            $footballTranding = DB::table('artikels')
                ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
                ->where(function ($query) {
                    $query->where('categories.name', 'Football')
                        ->orWhere('categories.name', 'football');
                })
                ->orderBy('artikels.id', 'desc')
                ->select('artikels.*', 'categories.name as category_name')
                ->first();

                if($footballTranding==null){
                    $footballTranding = [];
                }
        }
        $footballs = DB::table('artikels')
            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
            ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
            ->where('categories.name', 'Football')
            ->orWhere('categories.name', 'football')
            ->select('artikels.*', 'categories.name as category_name')
            ->orderBy('engagings.count', 'desc')
            ->skip(1)                   // Skip the first post (index starts at 0)
            ->take(2)                   // Take the next 2 posts (2nd, 3rd)
            ->get();
        if(count($footballs)==0) {
            $footballs = DB::table('artikels')
                ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
                ->where('categories.name', 'Football')
                ->orWhere('categories.name', 'football')
                ->select('artikels.*', 'categories.name as category_name')
                ->orderBy('artikels.id', 'desc')
                ->skip(1)                   // Skip the first post (index starts at 0)
                ->take(2)                   // Take the next 2 posts (2nd, 3rd)
                ->get();
            if(count($footballs)==0) {
                $footballs = [];
            }
        }

        $badmintons = DB::table('artikels')
            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
            ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
            ->where('categories.name', 'Badminton')
            ->orWhere('categories.name', 'badminton')
            ->select('artikels.*', 'categories.name as category_name')
            ->orderBy('engagings.count', 'desc')
            ->limit(3)
            ->get();
        if(count($badmintons)==0){
            $badmintons = DB::table('artikels')
                ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
                ->where('categories.name', 'Badminton')
                ->orWhere('categories.name', 'badminton')
                ->select('artikels.*', 'categories.name as category_name')
                ->orderBy('artikels.id', 'desc')
                ->limit(3)
                ->get();
            if(count($badmintons)==0) {
                $badmintons = [];
            }
        }
        $baskets = DB::table('artikels')
            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
            ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
            ->where('categories.name', 'Basket')
            ->orWhere('categories.name', 'basket')
            ->select('artikels.*', 'categories.name as category_name')
            ->orderBy('engagings.count', 'desc')
            ->limit(3)
            ->get();
        if(count($baskets)<30){
            $baskets = DB::table('artikels')
                ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
                ->where('categories.name', 'Basket')
                ->orWhere('categories.name', 'basket')
                ->select('artikels.*', 'categories.name as category_name')
                ->orderBy('artikels.id', 'desc')
                ->limit(3)
                ->get();
            if(count($baskets)==0) {
                $baskets = [];
            }
        }
        $volleys = DB::table('artikels')
            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
            ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
            ->where('categories.name', 'Volley')
            ->orWhere('categories.name', 'volley')
            ->select('artikels.*', 'categories.name as category_name')
            ->orderBy('engagings.count', 'desc')
            ->limit(3)
            ->get();
        if(count($volleys)<3){
            $volleys = DB::table('artikels')
                ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
                ->where('categories.name', 'Volley')
                ->orWhere('categories.name', 'volley')
                ->select('artikels.*', 'categories.name as category_name')
                ->orderBy('artikels.id', 'desc')
                ->limit(3)
                ->get();
            if(count($volleys)==0) {
                $volleys = [];
            }
        }
        $martialarts = DB::table('artikels')
            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
            ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
            ->where('name', 'martialarts')
            ->orWhere('name', 'martial arts')
            ->orWhere('name', 'Martial Arts')
            ->orWhere('name', 'Martial arts')
            ->orWhere('name', 'taekwondo')
            ->orWhere('name', 'Taekwondo')
            ->orWhere('name', 'pencaksilat')
            ->orWhere('name', 'pencak silat')
            ->orWhere('name', 'Pencak Silat')
            ->orWhere('name', 'Pencak silat')
            ->orWhere('name', 'karate')
            ->orWhere('name', 'Karate')
            ->select('artikels.*', 'categories.name as category_name')
            ->orderBy('engagings.count', 'desc')
            ->limit(3)
            ->get();
        if(count($martialarts)<3){
            $martialarts = DB::table('artikels')
                ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
                ->where('name', 'martialarts')
                ->orWhere('name', 'martial arts')
                ->orWhere('name', 'Martial Arts')
                ->orWhere('name', 'Martial arts')
                ->orWhere('name', 'taekwondo')
                ->orWhere('name', 'Taekwondo')
                ->orWhere('name', 'pencaksilat')
                ->orWhere('name', 'pencak silat')
                ->orWhere('name', 'Pencak Silat')
                ->orWhere('name', 'Pencak silat')
                ->orWhere('name', 'karate')
                ->orWhere('name', 'Karate')
                ->select('artikels.*', 'categories.name as category_name')
                ->orderBy('artikels.id', 'desc')
                ->limit(3)
                ->get();
            if(count($martialarts)==0) {
                $martialarts = [];
            }
        }
        
            // dd($badmintons);
        return view('welcome', [
            'trendingPosts' => $trendingPosts,
            'footballs' => $footballs,
            'footballTranding' => $footballTranding,
            'badmintons' => $badmintons,
            'baskets' => $baskets,
            'volleys' => $volleys,
            'martialarts' => $martialarts
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
        //
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
}
