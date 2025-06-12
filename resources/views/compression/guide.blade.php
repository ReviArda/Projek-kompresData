@extends('layouts.app')
@section('title', 'Panduan Penggunaan')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h3 class="mb-3 text-primary">Panduan Penggunaan</h3>
            <div class="mb-4 text-center">
                <!-- Ilustrasi SVG upload & kompresi -->
                <svg width="120" height="80" viewBox="0 0 120 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="10" y="30" width="100" height="40" rx="10" fill="#e0e7ff"/>
                    <rect x="25" y="45" width="70" height="15" rx="6" fill="#6366f1"/>
                    <path d="M60 20 L70 35 H65 V55 H55 V35 H50 L60 20 Z" fill="#0d6efd"/>
                    <circle cx="100" cy="65" r="5" fill="#fbbf24"/>
                    <circle cx="20" cy="65" r="3" fill="#f472b6"/>
                </svg>
            </div>
            <ol class="info-text mb-4">
                <li><b>Pilih File:</b> Klik tombol <b>Pilih File</b> atau seret file ke area yang disediakan.</li>
                <li><b>Kompresi Otomatis:</b> Sistem akan otomatis mendeteksi dan mengompresi file Anda.</li>
                <li><b>Unduh Hasil:</b> Setelah selesai, klik tombol <b>Unduh File Hasil Kompresi</b> untuk menyimpan file.</li>
            </ol>
            <div class="alert alert-info">
                <b>Tips:</b>
                <ul class="mb-0">
                    <li>Pastikan file berformat JPG, PNG, atau MP4 dan tidak melebihi 100MB.</li>
                    <li>Untuk hasil terbaik, gunakan gambar/video dengan resolusi tidak terlalu besar.</li>
                    <li>File Anda aman, tidak disimpan permanen di server.</li>
                </ul>
            </div>
            <a href="/" class="btn btn-outline-primary mt-4">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection 