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
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 7 days
            ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
            ->orderBy('artikels.created_at', 'desc')
            ->orderBy('engagings.count', 'desc')
            ->limit(5)
            ->select('artikels.*', 'categories.name as category_name') // Select category name as category_name
            ->get();
        if(count($trendingPosts) <5){
            $trendingPosts = DB::table('artikels')
            ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 7 days
            ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
            ->orderBy('artikels.created_at', 'desc')
            ->limit(5)
            ->select('artikels.*', 'categories.name as category_name') // Select category name as category_name
            ->get();
        }
        // $footballTranding = DB::table('artikels')
        //     ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
        //     ->join('categories', 'artikels.category_id', '=', 'categories.id')
        //     ->where('artikels.created_at', '>=', Carbon::now()->subDays(7))
        //     ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
        //     ->whereRaw('LOWER(categories.name) = ?', ['football'])
        //     ->select('artikels.*', 'categories.name as category_name')
        //     ->orderBy('engagings.count', 'desc')
        //     ->first();
        $footballTranding = [];
        if (!$footballTranding) {
            // $footballTranding = DB::table('artikels')
            //     ->join('categories', 'artikels.category_id', '=', 'categories.id')
            //     ->where('artikels.created_at', '>=', Carbon::now()->subDays(7))
            //     ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
            //     ->whereRaw('LOWER(categories.name) = ?', ['football'])
            //     ->orderBy('artikels.id', 'desc')
            //     ->select('artikels.*', 'categories.name as category_name')
            //     ->first();

            // if (!$footballTranding) {
            //     $footballTranding = [];
            // }
            $footballs = DB::table('artikels')
            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
            ->join('categories', 'artikels.category_id', '=', 'categories.id')
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(30))
            ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
            ->where(function ($query) {
                $query->where('categories.name', 'Football')
                    ->orWhere('categories.name', 'football');
            })
            ->select('artikels.*', 'categories.name as category_name')
            ->orderBy('engagings.count', 'desc')
            // ->skip(1)
            ->take(3)
            ->get();
                
            if (count($footballs) <3) {
                $footballs = DB::table('artikels')
                    ->join('categories', 'artikels.category_id', '=', 'categories.id')
                    ->where('artikels.created_at', '>=', Carbon::now()->subDays(30))
                    ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
                    ->where(function ($query) {
                        $query->where('categories.name', 'Football')
                            ->orWhere('categories.name', 'football');
                    })
                    ->select('artikels.*', 'categories.name as category_name')
                    ->orderBy('artikels.id', 'desc')
                    // ->skip(1)
                    ->take(3)
                    ->get();
        
                if (count($footballs) == 0) {
                    $footballs = [];
                }
            }

        } else{
            
            $footballs = DB::table('artikels')
            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
            ->join('categories', 'artikels.category_id', '=', 'categories.id')
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(30))
            ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
            ->where(function ($query) {
                $query->where('categories.name', 'Football')
                    ->orWhere('categories.name', 'football');
            })
            ->select('artikels.*', 'categories.name as category_name')
            ->orderBy('engagings.count', 'desc')
            ->take(3)
            ->get();
                
            if (count($footballs) <3) {
                $footballs = DB::table('artikels')
                    ->join('categories', 'artikels.category_id', '=', 'categories.id')
                    ->where('artikels.created_at', '>=', Carbon::now()->subDays(30))
                    ->where(function ($query) {
                        $query->where('categories.name', 'Football')
                            ->orWhere('categories.name', 'football');
                    })
                    ->select('artikels.*', 'categories.name as category_name')
                    ->orderBy('artikels.id', 'desc')
                    ->take(3)
                    ->get();
        
                if (count($footballs) == 0) {
                    $footballs = [];
                }
            }
        }

        $badmintons = DB::table('artikels')
            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
            ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
            ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
            ->where('categories.name', 'Badminton')
            ->orWhere('categories.name', 'badminton')
            ->select('artikels.*', 'categories.name as category_name')
            ->orderBy('engagings.count', 'desc')
            ->limit(3)
            ->get();
        if(count($badmintons)==0){
            $badmintons = DB::table('artikels')
                ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
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
        // dd($badmintons);

        $baskets = DB::table('artikels')
            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
            ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
            ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
            ->where('categories.name', 'Basket')
            ->orWhere('categories.name', 'basket')
            ->select('artikels.*', 'categories.name as category_name')
            ->orderBy('engagings.count', 'desc')
            ->limit(3)
            ->get();
        if(count($baskets)<3){
            $baskets = DB::table('artikels')
                ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
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
        // dd($baskets);
        $volleys = DB::table('artikels')
            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
            ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
            ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
            ->where('categories.name', 'Volley')
            ->orWhere('categories.name', 'volley')
            ->select('artikels.*', 'categories.name as category_name')
            ->orderBy('engagings.count', 'desc')
            ->limit(3)
            ->get();
        if(count($volleys)<3){
            $volleys = DB::table('artikels')
                ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
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
        // dd($volleys);
        $martialarts = DB::table('artikels')
            ->join('engagings', 'artikels.id', '=', 'engagings.artikel_id')
            ->join('categories', 'artikels.category_id', '=', 'categories.id') // Join with categories table
            ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
            ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
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
                ->where('artikels.created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
                ->whereRaw("image1 IS NOT NULL AND TRIM(image1) != ''")
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
        return view('test', [
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
