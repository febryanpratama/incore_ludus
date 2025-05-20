@extends('layout.app')

@section('meta')
    @php
        $defaultKeywords = 'berita olahraga, update skor, hasil pertandingan, statistik olahraga, jadwal pertandingan, skor bola, jadwal liga, live score, NBA updates, transfer pemain, komunitas olahraga, forum olahraga, diskusi pertandingan, penggemar olahraga, live chat bola';

        $headline = trim($article->headlineUtamaArtikel ?? '');

        $keywords = strlen($headline) > 0
            ? implode(', ', preg_split('/\s+/', $headline))
            : $defaultKeywords;
    @endphp

    <meta name="keywords" content="{{ $keywords }}">
@endsection

@section('content')
<div class="container-fluid viewall">
    <form class="d-flex" role="search" method="GET" action="{{ route('basket.viewrecommendation') }}">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" value="{{ request()->input('search') }}">
      <button class="btn btn-outline-success" type="submit">
        <svg width="20" height="20" viewBox="0 0 20 20" aria-hidden="true" class="DocSearch-Search-Icon"><path d="M14.386 14.386l4.0877 4.0877-4.0877-4.0877c-2.9418 2.9419-7.7115 2.9419-10.6533 0-2.9419-2.9418-2.9419-7.7115 0-10.6533 2.9418-2.9419 7.7115-2.9419 10.6533 0 2.9419 2.9418 2.9419 7.7115 0 10.6533z" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
      </button>
    </form>
    <hr>
    <div class="row">
        <div class="col-4">
            <h5>Suggestions</h5>
        </div>
        <div class="col-8">
            <a href="{{ route('welcome') }}"><span class="badge text-bg-secondary">Sports</span></a>
            <a href="{{ route('football.index') }}"><span class="badge text-bg-secondary">Football</span></a>
            <a href="{{ route('badminton.index') }}"><span class="badge text-bg-secondary">Badminton</span></a>
            <a href="{{ route('basket.index') }}"><span class="badge text-bg-secondary">Basketball</span></a>
            <a href="{{ route('volley.index') }}"><span class="badge text-bg-secondary">Volley</span></a>
            <a href="{{ route('martialarts.index') }}"><span class="badge text-bg-secondary">Martial Arts and Others</span></a>
            <a href="{{ route('taekwondo.index') }}"><span class="badge text-bg-secondary">Taekwondo</span></a>
            <a href="{{ route('silat.index') }}"><span class="badge text-bg-secondary">Pencak Silat</span></a>
            <a href="{{ route('karate.index') }}"><span class="badge text-bg-secondary">Karate</span></a>
        </div>
    </div>
    <!-- Data artikel terbaru dan yang sedang trending -->
    <div class="row row-cols-lg-4 mb-5 mt-4">
        @if(count($articles) == 0)
            <p style="margin-bottom : 15%;">Data Kosong</p>
        @else
            @foreach ($articles as $article)
            <div class="col-lg-4 col-md-4 col-sm-12 mt-3 mb-4">
                <div class="card h-100 d-flex flex-column">
                            @if($article->type=='series')
                            <a href="{{route('football.series', $article->slug)}}">
                            @else
                            <a href="{{route('football.show', $article->slug)}}">
                            @endif
                        <div class="ratio ratio-4x3">
                        <img src="{{ asset('images_download/'.$article->image1) }}" class="card-img-top object-fit-cover w-100 h-100" style="object-position: center;" alt="{{$article->headlineUtamaArtikel}}">
                        </div>
                        </a>
                        <div class="card-body">
                            @if(\Carbon\Carbon::parse($article->created_at)->diff(now())->days <= 1)
                            <span class="badge text-bg-primary">New</span>
                            @endif
                            <span class="badge text-bg-danger">Trending</span>
                            <span class="badge text-bg-secondary">Football</span>
                            <!-- Button trigger modal -->
                            <a href="#" type="button" class="btn btn-danger report" data-bs-toggle="modal" data-bs-target="#reportModal">
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.5 11.6667C7.73611 11.6667 7.93417 11.5867 8.09417 11.4267C8.25417 11.2667 8.33389 11.0689 8.33333 10.8333C8.33278 10.5978 8.25278 10.4 8.09333 10.24C7.93389 10.08 7.73611 10 7.5 10C7.26389 10 7.06611 10.08 6.90667 10.24C6.74722 10.4 6.66722 10.5978 6.66667 10.8333C6.66611 11.0689 6.74611 11.2669 6.90667 11.4275C7.06722 11.5881 7.265 11.6678 7.5 11.6667ZM6.66667 8.33333H8.33333V3.33333H6.66667V8.33333ZM4.375 15L0 10.625V4.375L4.375 0H10.625L15 4.375V10.625L10.625 15H4.375ZM5.08333 13.3333H9.91667L13.3333 9.91667V5.08333L9.91667 1.66667H5.08333L1.66667 5.08333V9.91667L5.08333 13.3333Z" fill="#060606"/></svg>
                            </a>
                            @if($article->type=='series')
                            <h5 class="card-title"><a href="{{route('football.series', $article->slug)}}">{{$article->headlineUtamaArtikel}}</a></h5>
                            @else
                            <h5 class="card-title"><a href="{{route('football.show', $article->slug)}}">{{$article->headlineUtamaArtikel}}</a></h5>
                            @endif
                            <p class="card-text">{{ \Carbon\Carbon::parse($article->created_at)->format('d M Y') }} 
                            </p>
                        </div>
                    </div>
            </div>
            @endforeach
        @endif
        
    </div>
    {{ $articles->links() }}
</div>
<div class="mb-5"></div>
@endsection