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
                <div class="col-6">
                    <h3>Popular this week</h3>
                    @for($i=1; $i<=5; $i++)
                    <div class="card">
                        <div class="row">
                            <div class="col-4">
                            <img src="{{asset('img/image'.$i.'.png')}}" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <span class="card-text"><small>By Ludus Team</small></span>
                                    <span class="card-text"><small>2 Hours ago</small></span>
                                    <h6 class="card-title">Megawati Berhasil Membawa Kemenangan Bagi Red Sparks</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
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
                        <div class="carousel-item active">
                            <img src="{{ asset('img/Rectangle412.png') }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h1>FTimnas U-23 Indonesia VS Timnas U-23 Argentina</h1>
                                <div class="row">
                                    <div class="col-2">
                                        <img src="{{ asset('img/Group451.png') }}" alt="">
                                    </div>
                                    <div class="col-10">
                                        <b>Mukhlisahmad</b>
                                        <p><small>5 hours ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/Rectangle412.png') }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                            <h1>FTimnas U-23 Indonesia VS Timnas U-23 Argentina</h1>
                                <div class="row">
                                    <div class="col-2">
                                        <img src="{{ asset('img/Group451.png') }}" alt="">
                                    </div>
                                    <div class="col-10">
                                        <b>Mukhlisahmad</b>
                                        <p><small>5 hours ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/Rectangle412.png') }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                            <h1>FTimnas U-23 Indonesia VS Timnas U-23 Argentina</h1>
                                <div class="row">
                                    <div class="col-2">
                                        <img src="{{ asset('img/Group451.png') }}" alt="">
                                    </div>
                                    <div class="col-10">
                                        <b>Mukhlisahmad</b>
                                        <p><small>5 hours ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <div class="col-4">
                        <img src="{{ asset('img/image-1.png') }}" alt="">
                        <h5>Anthony Ginting</h5>
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('img/image-2.png') }}" alt="">
                        <h5>The Minions</h5>
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('img/image-3.png') }}" alt="">
                        <h5>Jonathan Christie</h5>
                    </div>
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
                    <div class="col-4">
                        <img src="{{ asset('img/image-pg4-1.png') }}" alt="">
                        <h5>Liga Professional</h5>
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('img/image-pg4-2.png') }}" alt="">
                        <h5>Kejuaraan Nasional</h5>
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('img/image-pg4-3.png') }}" alt="">
                        <h5>Liga Pelajar</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data artikel Volley terbaru dan terpopuler -->
    <div class="container-fluid pg5">
        <div class="row">
            <div class="col-7">
                <div class="row">
                    <div class="col-4">
                        <img src="{{ asset('img/image-pg5-1.png') }}" alt="">
                        <h5>Sea Games 2019</h5>
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('img/image-pg5-2.png') }}" alt="">
                        <h5>AVC Challange Cup</h5>
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('img/image-pg5-3.png') }}" alt="">
                        <h5>Sea Games 2023</h5>
                    </div>
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
                    <div class="col-4">
                        <img src="{{ asset('img/image-pg6-1.png') }}" alt="">
                        <h5>Liga Professional</h5>
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('img/image-pg6-2.png') }}" alt="">
                        <h5>Kejuaraan Nasional</h5>
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('img/image-pg6-3.png') }}" alt="">
                        <h5>Liga Pelajar</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

