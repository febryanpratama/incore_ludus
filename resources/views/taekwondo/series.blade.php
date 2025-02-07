@extends('layout.app')

@section('content')
<!-- Title and Image Content -->
<div class="container-fluid d-pg1">
    <div class="row">
        <div class="col-4">
            <div class="card1">
                <span class="badge text-bg-danger">Tranding</span>
                <span class="badge text-bg-success">{{$article->type}}</span>
                <span class="badge text-bg-secondary">Taekwondo</span>
                <h1>{{ $article->headlineUtamaArtikel }}</h1>
                <a href="" type="button" class="btn btn-outline-dark">Request Advertorial</a>
                <a href="" type="button" class="btn btn-outline-dark"><svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.53033 10.4697C1.23744 10.1768 0.762563 10.1768 0.46967 10.4697C0.176777 10.7626 0.176777 11.2374 0.46967 11.5303L1.53033 10.4697ZM6.46967 17.5303C6.76256 17.8232 7.23744 17.8232 7.53033 17.5303C7.82322 17.2374 7.82322 16.7626 7.53033 16.4697L6.46967 17.5303ZM6.46962 16.4697C6.17672 16.7626 6.17672 17.2374 6.46961 17.5303C6.76251 17.8232 7.23738 17.8232 7.53028 17.5303L6.46962 16.4697ZM13.5303 11.5303C13.8232 11.2374 13.8232 10.7626 13.5303 10.4697C13.2374 10.1768 12.7625 10.1768 12.4696 10.4697L13.5303 11.5303ZM6.24996 17C6.24996 17.4142 6.58575 17.75 6.99996 17.75C7.41418 17.75 7.74996 17.4142 7.74996 17L6.24996 17ZM7.74996 1C7.74996 0.585785 7.41418 0.25 6.99996 0.25C6.58575 0.25 6.24996 0.585785 6.24996 1L7.74996 1ZM0.46967 11.5303L6.46967 17.5303L7.53033 16.4697L1.53033 10.4697L0.46967 11.5303ZM7.53028 17.5303L13.5303 11.5303L12.4696 10.4697L6.46962 16.4697L7.53028 17.5303ZM7.74996 17L7.74996 1L6.24996 1L6.24996 17L7.74996 17Z" fill="#F6F6F6"/></svg>
                </a>
                </div>
            </div>
            <div class="col-8"><img src="{{ asset('storage/images_download/'.$article->image1) }}" alt="{{$article->headlineUtamaArtikel}}"></div>
    </div>      
</div>
<!-- Detail Content (ada 3 bagian images. 1 image diheader, 2 images tengah halaman dan 1 akhir halaman. Terdapat headline kalimat dibagian atas dan tengah halaman. berisi kalimat yang menarik minat pembaca) -->
<div class="container-fluid d-pg2">
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="header">
                    <img src="{{asset('/img/Profile.png')}}" alt="">
                    <p>By Ludus <br> <span>{{date_format($article->created_at,"d M Y")}}<span></p>
                    <hr>
                </div>
                <h2>{{$article->highlight1}}</h2>
                <p>{{$article->paragraf1}}</p>
                <div class="row">
                    @if($article->image2 != null)
                    <div class="col-6">
                        <img src="{{ asset('storage/images_download/'.$article->image2) }}" alt="{{$article->highlight1}}">
                    </div>
                    @endif
                    @if($article->image3 != null)
                    <div class="col-6">
                        <img src="{{ asset('storage/images_download/'.$article->image3) }}" alt="{{$article->highlight1}}">
                    </div>
                    @endif
                </div>
                <p>{{$article->paragraf2}}</p>
                <hr>
                <h2>{{$article->highlight2}}</h2>
                <p>{{$article->paragraf3}}</p>
                <p>{{$article->paragraf4}}</p>
                @if($article->image4 != null)
                <div class="row">
                    <div class="col">
                        <img src="{{ asset('storage/images_download/'.$article->image4) }}" alt="{{$article->highlight2}}">
                    </div>
                </div>
                @endif
                <hr>
                <h4>Related Tags</h4>
                <!-- mengarah ke link sesuai kategori -->
                <a href=""><span class="badge text-bg-secondary">Trending</span></a>
                <a href=""><span class="badge text-bg-secondary">New</span></a>
                <a href=""><span class="badge text-bg-secondary">Football</span></a>
                <a href=""><span class="badge text-bg-secondary">Volley</span></a>
                <a href=""><span class="badge text-bg-secondary">Badminton</span></a>
                <a href=""><span class="badge text-bg-secondary">Taekwondo</span></a>
                <a href=""><span class="badge text-bg-secondary">Karate</span></a>
                <a href=""><span class="badge text-bg-secondary">Pencak Silat</span></a>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row text-center prefnext">
            <div class="col-4"><a href="" class="btn btn-outline-secondary">Previous</a></div>
            <div class="col-4">Page 2</div>
            <div class="col-4"><a href="" class="btn btn-outline-secondary">Next</a></div>
        </div>
    </div>
</div>
 <!-- diisi data artikel terkait, 4 artikel tiap pagenya -->
<div class="container-fluid d-pg3">
    <h2>You May Also Interested</h2>
    <div class="row">
        @for($i=1;$i<=4;$i++)
        <div class="col-3">
            <div class="card">
                <img src="{{asset('img/image-football-pg-2-'.$i.'.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <span class="badge text-bg-danger">Tranding</span>
                    <span class="badge text-bg-secondary">Taekwondo</span>
                    <!-- Button trigger modal -->
                    <a href="#" type="button" class="btn btn-danger report" data-bs-toggle="modal" data-bs-target="#reportModal">
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.5 11.6667C7.73611 11.6667 7.93417 11.5867 8.09417 11.4267C8.25417 11.2667 8.33389 11.0689 8.33333 10.8333C8.33278 10.5978 8.25278 10.4 8.09333 10.24C7.93389 10.08 7.73611 10 7.5 10C7.26389 10 7.06611 10.08 6.90667 10.24C6.74722 10.4 6.66722 10.5978 6.66667 10.8333C6.66611 11.0689 6.74611 11.2669 6.90667 11.4275C7.06722 11.5881 7.265 11.6678 7.5 11.6667ZM6.66667 8.33333H8.33333V3.33333H6.66667V8.33333ZM4.375 15L0 10.625V4.375L4.375 0H10.625L15 4.375V10.625L10.625 15H4.375ZM5.08333 13.3333H9.91667L13.3333 9.91667V5.08333L9.91667 1.66667H5.08333L1.66667 5.08333V9.91667L5.08333 13.3333Z" fill="#060606"/></svg>
                    </a>
                    <h5 class="card-title">The Big Australian Music Festival Is Dead. What Next?</h5>
                    <p class="card-text">12 Feb 2024</p>
                    <ul>
                        <li>By Admin</li>
                    </ul>
                </div>
            </div>
        </div>
        @endfor
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
            <a class="page-link">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
            <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>
@endsection