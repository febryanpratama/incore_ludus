@extends('layout.app')

@section('content')
    <!-- data artikel populer this week -->
    <div class="container-fluid pg1">
        <div class="row align-items-center">
            <!-- Bagian Kiri -->
            <div class="col-md-6 text-section">
                <h1 class="d-none"><span class="highlight">Explore</span> Latest <br> Sport <span class="highlight">for you</span></h1>
            </div>
    
            <!-- Bagian Kanan -->
            <div class="col-md-6 image-section">
                <h3 class="text-white mt-3">Popular this week</h3>
                @if($trendingPosts==null)
                    <p>Data Kosong</p>
                @else 
                    @foreach($trendingPosts as $trending)
                        @if(!empty($trending->image1) && !empty($trending->headlineUtamaArtikel) && !empty($trending->paragraf1))
                        <div class="card mb-1" style="background: transparent">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-4 d-flex align-items-center" style="background-color: rgba(255, 255, 255, 0.2)">
                                    <img src="{{asset('images_download/'.$trending->image1)}}" class="img-fluid rounded-start" alt="{{$trending->headlineUtamaArtikel}}" style="max-width : 100px; max-height: 100px;">
                                </div>
                                <div class="col-lg-9 col-md-8 col-7" style="background-color: rgba(255, 255, 255, 0.2)">
                                    <div class="card-body">
                                        <span class="card-text"><small>{{ \Carbon\Carbon::parse($trending->created_at)->diffForHumans()}}</small></span>
                                        @if($trending->type=='series')
                                            @if($trending->category_name == "Badminton" || $trending->category_name == "badminton")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('badminton.series', $trending->slug)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "Basket" || $trending->category_name == "basket")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('basket.series', $trending->slug)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "volley" || $trending->category_name == "Volley")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('volley.series', $trending->slug)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "taekwondo" || $trending->category_name == "Taekwondo")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('taekwondo.series', $trending->slug)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "Karate" || $trending->category_name == "karate")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('karate.series', $trending->slug)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "Pencak Silat" || $trending->category_name == "pencak silat" || $trending->category_name == "Pencak silat" || $trending->category_name == "pencak Silat" || $trending->category_name == "silat" || $trending->category_name == "Silat" || $trending->category_name == "pencaksilat")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('silat.series', $trending->slug)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "football" || $trending->category_name == "Football")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('football.series', $trending->slug)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @endif
                                        @else
                                            @if($trending->category_name == "Badminton" || $trending->category_name == "badminton")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('badminton.show', $trending->slug)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "Basket" || $trending->category_name == "basket")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('basket.show', $trending->slug)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "volley" || $trending->category_name == "Volley")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('volley.show', $trending->slug)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "taekwondo" || $trending->category_name == "Taekwondo")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('taekwondo.show', $trending->slug)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "Karate" || $trending->category_name == "karate")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('karate.show', $trending->slug)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "Pencak Silat" || $trending->category_name == "pencak silat" || $trending->category_name == "Pencak silat" || $trending->category_name == "pencak Silat" || $trending->category_name == "silat" || $trending->category_name == "Silat" || $trending->category_name == "pencaksilat")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('silat.show', $trending->slug)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @elseif($trending->category_name == "football" || $trending->category_name == "Football")
                                                <h6 class="card-title"><a class="text-decoration-none text-white" href="{{route('football.show', $trending->slug)}}">{{$trending->headlineUtamaArtikel}}</a></h6>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="col-1" style="background: none;"></div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="container-fluid pg2">
        <div class="row">
            <!-- <div class="d-none d-md-block col-md-4">
                <h1>Foot<span>actball</span><a href="#" type="button"><img src="{{ asset('img/Component3.png') }}" alt=""></a></h1>
            </div> -->
            <div class="col-md-4 d-flex justify-content-center align-items-center position-relative text-center p-0">
                <!-- Gambar -->
                <img src="{{ asset('/img/imagepg2.png') }}" class="img-fluid h-100 w-auto" alt="Martial Arts">
            
                <!-- Teks di atas gambar -->
                <div class="position-absolute text-white" style="bottom: 5%; left: 50%; transform: translate(-50%, -50%);">
                    <h1 class="fw-bold">
                        Foot<span style="color: rgb(52, 52, 241); letter-spacing: 2px">ball</span>
                        <a href="#" type="button"><img src="{{ asset('img/Component3.png') }}" alt=""></a>
                    </h1>
                </div>
            </div>  
            <div class="col-sm-8 col-md-8 p-0">
                <div id="carouselExampleCaptions" class="carousel slide">
                    <div class="carousel-inner">
                        @if($footballTranding==null)
                        <div></div>
                        @else 
                            @if(!empty($footballTranding->image1) && !empty($footballTranding->headlineUtamaArtikel) && !empty($footballTranding->paragraf1))
                            <div class="carousel-item">
                                @if($footballTranding->type=='series')
                                <a href="{{route('football.series', $footballTranding->slug)}}">
                                @else
                                <a href="{{route('football.show', $footballTranding->slug)}}">
                                @endif
                                <img src="{{ asset('images_download/'.$footballTranding->image1) }}" class="d-block w-100" alt="{{$footballTranding->headlineUtamaArtikel}}" style="max-height: 736px; object-fit: cover;">
                                </a>
                                <div class="carousel-caption d-none d-md-block">
                                    @if($footballTranding->type=='series')
                                    <h1><a class="text-text-decoration-none text-white" href="{{route('football.series', $footballTranding->slug)}}">{{$footballTranding->headlineUtamaArtikel}}</a></h1>
                                    @else
                                    <h1><a class="text-text-decoration-none text-white" href="{{route('football.show', $footballTranding->slug)}}">{{$footballTranding->headlineUtamaArtikel}}</a></h1>
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
                        @endif
                        @if($footballs==null)
                        <p></p>
                        @else 
                            @foreach($footballs as $index => $fb)
                                @if(!empty($fb->image1) && !empty($fb->headlineUtamaArtikel) && !empty($fb->paragraf1))
                                <div class="carousel-item @if($index == 0) active @endif">
                                    @if($fb->type=='series')
                                    <a href="{{route('football.series', $fb->slug)}}">
                                    @else
                                    <a href="{{route('football.show', $fb->slug)}}">
                                    @endif
                                        <img src="{{ asset('images_download/'.$fb->image1) }}" class="d-block w-100" alt="{{$fb->headlineUtamaArtikel}}" style="max-height: 736px; object-fit: cover;">
                                    </a>
                                    <div class="carousel-caption d-none d-md-block">
                                        <!-- <h1>FTimnas U-23 Indonesia VS Timnas U-23 Argentina</h1> -->
                                        @if($fb->type=='series')
                                        <h1><a class="text-text-decoration-none text-white" href="{{route('football.series', $fb->slug)}}">{{$fb->headlineUtamaArtikel}}</a></h1>
                                        @else
                                        <h1><a class="text-text-decoration-none text-white" href="{{route('football.show', $fb->slug)}}">{{$fb->headlineUtamaArtikel}}</a></h1>
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
                                @endif
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

    <div class="container-fluid pg3">
        <div class="row d-flex flex-column-reverse flex-md-row">
            <!-- Bagian kanan (gambar) -->
            <div class="col-md-5 d-flex justify-content-center align-items-center position-relative text-center order-md-2 order-2">
                <!-- Gambar -->
                <img src="{{ asset('img/image-4.png') }}" class="img-fluid h-100 w-auto" alt="Badminton">
            
                <!-- Teks di atas gambar -->
                <div class="position-absolute text-white" style="bottom: 5%; left: 50%; transform: translate(-50%, -50%);">
                    <h1 class="fw-bold">
                        Badmi<span style="color: rgb(52, 52, 241); letter-spacing: 2px">nton</span>
                        <a href="#" type="button"><img src="{{ asset('img/Component3.png') }}" alt=""></a>
                    </h1>
                </div>
            </div>  
    
            <!-- Bagian kiri (artikel) -->
            <div class="col-md-7 order-md-1 order-1">
                <div class="row">
                    @if($badmintons==null)
                        <p>Data Kosong</p>
                    @else 
                        @foreach($badmintons as $bm)
                            @if(!empty($bm->image1) && !empty($bm->headlineUtamaArtikel) && !empty($bm->paragraf1))
                                <div class="col-12 col-sm-6 col-md-4 mb-3 mt-4">
                                    <div class="card h-100">
                                    @if($bm->type=='series')
                                    <a href="{{route('badminton.series', $bm->slug)}}">
                                    @else
                                    <a href="{{route('badminton.show', $bm->slug)}}">
                                    @endif
                                        <img src="{{ asset('images_download/'.$bm->image1) }}" class="card-img-top" alt="{{$bm->headlineUtamaArtikel}}">
                                    </a>
                                        <div class="card-body">
                                            @if($bm->type=='series')
                                            <h5><a class="text-decoration-none text-dark" href="{{route('badminton.series', $bm->slug)}}">{{ $bm->headlineUtamaArtikel}}</a></h5>
                                            @else
                                            <h5><a class="text-decoration-none text-dark" href="{{route('badminton.show', $bm->slug)}}">{{ $bm->headlineUtamaArtikel}}</a></h5>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid pg4">
        <div class="row">
            <div class="col-md-5 d-flex justify-content-center align-items-center position-relative text-center p-0">
                <!-- Gambar -->
                <img src="{{ asset('img/image-pg4.png') }}" class="img-fluid h-100 w-auto" alt="Basket">
            
                <!-- Teks di atas gambar -->
                <div class="position-absolute text-white" style="bottom: 5%; left: 50%; transform: translate(-50%, -50%);">
                    <h1 class="fw-bold">
                        Bask<span style="color: rgb(52, 52, 241); letter-spacing: 2px">etball</span>
                        <a href="#" type="button"><img src="{{ asset('img/Component3.png') }}" alt=""></a>
                    </h1>
                </div>
            </div>  
    
            <div class="col-12 col-md-7 order-md-2 order-1">
                <div class="row">
                    @if($baskets==null)
                        <p>Data Kosong</p>
                    @else 
                        @foreach($baskets as $bas)
                            @if(!empty($bas->image1) && !empty($bas->headlineUtamaArtikel) && !empty($bas->paragraf1))
                                <div class="col-12 col-sm-6 col-md-4 mb-3 mt-4">
                                    <div class="card h-100">
                                    @if($bas->type=='series')
                                    <a href="{{route('basket.series', $bas->slug)}}">
                                    @else
                                    <a href="{{route('basket.show', $bas->slug)}}">
                                    @endif
                                        <img src="{{ asset('images_download/'.$bas->image1) }}" class="card-img-top" alt="{{$bas->headlineUtamaArtikel}}">
                                    </a>
                                        <div class="card-body">
                                            @if($bas->type=='series')
                                            <h5><a class="text-decoration-none text-dark" href="{{route('basket.series', $bas->slug)}}">{{ $bas->headlineUtamaArtikel}}</a></h5>
                                            @else
                                            <h5><a class="text-decoration-none text-dark" href="{{route('basket.show', $bas->slug)}}">{{ $bas->headlineUtamaArtikel}}</a></h5>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pg5">
        <div class="row d-flex flex-column-reverse flex-md-row">
            <!-- Bagian artikel -->
            <div class="col-12 col-md-7 order-md-1 order-1">
                <div class="row">
                    @if($volleys==null)
                        <p>Data Kosong</p>
                    @else 
                        @foreach($volleys as $vol)
                           @if(!empty($vol->image1) && !empty($vol->headlineUtamaArtikel) && !empty($vol->paragraf1))
                                <div class="col-12 col-sm-6 col-md-4 mb-3 mt-4">
                                    <div class="card h-100">
                                    @if($vol->type=='series')
                                    <a href="{{route('volley.series', $vol->slug)}}">
                                    @else
                                    <a href="{{route('volley.show', $vol->slug)}}">
                                    @endif
                                        <img src="{{ asset('images_download/'.$vol->image1) }}" class="card-img-top" alt="{{$vol->headlineUtamaArtikel}}">
                                    </a>
                                        <div class="card-body">
                                            @if($vol->type=='series')
                                            <h5><a class="text-decoration-none text-dark" href="{{route('volley.series', $vol->slug)}}">{{ $vol->headlineUtamaArtikel}}</a></h5>
                                            @else
                                            <h5><a class="text-decoration-none text-dark" href="{{route('volley.show', $vol->slug)}}">{{ $vol->headlineUtamaArtikel}}</a></h5>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
    
            <!-- Bagian gambar -->
            <div class="col-12 col-md-5 d-flex justify-content-center align-items-center position-relative text-center order-md-2 order-2 p-0" >
                <!-- Gambar -->
                <img src="{{ asset('img/image-pg5.png') }}" class="img-fluid w-100 h-100 object-fit-cover" alt="Volley">
            
                <!-- Teks di atas gambar -->
                <div class="position-absolute text-white w-100 px-3" style="bottom: 5%; left: 50%; transform: translate(-50%, -50%);">
                    <h1 class="fw-bold">
                        Vol<span style="color: rgb(52, 52, 241); letter-spacing: 2px">ley</span>
                        <a href="#" type="button"><img src="{{ asset('img/Component3.png') }}" alt=""></a>
                    </h1>
                </div>
            </div>  
        </div>
    </div>

    <div class="container-fluid pg6">
        <div class="row">
            <div class="col-md-5 d-flex justify-content-center align-items-center position-relative text-center p-0">
                <!-- Gambar -->
                <img src="{{ asset('img/image-pg6.png') }}" class="img-fluid h-100 w-auto" alt="Martial Arts">
            
                <!-- Teks di atas gambar -->
                <div class="position-absolute text-white" style="bottom: 5%; left: 50%; transform: translate(-50%, -50%);">
                    <h1 class="fw-bold">
                        Martial<span style="color: rgb(52, 52, 241); letter-spacing: 2px">Arts and<br>Others</span>
                        <a href="#" type="button"><img src="{{ asset('img/Component3.png') }}" alt=""></a>
                    </h1>
                </div>
            </div>  
            <div class="col-12 col-md-7 order-md-2 order-1 p-0">
                <div class="row">
                    @if($martialarts==null)
                        <p>Data Kosong</p>
                    @else 
                        @foreach($martialarts as $mar)
                           @if(!empty($mar->image1) && !empty($mar->headlineUtamaArtikel) && !empty($mar->paragraf1))
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="card h-100">
                                        <img src="{{ asset('images_download/'.$mar->image1) }}" alt="{{$mar->headlineUtamaArtikel}}">
                                        <div class="card-body">
                                            @if($mar->type=='series')
                                                @if($mar->category_name == "taekwondo" || $mar->category_name == "Taekwondo")
                                                    <h5><a class="text-decoration-none text-black" href="{{route('taekwondo.series', $mar->slug)}}">{{ $mar->headlineUtamaArtikel}}</a></h5>
                                                @elseif($mar->category_name == "Karate" || $mar->category_name == "karate")
                                                    <h5><a class="text-decoration-none text-black" href="{{route('karate.series', $mar->slug)}}">{{ $mar->headlineUtamaArtikel}}</a></h5>
                                                @elseif($mar->category_name == "Pencak Silat" || $mar->category_name == "pencak silat" || $mar->category_name == "Pencak silat" || $mar->category_name == "pencak Silat" || $mar->category_name == "silat" || $mar->category_name == "Silat" || $mar->category_name == "pencaksilat")
                                                    <h5><a class="text-decoration-none text-black" href="{{route('silat.series', $mar->slug)}}">{{ $mar->headlineUtamaArtikel}}</a></h5>
                                                @endif
                                            @else
                                                @if($mar->category_name == "taekwondo" || $mar->category_name == "Taekwondo")
                                                    <h5><a class="text-decoration-none text-black" href="{{route('taekwondo.show', $mar->slug)}}">{{ $mar->headlineUtamaArtikel}}</a></h5>
                                                @elseif($mar->category_name == "Karate" || $mar->category_name == "karate")
                                                    <h5><a class="text-decoration-none text-black" href="{{route('karate.show', $mar->slug)}}">{{ $mar->headlineUtamaArtikel}}</a></h5>
                                                @elseif($mar->category_name == "Pencak Silat" || $mar->category_name == "pencak silat" || $mar->category_name == "Pencak silat" || $mar->category_name == "pencak Silat" || $mar->category_name == "silat" || $mar->category_name == "Silat" || $mar->category_name == "pencaksilat")
                                                    <h5><a class="text-decoration-none text-black" href="{{route('silat.show', $mar->slug)}}">{{ $mar->headlineUtamaArtikel}}</a></h5>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    
@endsection

