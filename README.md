# File Compression Web Application

A Laravel-based web application for compressing images and videos. This application allows users to upload images (JPG, PNG) and videos (MP4) and compresses them while maintaining quality.

## Features

- Image compression using Intervention Image
- Video compression using PHP-FFMpeg
- Drag and drop file upload
- Real-time compression status
- Download compressed files
- Responsive design

## Requirements

- PHP >= 8.1
- Composer
- FFmpeg (for video compression)
- Laravel >= 10.0
- Node.js & NPM (for frontend assets)

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd kompresi-app
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install FFmpeg:

For Windows:
- Download FFmpeg from https://ffmpeg.org/download.html
- Add FFmpeg to your system PATH
- Update the FFmpeg binary paths in `FileCompressionController.php`:
```php
'ffmpeg.binaries' => 'C:/ffmpeg/bin/ffmpeg.exe',
'ffprobe.binaries' => 'C:/ffmpeg/bin/ffprobe.exe',
```

For Linux:
```bash
sudo apt-get update
sudo apt-get install ffmpeg
```

4. Create environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Create symbolic link for storage:
```bash
php artisan storage:link
```

7. Set proper permissions:
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

## Running the Application

1. Start the development server:
```bash
php artisan serve
```

2. Visit `http://localhost:8000` in your browser

## Usage

1. Open the application in your web browser
2. Drag and drop a file (JPG, PNG, or MP4) or click to select a file
3. Wait for the compression process to complete
4. Download the compressed file

## File Size Limits

- Maximum file size: 100MB
- Supported formats: JPG, JPEG, PNG, MP4

## Security

- Files are validated before processing
- Original files are stored temporarily
- Compressed files are stored in the public directory

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

This project is licensed under the MIT License.
