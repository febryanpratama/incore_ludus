@extends('layout.app')

@section('content')
<!-- Navbar -->
<div class="container-fluid pg-1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-8">
                        <p>hot articles</p>
                    </div>
                    <div class="col-4">
                        <p>EXPLORE NEWS ABOUT martial arts ON LUDUS. YOU'LL GET THE LATEST INFORMATION HERE.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p>About Martial Arts News</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p>From the latest match highlights to immersive stadium experiences and fan events.</p>
                    </div>
                    <div class="col-8">
                        <p>might you like</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Lates News -->
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand"><h3>Lates News</h3></a>
    <a href="{{ route('martialarts.viewall') }}" type="button" class="btn btn-outline-dark bt1">View All</a>
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">
        <svg width="20" height="20" viewBox="0 0 20 20" aria-hidden="true" class="DocSearch-Search-Icon"><path d="M14.386 14.386l4.0877 4.0877-4.0877-4.0877c-2.9418 2.9419-7.7115 2.9419-10.6533 0-2.9419-2.9418-2.9419-7.7115 0-10.6533 2.9418-2.9419 7.7115-2.9419 10.6533 0 2.9419 2.9418 2.9419 7.7115 0 10.6533z" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
      </button>
    </form>
  </div>
</nav>
<!-- Data artikel terbaru dan tranding -->
<div class="container-fluid pg-2">
    <div class="row row-cols-lg-4">
        @foreach ($articles as $article)
        <div class="col mt-3">
            <div class="card">
                    @if($article->type=='series')
                    <a href="{{route('martialarts.series', $article->id)}}">
                    @else
                    <a href="{{route('martialarts.show', $article->id)}}">
                    @endif
                    <img src="{{$article->image1}}" class="card-img-top" alt="{{$article->headlineUtamaArtikel}}">
                    </a>
                    <div class="card-body">
                        @if($article->created_at->diff(now())->days <= 1)
                        <span class="badge text-bg-primary">New</span>
                        @endif
                        <span class="badge text-bg-secondary">Martial Arts</span>
                        @if($article->type=='series')
                        <a href="{{route('martialarts.series', $article->id)}}" class="badge text-bg-success">{{$article->type}}</a>
                        @else
                        <a href="{{route('martialarts.show', $article->id)}}" class="badge text-bg-success">{{$article->type}}</a>
                        @endif

                        <!-- Button trigger modal -->
                        <a href="#" type="button" class="btn btn-danger report" data-bs-toggle="modal" data-bs-target="#reportModal">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.5 11.6667C7.73611 11.6667 7.93417 11.5867 8.09417 11.4267C8.25417 11.2667 8.33389 11.0689 8.33333 10.8333C8.33278 10.5978 8.25278 10.4 8.09333 10.24C7.93389 10.08 7.73611 10 7.5 10C7.26389 10 7.06611 10.08 6.90667 10.24C6.74722 10.4 6.66722 10.5978 6.66667 10.8333C6.66611 11.0689 6.74611 11.2669 6.90667 11.4275C7.06722 11.5881 7.265 11.6678 7.5 11.6667ZM6.66667 8.33333H8.33333V3.33333H6.66667V8.33333ZM4.375 15L0 10.625V4.375L4.375 0H10.625L15 4.375V10.625L10.625 15H4.375ZM5.08333 13.3333H9.91667L13.3333 9.91667V5.08333L9.91667 1.66667H5.08333L1.66667 5.08333V9.91667L5.08333 13.3333Z" fill="#060606"/></svg>
                        </a>
                        @if($article->type=='series')
                        <h5 class="card-title"><a href="{{route('martialarts.series', $article->id)}}">{{$article->headlineUtamaArtikel}}</a></h5>
                        @else
                        <h5 class="card-title"><a href="{{route('martialarts.show', $article->id)}}">{{$article->headlineUtamaArtikel}}</a></h5>
                        @endif
                        <p class="card-text">{{date_format($article->created_at,"d M Y")}} 
                        </p>
                        <ul>
                            <li>By Admin</li>
                        </ul>
                    </div>
                </div>
        </div>
        @endforeach
        <div class="col mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title title1">Subscribe so you don't miss out!</h5>
                    <form>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Email...">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
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
<!-- Hightlight -->
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand"><h3>Highlights</h3></a>
    <a href="{{ route('martialarts.viewall') }}" type="button" class="btn btn-outline-dark bt1">View All</a>
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">
        <svg width="20" height="20" viewBox="0 0 20 20" aria-hidden="true" class="DocSearch-Search-Icon"><path d="M14.386 14.386l4.0877 4.0877-4.0877-4.0877c-2.9418 2.9419-7.7115 2.9419-10.6533 0-2.9419-2.9418-2.9419-7.7115 0-10.6533 2.9418-2.9419 7.7115-2.9419 10.6533 0 2.9419 2.9418 2.9419 7.7115 0 10.6533z" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
      </button>
    </form>
  </div>
</nav>
<!-- Data hightlight artikel yang sedang tranding -->
<div class="container-fluid pg-3">
    <div class="row">
        <div class="col-7">
            <div class="label">
                <span class="badge text-bg-danger">Trending</span>
                <span class="badge text-bg-secondary">Martial Arts</span>
                <!-- Button trigger modal -->
                <a href="#" type="button" class="btn btn-danger report" data-bs-toggle="modal" data-bs-target="#reportModal">
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.5 11.6667C7.73611 11.6667 7.93417 11.5867 8.09417 11.4267C8.25417 11.2667 8.33389 11.0689 8.33333 10.8333C8.33278 10.5978 8.25278 10.4 8.09333 10.24C7.93389 10.08 7.73611 10 7.5 10C7.26389 10 7.06611 10.08 6.90667 10.24C6.74722 10.4 6.66722 10.5978 6.66667 10.8333C6.66611 11.0689 6.74611 11.2669 6.90667 11.4275C7.06722 11.5881 7.265 11.6678 7.5 11.6667ZM6.66667 8.33333H8.33333V3.33333H6.66667V8.33333ZM4.375 15L0 10.625V4.375L4.375 0H10.625L15 4.375V10.625L10.625 15H4.375ZM5.08333 13.3333H9.91667L13.3333 9.91667V5.08333L9.91667 1.66667H5.08333L1.66667 5.08333V9.91667L5.08333 13.3333Z" fill="#060606"/></svg>
                </a>
            </div>
            <img src="{{asset('img/img-football-2.jpg')}}" alt="">
            <div class="caption">
                <h1>You Can Still Get Tickets to Billie Eilish’s Sold-Out Hit Me Hard and Soft Tour</h1>
                <p>26 Juni 2024</p>
                <ul>
                    <li>By Admin</li>
                </ul>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <ul class="list-group list-group-flush">
                    @for($i=0; $i < 3; $i++)
                    <li class="list-group-item">
                        <span class="badge text-bg-danger">Trending</span>
                        <span class="badge text-bg-secondary">Martial Arts</span>
                        <!-- Button trigger modal -->
                        <a href="#" type="button" class="btn btn-danger report" data-bs-toggle="modal" data-bs-target="#reportModal">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.5 11.6667C7.73611 11.6667 7.93417 11.5867 8.09417 11.4267C8.25417 11.2667 8.33389 11.0689 8.33333 10.8333C8.33278 10.5978 8.25278 10.4 8.09333 10.24C7.93389 10.08 7.73611 10 7.5 10C7.26389 10 7.06611 10.08 6.90667 10.24C6.74722 10.4 6.66722 10.5978 6.66667 10.8333C6.66611 11.0689 6.74611 11.2669 6.90667 11.4275C7.06722 11.5881 7.265 11.6678 7.5 11.6667ZM6.66667 8.33333H8.33333V3.33333H6.66667V8.33333ZM4.375 15L0 10.625V4.375L4.375 0H10.625L15 4.375V10.625L10.625 15H4.375ZM5.08333 13.3333H9.91667L13.3333 9.91667V5.08333L9.91667 1.66667H5.08333L1.66667 5.08333V9.91667L5.08333 13.3333Z" fill="#060606"/></svg>
                        </a>
                        <h5>Supreme and Nike Have an Air Max TL 99 Collaboration on the Way</h5>
                        <p>26 Juni 2024</p>
                        <ul>
                            <li>By Admin</li>
                        </ul>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Data artikel yang sedang tranding lainnya -->
<div class="container-fluid pg-4">
    <div class="row">
        @for($i=1;$i<=3;$i++)
        <div class="col-4">
            <div class="card">
                <img src="{{asset('img/image-football-pg-2-'.$i.'.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <span class="badge text-bg-danger">Tranding</span>
                    <span class="badge text-bg-secondary">Martial Arts</span>
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
</div>
<!-- Recommendation -->
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand"><h3>Recomendation For You</h3></a>
    <a href="{{ route('martialarts.viewall') }}" type="button" class="btn btn-outline-dark bt2">View All</a>
  </div>
</nav>
<!-- artikel trending lainnya dan iklan -->
<div class="container-fluid pg-5">
    <div class="row">
        <!-- iklan  -->
        <div class="col-4">
            <div class="card1">
                <p>Ingin Mengajukan Iklan di Artikel Ini?
                Klik Sekarang Dan Dapatkan Harga Terbaik</p>
                <button type="button" class="btn btn-outline-dark btn-n1" data-bs-toggle="modal" data-bs-target="#advertisementModal">
                Request Advertorial
                </button>
                <a href="" type="button" class="btn btn-outline-dark"><svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.4697 12.4697C10.1768 12.7626 10.1768 13.2374 10.4697 13.5303C10.7626 13.8232 11.2374 13.8232 11.5303 13.5303L10.4697 12.4697ZM17.5303 7.53033C17.8232 7.23744 17.8232 6.76256 17.5303 6.46967C17.2374 6.17678 16.7626 6.17678 16.4697 6.46967L17.5303 7.53033ZM16.4697 7.53039C16.7626 7.82328 17.2374 7.82328 17.5303 7.53039C17.8232 7.23749 17.8232 6.76262 17.5303 6.46972L16.4697 7.53039ZM11.5303 0.469725C11.2374 0.176831 10.7626 0.176831 10.4697 0.469725C10.1768 0.762618 10.1768 1.23749 10.4697 1.53039L11.5303 0.469725ZM17 7.75004C17.4142 7.75004 17.75 7.41425 17.75 7.00004C17.75 6.58582 17.4142 6.25004 17 6.25004V7.75004ZM1 6.25004C0.585785 6.25004 0.25 6.58582 0.25 7.00004C0.25 7.41425 0.585785 7.75004 1 7.75004V6.25004ZM11.5303 13.5303L17.5303 7.53033L16.4697 6.46967L10.4697 12.4697L11.5303 13.5303ZM17.5303 6.46972L11.5303 0.469725L10.4697 1.53039L16.4697 7.53039L17.5303 6.46972ZM17 6.25004L1 6.25004V7.75004L17 7.75004V6.25004Z" fill="#F6F6F6"/>
                </svg>
                </a>
            </div>
        </div>
        @for($i=1;$i<=2;$i++)
        <div class="col-4">
            <div class="card">
                <img src="{{asset('img/image-football-pg-2-'.$i.'.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <span class="badge text-bg-danger">Tranding</span>
                    <span class="badge text-bg-secondary">Martial Arts</span>
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

<!-- Modal Advertisement -->
<div class="modal fade" id="advertisementModal" tabindex="-1" aria-labelledby="advertisementModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="advertisementModalLabel">Form Advertorial</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="mb-3">
                <label for="title" class="form-label">Title Advertorial</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="write the tittle...">
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">Call To Action URL (Optional)</label>
                <input type="text" class="form-control" id="url" name="url" placeholder="write the url...">
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Files</label>
                <input type="file" class="form-control" id="file" name="file" placeholder="upload files...">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descriptions</label>
                <textarea name="description" class="form-control" id="description" placeholder="write the description..."></textarea>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-4">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date">
                    </div>
                    <div class="col-4">
                        <label for="time" class="form-label">Start Time</label>
                        <input type="time" class="form-control d-inline-block" id="time" name="timeStart">
                    </div>
                    <div class="col-4">
                        <label for="time" class="form-label">End Time</label>
                        <input type="time" class="form-control d-inline-block" id="time" name="timeEnd">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="budget" class="form-label">Budget (day)</label>
                <input type="text" class="form-control" id="budget" placeholder="write nominal...">
            </div>
            <div class="modal-footer border-0">
              <button type="button" class="btn btn-outline-secondary">Hapus</button>
              <button type="button" class="btn btn-primary">Tambah</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection