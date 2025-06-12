<?php
// Uji apakah FFmpeg bisa dijalankan dari PHP
$output = shell_exec('C:/ffmpeg/bin/ffmpeg.exe -version 2>&1');
echo "<pre>" . htmlspecialchars($output) . "</pre>"; 