@extends('layout.app')

@section('meta')
    @php
        $defaultKeywords = 'berita olahraga, update skor, hasil pertandingan, statistik olahraga, jadwal pertandingan, skor bola, jadwal liga, live score, NBA updates, transfer pemain, komunitas olahraga, forum olahraga, diskusi pertandingan, penggemar olahraga, live chat bola';

        $defauldDescription = 'Tentang berita terbaru, hasil pertandingan, statistik, dan informasi seputar olahraga favorit Anda dalam satu aplikasi! Ikuti perkembangan dunia olahraga, mulai dari sepak bola, basket, hingga olahraga ekstrem, bisa dilihat kapan saja dan di mana saja. Untuk Komunitas & Sosial : Bisa temukan teman, diskusikan pertandingan, dan bagikan pengalaman olahraga Anda. Dari penggemar hingga atlet, semua bisa terhubung di sini.Pelatihan & Kesehatan : akan tampil performa olahraga Anda dengan panduan latihan, program kebugaran, dan tips kesehatan dari para ahli. Mulai perjalanan olahraga Anda dengan rencana yang sesuai dengan kebutuhan Anda!';

        $descriptionArtikel = trim($article->highlight1 ?? '');

        $description = strlen($descriptionArtikel ?? '') > 0
            ? $descriptionArtikel
            : $defauldDescription;

        $headline = trim($article->headlineUtamaArtikel ?? '');

        $keywords = strlen($headline) > 0
            ? implode(', ', preg_split('/\s+/', $headline))
            : $defaultKeywords;
    @endphp
    <meta name="keywords" content="{{ $keywords }}">
    <meta name="description" content="{{ $description }}">
@endsection

@section('content')
    <div style="text-align: center; padding: 80px 20px;">
        <h1 style="font-size: 36px; color: #e3342f;">Website Sedang dalam Pemeliharaan</h1>
        <p style="font-size: 18px; margin-top: 20px;">Kami sedang melakukan pemeliharaan sistem untuk meningkatkan layanan. Silakan coba kembali beberapa saat lagi.</p>
    </div>

@endsection
