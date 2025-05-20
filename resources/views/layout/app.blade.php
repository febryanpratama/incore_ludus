<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <!-- <meta name="keywords" content="berita olahraga, update skor, hasil pertandingan, statistik olahraga, jadwal pertandingan, skor bola, jadwal liga, live score, NBA updates, transfer pemain, komunitas olahraga, forum olahraga, diskusi pertandingan, penggemar olahraga, live chat bola"> -->

        <title>Ludic.id</title>

        <title>Berita & Informasi Olahraga Terbaru | Skor, Jadwal, dan Statistik</title>
        <meta name="description" content="Tentang berita terbaru, hasil pertandingan, statistik, dan informasi seputar olahraga favorit Anda dalam satu aplikasi! Ikuti perkembangan dunia olahraga, mulai dari sepak bola, basket, hingga olahraga ekstrem, bisa dilihat kapan saja dan di mana saja. Umum (Berita & Informasi Olahraga) : Tentang berita terbaru, hasil pertandingan, statistik, dan informasi seputar olahraga favorit Anda dalam satu aplikasi! Ikuti perkembangan dunia olahraga, mulai dari sepak bola, basket, hingga olahraga ekstrem, bisa dilihat kapan saja dan di mana saja. Untuk Komunitas & Sosial : Bisa temukan teman, diskusikan pertandingan, dan bagikan pengalaman olahraga Anda. Dari penggemar hingga atlet, semua bisa terhubung di sini.Pelatihan & Kesehatan : akan tampil performa olahraga Anda dengan panduan latihan, program kebugaran, dan tips kesehatan dari para ahli. Mulai perjalanan olahraga Anda dengan rencana yang sesuai dengan kebutuhan Anda!">
        @yield('meta')

        <meta name="author" content="Nama Anda atau Nama Website">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index, follow">
        <meta property="og:title" content="Berita & Informasi Olahraga Terbaru | Skor, Jadwal, dan Statistik">
        <meta property="og:description" content="Ikuti perkembangan dunia olahraga, dari sepak bola hingga olahraga ekstrem. Update skor, hasil pertandingan, dan statistik terkini dalam satu aplikasi!">
        <meta property="og:image" content="URL_GAMBAR_PREVIEW">
        <meta property="og:url" content="URL_WEBSITE">
        <meta property="og:type" content="website">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Berita & Informasi Olahraga Terbaru | Skor, Jadwal, dan Statistik">
        <meta name="twitter:description" content="Dapatkan berita terbaru, hasil pertandingan, dan statistik olahraga favorit Anda dalam satu aplikasi!">
        <meta name="twitter:image" content="URL_GAMBAR_PREVIEW">

        <!-- Styles -->
        <link href="https://db.onlinewebfonts.com/c/44620fe64734f268ad07740e6ec5127d?family=CoolveticaRg-Regular+V1" rel="stylesheet" type="text/css"/>
        <link href="https://db.onlinewebfonts.com/c/0754a87a6aa14ab86abe03e805d71adf?family=CoolveticaCondensedRg-Regular" rel="stylesheet" type="text/css"/>
        <link href="https://db.onlinewebfonts.com/c/e695a2b548e145591a266fc50eb492e0?family=Regular" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- <script src="{{ asset('js/bootstrap.js') }}"></script> -->

    </head>
    <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="{{ asset('img/ludic.png') }}" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('welcome')}}">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('football.index') }}">Football</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('badminton.index') }}">Badminton</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('basket.index') }}">Basketball</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('volley.index') }}">Volley</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="navbarDropdownMenuLink">
                    Martial Arts and Others
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('taekwondo.index') }}">Taekwondo</a></li>
                        <li><a class="dropdown-item" href="{{ route('silat.index') }}">Pencak Silat</a></li>
                        <li><a class="dropdown-item" href="{{ route('karate.index') }}">Karate</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
            <!-- <a href="{{route('signup')}}" class="btn btn-outline-primary">Sign In</a>
            <a href="#" class="btn btn-primary">Sign Up</a> -->
        </div>
    </nav>
    @yield('content')
    <!-- Modal Report-->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="reportModalLabel">Report News</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason for reporting</label>
                            <select class="form-select form-control" id="reason">
                                <option selected disabled>Choose one reason</option>
                                <option value="1">Doesn't like it this news</option>
                                <option value="2">Have Contains elements of SARA</option>
                                <option value="3">Doesn't releated</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="detail" class="form-label">Details</label>
                            <textarea name="detail" class="form-control" id="detail"></textarea>
                        </div>
                        <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid footer">
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-3">
                        <img class="img1" src="{{ asset('img/ludic.png') }}" alt=""><br>
                    </div>
                    <div class="col-3 img2 mt-4">
                        <img src="{{ asset('img/mdi_instagram.png') }}" alt=""><a href="https://www.instagram.com/incoresystemssolutions/" target="_blank">Ludic.id</a>
                    </div>
                    <div class="col-6"></div>
                </div>
            </div>
            <div class="col-6 ft">
                <h4><a href="#" type="button">Home<img src="{{ asset('img/Component3.png') }}" alt=""></a></h4>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        var list = document.querySelectorAll("[data-bs-toggle=dropdown]");
        for (var i = 0, s = list.length; i< s; i ++) {
            var elm = list[i];
            elm.addEventListener("click", function() {
                // this for loop will hide previously clicked drop downs
                for (var j = 0, z = list.length; j < z; j++) { 
                    if (list[j] != this) {
                        var elm = document.querySelector(list[j].getAttribute("data-target"));
                        console.log(list[j]);
                        var str = elm.className.replace("d-block");
                        elm.className = str;
                    }
                } // if you like, remove the above loop
                var obj = document.querySelector(this.getAttribute("data-target"));
                if (obj.className.indexOf("d-block") > 0) { 
                var temp = obj.className.replace("d-block", "");
                obj.className = temp; 
                } else { obj.className += " d-block"; }
            });
        }
    </script>
    </body>
</html>
