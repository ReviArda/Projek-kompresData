@extends('layouts.app')
@section('title', 'Kompresi Gambar & Video')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            <div class="text-center mb-4">
                <div class="hero-illustration mb-3">
                    <!-- SVG Ilustrasi warna-warni -->
                    <svg width="120" height="80" viewBox="0 0 120 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <ellipse cx="60" cy="40" rx="55" ry="28" fill="#e0e7ff"/>
                        <ellipse cx="60" cy="40" rx="40" ry="18" fill="#c7d2fe"/>
                        <ellipse cx="60" cy="40" rx="25" ry="10" fill="#a5b4fc"/>
                        <circle cx="60" cy="40" r="18" fill="#6366f1"/>
                        <circle cx="60" cy="40" r="10" fill="#0d6efd"/>
                        <circle cx="90" cy="20" r="6" fill="#fbbf24"/>
                        <circle cx="30" cy="60" r="4" fill="#f472b6"/>
                        <circle cx="100" cy="60" r="3" fill="#34d399"/>
                    </svg>
                </div>
                <span class="brand">Kompresi Gambar & Video</span>
                <p class="info-text mt-2">Kompres file gambar (JPG, PNG) & video (MP4) secara online, mudah, dan gratis.</p>
            </div>
            <div class="card shadow-sm border-0 animate-fadein">
                <div class="card-body">
                    <div class="drop-zone mb-4 animate-pop" id="dropZone">
                        <i class="fa-solid fa-cloud-upload-alt"></i>
                        <h4 class="mb-2 mt-2">Seret & Lepas File Anda di Sini</h4>
                        <p class="info-text mb-2">atau</p>
                        <input type="file" id="fileInput" class="d-none" accept=".jpg,.jpeg,.png,.mp4">
                        <button class="btn custom-btn px-4" onclick="document.getElementById('fileInput').click()">
                            Pilih File
                        </button>
                        <p class="mt-3 info-text">Format didukung: <b>JPG, PNG, MP4</b><br>Ukuran maksimal: 100MB</p>
                    </div>

                    <div class="loading text-center mt-4 animate-fadein">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Sedang memproses & mengompresi file Anda...</p>
                    </div>

                    <div id="result" class="mt-4 animate-slideup">
                        <div class="alert alert-success">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fa-solid fa-circle-check fa-2x text-success me-2"></i>
                                <h5 class="mb-0">Kompresi Berhasil!</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Ukuran Awal:</strong> <span id="originalSize"></span></p>
                                    <p><strong>Ukuran Setelah Kompres:</strong> <span id="compressedSize"></span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Hemat Ruang:</strong> <span id="savings"></span></p>
                                    <p><strong>Rasio Kompresi:</strong> <span id="savingsPercentage"></span>%</p>
                                </div>
                            </div>
                            <a href="#" id="downloadBtn" class="btn custom-btn mt-2" download>
                                <i class="fa-solid fa-download me-1"></i> Unduh File Hasil Kompresi
                            </a>
                        </div>
                    </div>
                    <div class="text-center mt-4 info-text">
                        <small>Privasi terjaga: File Anda tidak disimpan permanen di server.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('storage/js/compression.js') }}"></script>
@endsection 