@extends('layout.app')

@section('content')
    <!-- data artikel populer this week -->
    <div class="container-fluid pg1">
        <div class="container">
            <div class="row row1">
                <div class="col">
                </div>
                <div class="col">
                </div>
                <div class="col-6 overflow-y-auto">
                    <h3>Popular this week</h3>
                    @if($trendingPosts==null)
                        <p>Data Kosong</p>
                    @else 
                        @foreach($trendingPosts as $trending)
                        <div class="card mb-1">
                            <div class="row">
                                <div class="col-4">
                                <img src="{{asset('storage/images_download/'.$trending->image1)}}" class="img-fluid rounded-start" alt="{{$trending->headlineUtamaArtikel}}">
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <span class="card-text"><small>{{ \Carbon\Carbon::parse($trending->created_at)->diffForHumans()}}</small></span>
                                        @if($trending->type=='series')
                                            @if($trending->category_name == "Badminton" || $trending->category_name == "badminton")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('badminton.series', $trending->id)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "Basket" || $trending->category_name == "basket")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('basket.series', $trending->id)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "volley" || $trending->category_name == "Volley")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('volley.series', $trending->id)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "taekwondo" || $trending->category_name == "Taekwondo")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('taekwondo.series', $trending->id)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "Karate" || $trending->category_name == "karate")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('karate.series', $trending->id)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "Pencak Silat" || $trending->category_name == "pencak silat" || $trending->category_name == "Pencak silat" || $trending->category_name == "pencak Silat" || $trending->category_name == "silat" || $trending->category_name == "Silat")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('silat.series', $trending->id)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "football" || $trending->category_name == "Football")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('football.series', $trending->id)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @endif
                                        @else
                                            @if($trending->category_name == "Badminton" || $trending->category_name == "badminton")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('badminton.show', $trending->id)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "Basket" || $trending->category_name == "basket")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('basket.show', $trending->id)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "volley" || $trending->category_name == "Volley")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('volley.show', $trending->id)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "taekwondo" || $trending->category_name == "Taekwondo")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('taekwondo.show', $trending->id)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "Karate" || $trending->category_name == "karate")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('karate.show', $trending->id)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "Pencak Silat" || $trending->category_name == "pencak silat" || $trending->category_name == "Pencak silat" || $trending->category_name == "pencak Silat" || $trending->category_name == "silat" || $trending->category_name == "Silat")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('silat.show', $trending->id)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "football" || $trending->category_name == "Football")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('football.show', $trending->id)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Data artikel Football terbaru dan terpopuler -->
    <div class="container-fluid pg2">
        <div class="row">
            <div class="col-4">
                <div class="text1">
                    <h1>Foot<span>actball</span><a href="#" type="button"><img src="{{ asset('img/Component3.png') }}" alt=""></a></h1>
                </div>
            </div>
            <div class="col-8">
                <div id="carouselExampleCaptions" class="carousel slide">
                    <div class="carousel-inner">
                        @if($footballTranding==null)
                        <p>Data Kosong</p>
                        @else 
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/images_download/'.$footballTranding->image1) }}" class="d-block w-100" alt="{{$footballTranding->headlineUtamaArtikel}}">
                            <div class="carousel-caption d-none d-md-block">
                                @if($footballTranding->type=='series')
                                <h1><a class="text-text-decoration-none text-white" href="{{route('football.series', $footballTranding->id)}}">{{$footballTranding->headlineUtamaArtikel}}</a></h1>
                                @else
                                <h1><a class="text-text-decoration-none text-white" href="{{route('football.show', $footballTranding->id)}}">{{$footballTranding->headlineUtamaArtikel}}</a></h1>
                                @endif
                                <div class="row">
                                    <div class="col-5"></div>
                                    <div class="col-5">
                                        <p><small>{{ \Carbon\Carbon::parse($footballTranding->created_at)->diffForHumans()}}</small></p>
                                    </div>
                                    <div class="col-5">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($footballs==null)
                        <p>Data Kosong</p>
                        @else 
                            @foreach($footballs as $fb)
                            <div class="carousel-item">
                                <img src="{{ asset('storage/images_download/'.$fb->image1) }}" class="d-block w-100" alt="{{$fb->headlineUtamaArtikel}}">
                                <div class="carousel-caption d-none d-md-block">
                                    <!-- <h1>FTimnas U-23 Indonesia VS Timnas U-23 Argentina</h1> -->
                                    @if($fb->type=='series')
                                    <h1><a class="text-text-decoration-none text-white" href="{{route('football.series', $fb->id)}}">{{$fb->headlineUtamaArtikel}}</a></h1>
                                    @else
                                    <h1><a class="text-text-decoration-none text-white" href="{{route('football.show', $fb->id)}}">{{$fb->headlineUtamaArtikel}}</a></h1>
                                    @endif
                                    <div class="row">
                                        <div class="col-2">
                                            <p><small>{{ \Carbon\Carbon::parse($fb->created_at)->diffForHumans()}}</small></p>
                                        </div>
                                        <div class="col-10">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Data artikel Badminton terbaru dan terpopuler -->
    <div class="container-fluid pg3">
        <div class="row">
            <div class="col-7">
                <div class="row">
                    @if($badmintons==null)
                        <p>Data Kosong</p>
                    @else 
                        @foreach($badmintons as $bm)
                            <div class="col-4">
                                <img src="{{ asset('storage/images_download/'.$bm->image1) }}" alt="{{$bm->headlineUtamaArtikel}}">
                                @if(preg_match('/^([a-zA-Z\s]+)(?=:)|(?<=: )([a-zA-Z\s]+)$/', $bm->headlineUtamaArtikel, $matches))
                                    @if($bm->type=='series')
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('badminton.series', $bm->id)}}">{{ $matches[1] ?? $matches[2]}}</a></h5>
                                    @else
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('badminton.show', $bm->id)}}">{{ $matches[1] ?? $matches[2]}}</a></h5>
                                    @endif
                                @elseif(preg_match('/\b([A-Z][a-z]+(?:\s[A-Z][a-z]+)+)\b/', $bm->headlineUtamaArtikel, $matches))
                                    @if($bm->type=='series')
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('badminton.series', $bm->id)}}">{{ $matches[0]}}</a></h5>
                                    @else
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('badminton.show', $bm->id)}}">{{ $matches[0]}}</a></h5>
                                    @endif
                                @else
                                    @if($bm->type=='series')
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('badminton.series', $bm->id)}}">{{ Str::words($string, 2)}}</a></h5>
                                    @else
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('badminton.show', $bm->id)}}">{{ Str::words($string, 2)}}</a></h5>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-5">
                <img src="{{ asset('img/image-4.png') }}" alt="">
                <h1>Badmi<span>nton</span><a href="#" type="button"><img src="{{ asset('img/Component3.png') }}" alt=""></a></h1>
            </div>
        </div>
    </div>
    <!-- Data artikel Basketball terbaru dan terpopuler -->
    <div class="container-fluid pg4">
        <div class="row">
            <div class="col-5">
                <img src="{{ asset('img/image-pg4.png') }}" alt="">
                <h1>Bask<span>etball</span><a href="#" type="button"><img src="{{ asset('img/Component3.png') }}" alt=""></a></h1>
            </div>
            <div class="col-7">
                <div class="row">
                    @if($baskets==null)
                        <p>Data Kosong</p>
                    @else 
                        @foreach($baskets as $bas)
                            <div class="col-4">
                                <img src="{{ asset('storage/images_download/'.$bas->image1) }}" alt="{{$bas->headlineUtamaArtikel}}">
                                @if(preg_match('/^([a-zA-Z\s]+)(?=:)|(?<=: )([a-zA-Z\s]+)$/', $bas->headlineUtamaArtikel, $matches))
                                    @if($bas->type=='series')
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('basket.series', $bas->id)}}">{{ $matches[1] ?? $matches[2]}}</a></h5>
                                    @else
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('basket.show', $bas->id)}}">{{ $matches[1] ?? $matches[2]}}</a></h5>
                                    @endif
                                @elseif(preg_match('/\b([A-Z][a-z]+(?:\s[A-Z][a-z]+)+)\b/', $bas->headlineUtamaArtikel, $matches))
                                    @if($bas->type=='series')
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('basket.series', $bas->id)}}">{{ $matches[0]}}</a></h5>
                                    @else
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('basket.show', $bas->id)}}">{{ $matches[0]}}</a></h5>
                                    @endif
                                @else
                                    @if($bas->type=='series')
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('basket.series', $bas->id)}}">{{ Str::words($string, 2)}}</a></h5>
                                    @else
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('basket.show', $bas->id)}}">{{ Str::words($string, 2)}}</a></h5>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Data artikel Volley terbaru dan terpopuler -->
    <div class="container-fluid pg5">
        <div class="row">
            <div class="col-7">
                <div class="row">
                    @if($volleys==null)
                        <p>Data Kosong</p>
                    @else 
                        @foreach($volleys as $vol)
                            <div class="col-4">
                                <img src="{{ asset('storage/images_download/'.$vol->image1) }}" alt="{{$vol->headlineUtamaArtikel}}">
                                @if(preg_match('/^([a-zA-Z\s]+)(?=:)|(?<=: )([a-zA-Z\s]+)$/', $vol->headlineUtamaArtikel, $matches))
                                    @if($vol->type=='series')
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('volley.series', $vol->id)}}">{{ $matches[1] ?? $matches[2]}}</a></h5>
                                    @else
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('volley.show', $vol->id)}}">{{ $matches[1] ?? $matches[2]}}</a></h5>
                                    @endif
                                @elseif(preg_match('/\b([A-Z][a-z]+(?:\s[A-Z][a-z]+)+)\b/', $vol->headlineUtamaArtikel, $matches))
                                    @if($vol->type=='series')
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('volley.series', $vol->id)}}">{{ $matches[0]}}</a></h5>
                                    @else
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('volley.show', $vol->id)}}">{{ $matches[0]}}</a></h5>
                                    @endif
                                @else
                                    @if($vol->type=='series')
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('volley.series', $vol->id)}}">{{ Str::words($string, 2)}}</a></h5>
                                    @else
                                    <h5><a class="text-text-decoration-none text-white" href="{{route('volley.show', $vol->id)}}">{{ Str::words($string, 2)}}</a></h5>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-5">
                <img src="{{ asset('img/image-pg5.png') }}" alt="">
                <h1>Vol<span>ley</span><a href="#" type="button"><img src="{{ asset('img/Component3.png') }}" alt=""></a></h1>
            </div>
        </div>
    </div>
    <!-- Data artikel Martial Arts terbaru dan terpopuler -->
    <div class="container-fluid pg6">
        <div class="row">
            <div class="col-5">
                <img src="{{ asset('img/image-pg6.png') }}" alt="">
                <h1>Martial<span> Arts and<br>Others</span><a href="#" type="button"><img src="{{ asset('img/Component3.png') }}" alt=""></a></br></h1>
            </div>
            <div class="col-7">
                <div class="row">
                    @if($martialarts==null)
                        <p>Data Kosong</p>
                    @else 
                        @foreach($martialarts as $mar)
                            <div class="col-4">
                                <img src="{{ asset('storage/images_download/'.$mar->image1) }}" alt="{{$mar->headlineUtamaArtikel}}">
                                @if(preg_match('/^([a-zA-Z\s]+)(?=:)|(?<=: )([a-zA-Z\s]+)$/', $mar->headlineUtamaArtikel, $matches))
                                    @if($mar->type=='series')
                                        @if($mar->category_name == "taekwondo" || $mar->category_name == "Taekwondo")
                                            <h5><a class="text-decoration-none text-white" href="{{route('taekwondo.series', $mar->id)}}">{{ $matches[1] ?? $matches[2]}}</a></h5>
                                        @elseif($mar->category_name == "Karate" || $mar->category_name == "karate")
                                            <h5><a class="text-decoration-none text-white" href="{{route('karate.series', $mar->id)}}">{{ $matches[1] ?? $matches[2]}}</a></h5>
                                        @elseif($mar->category_name == "Pencak Silat" || $mar->category_name == "pencak silat" || $mar->category_name == "Pencak silat" || $mar->category_name == "pencak Silat" || $mar->category_name == "silat" || $mar->category_name == "Silat")
                                            <h5><a class="text-decoration-none text-white" href="{{route('silat.series', $mar->id)}}">{{ $matches[1] ?? $matches[2]}}</a></h5>
                                        @endif
                                    @else
                                        @if($mar->category_name == "taekwondo" || $mar->category_name == "Taekwondo")
                                            <h5><a class="text-decoration-none text-white" href="{{route('taekwondo.show', $mar->id)}}">{{ $matches[1] ?? $matches[2]}}</a></h5>
                                        @elseif($mar->category_name == "Karate" || $mar->category_name == "karate")
                                            <h5><a class="text-decoration-none text-white" href="{{route('karate.show', $mar->id)}}">{{ $matches[1] ?? $matches[2]}}</a></h5>
                                        @elseif($mar->category_name == "Pencak Silat" || $mar->category_name == "pencak silat" || $mar->category_name == "Pencak silat" || $mar->category_name == "pencak Silat" || $mar->category_name == "silat" || $mar->category_name == "Silat")
                                            <h5><a class="text-decoration-none text-white" href="{{route('silat.show', $mar->id)}}">{{ $matches[1] ?? $matches[2]}}</a></h5>
                                        @endif
                                    @endif
                                @elseif(preg_match('/\b([A-Z][a-z]+(?:\s[A-Z][a-z]+)+)\b/', $mar->headlineUtamaArtikel, $matches))
                                    @if($mar->type=='series')
                                        @if($mar->category_name == "taekwondo" || $mar->category_name == "Taekwondo")
                                            <h5><a class="text-decoration-none text-white" href="{{route('taekwondo.series', $mar->id)}}">{{ $matches[0]}}</a></h5>
                                        @elseif($mar->category_name == "Karate" || $mar->category_name == "karate")
                                            <h5><a class="text-decoration-none text-white" href="{{route('karate.series', $mar->id)}}">{{ $matches[0]}}</a></h5>
                                        @elseif($mar->category_name == "Pencak Silat" || $mar->category_name == "pencak silat" || $mar->category_name == "Pencak silat" || $mar->category_name == "pencak Silat" || $mar->category_name == "silat" || $mar->category_name == "Silat")
                                            <h5><a class="text-decoration-none text-white" href="{{route('silat.series', $mar->id)}}">{{ $matches[0]}}</a></h5>
                                        @endif
                                    @else
                                        @if($mar->category_name == "taekwondo" || $mar->category_name == "Taekwondo")
                                            <h5><a class="text-decoration-none text-white" href="{{route('taekwondo.show', $mar->id)}}">{{ $matches[0]}}</a></h5>
                                        @elseif($mar->category_name == "Karate" || $mar->category_name == "karate")
                                            <h5><a class="text-decoration-none text-white" href="{{route('karate.show', $mar->id)}}">{{ $matches[0]}}</a></h5>
                                        @elseif($mar->category_name == "Pencak Silat" || $mar->category_name == "pencak silat" || $mar->category_name == "Pencak silat" || $mar->category_name == "pencak Silat" || $mar->category_name == "silat" || $mar->category_name == "Silat")
                                            <h5><a class="text-decoration-none text-white" href="{{route('silat.show', $mar->id)}}">{{ $matches[0]}}</a></h5>
                                        @endif
                                    @endif
                                @else
                                    @if($mar->type=='series')
                                        @if($mar->category_name == "taekwondo" || $mar->category_name == "Taekwondo")
                                            <h5><a class="text-decoration-none text-white" href="{{route('taekwondo.series', $mar->id)}}">{{ Str::words($string, 2)}}</a></h5>
                                        @elseif($mar->category_name == "Karate" || $mar->category_name == "karate")
                                            <h5><a class="text-decoration-none text-white" href="{{route('karate.series', $mar->id)}}">{{ Str::words($string, 2)}}</a></h5>
                                        @elseif($mar->category_name == "Pencak Silat" || $mar->category_name == "pencak silat" || $mar->category_name == "Pencak silat" || $mar->category_name == "pencak Silat" || $mar->category_name == "silat" || $mar->category_name == "Silat")
                                            <h5><a class="text-decoration-none text-white" href="{{route('silat.series', $mar->id)}}">{{ Str::words($string, 2)}}</a></h5>
                                        @endif
                                    @else
                                        @if($mar->category_name == "taekwondo" || $mar->category_name == "Taekwondo")
                                            <h5><a class="text-decoration-none text-white" href="{{route('taekwondo.show', $mar->id)}}">{{ Str::words($string, 2)}}</a></h5>
                                        @elseif($mar->category_name == "Karate" || $mar->category_name == "karate")
                                            <h5><a class="text-decoration-none text-white" href="{{route('karate.show', $mar->id)}}">{{ Str::words($string, 2)}}</a></h5>
                                        @elseif($mar->category_name == "Pencak Silat" || $mar->category_name == "pencak silat" || $mar->category_name == "Pencak silat" || $mar->category_name == "pencak Silat" || $mar->category_name == "silat" || $mar->category_name == "Silat")
                                            <h5><a class="text-decoration-none text-white" href="{{route('silat.show', $mar->id)}}">{{ Str::words($string, 2)}}</a></h5>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

