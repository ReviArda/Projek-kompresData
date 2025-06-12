<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Format\Video\X264;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class FileCompressionController extends Controller
{
    public function index()
    {
        return view('compression.index');
    }

    public function compress(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,mp4|max:102400'
        ]);

        $file = $request->file('file');
        $originalSize = $file->getSize();
        $mimeType = $file->getMimeType();
        $fileName = time() . '_' . $file->getClientOriginalName();
        
        // Store original file
        $file->storeAs('uploads/original', $fileName, 'public');
        
        if (strpos($mimeType, 'image') !== false) {
            return $this->compressImage($fileName, $originalSize);
        } else {
            return $this->compressVideo($fileName, $originalSize);
        }
    }

    private function compressImage($fileName, $originalSize)
    {
        $path = storage_path('app/public/uploads/original/' . $fileName);
        $compressedPath = storage_path('app/public/uploads/compressed/' . $fileName);
        
        // Create compressed directory if it doesn't exist
        if (!file_exists(storage_path('app/public/uploads/compressed'))) {
            mkdir(storage_path('app/public/uploads/compressed'), 0777, true);
        }

        // Kompresi gambar dengan ImageManager v3
        $manager = new ImageManager(new GdDriver());
        $image = $manager->read($path);
        $image->toJpeg(quality: 60)->save($compressedPath);

        $compressedSize = filesize($compressedPath);
        $savings = $originalSize - $compressedSize;
        $savingsPercentage = round(($savings / $originalSize) * 100, 2);

        return response()->json([
            'success' => true,
            'type' => 'image',
            'original_size' => $this->formatSize($originalSize),
            'compressed_size' => $this->formatSize($compressedSize),
            'savings' => $this->formatSize($savings),
            'savings_percentage' => $savingsPercentage,
            'download_url' => asset('storage/uploads/compressed/' . $fileName)
        ]);
    }

    private function compressVideo($fileName, $originalSize)
    {
        $input = str_replace('/', '\\', storage_path('app/public/uploads/original/' . $fileName));
        $output = str_replace('/', '\\', storage_path('app/public/uploads/compressed/' . $fileName));

        // Pastikan folder output ada
        if (!file_exists(dirname($output))) {
            mkdir(dirname($output), 0777, true);
        }

        $ffmpegPath = 'C:/ffmpeg/ffmpeg-7.1.1-full_build/bin/ffmpeg.exe';
        $cmd = $ffmpegPath . ' -i ' . escapeshellarg($input) . ' -b:v 1000k -y ' . escapeshellarg($output);
        $result = shell_exec($cmd . " 2>&1");

        if (!file_exists($output) || filesize($output) == 0) {
            \Log::error('FFmpeg shell_exec failed', [
                'cmd' => $cmd,
                'output' => $result
            ]);
            return response()->json([
                'success' => false,
                'message' => 'FFmpeg failed: ' . $result,
            ], 500);
        }

        $compressedSize = filesize($output);
        $savings = $originalSize - $compressedSize;
        $savingsPercentage = round(($savings / $originalSize) * 100, 2);

        return response()->json([
            'success' => true,
            'type' => 'video',
            'original_size' => $this->formatSize($originalSize),
            'compressed_size' => $this->formatSize($compressedSize),
            'savings' => $this->formatSize($savings),
            'savings_percentage' => $savingsPercentage,
            'download_url' => asset('storage/uploads/compressed/' . $fileName)
        ]);
    }

    private function formatSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, 2) . ' ' . $units[$pow];
    }
} 