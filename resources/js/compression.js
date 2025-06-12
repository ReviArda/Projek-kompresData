const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('fileInput');
const loading = document.querySelector('.loading');
const result = document.getElementById('result');

// Drag and drop handlers
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropZone.classList.add('dragover');
});

['dragleave', 'drop'].forEach(eventName => {
    dropZone.classList.remove('dragover');
});

dropZone.addEventListener('drop', handleDrop, false);
fileInput.addEventListener('change', handleFileSelect, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    handleFiles(files);
}

function handleFileSelect(e) {
    const files = e.target.files;
    handleFiles(files);
}

function handleFiles(files) {
    if (files.length > 0) {
        const file = files[0];
        uploadFile(file);
    }
}

function uploadFile(file) {
    const formData = new FormData();
    formData.append('file', file);

    loading.style.display = 'block';
    result.style.display = 'none';

    fetch('/compress', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(async response => {
        let data = await response.json();
        if (!response.ok) {
            alert('Terjadi kesalahan: ' + (data.message || 'Gagal kompresi.'));
            throw new Error(data.message || 'Unknown error');
        }
        loading.style.display = 'none';
        result.style.display = 'block';

        document.getElementById('originalSize').textContent = data.original_size;
        document.getElementById('compressedSize').textContent = data.compressed_size;
        document.getElementById('savings').textContent = data.savings;
        document.getElementById('savingsPercentage').textContent = data.savings_percentage;
        document.getElementById('downloadBtn').href = data.download_url;
    })
    .catch(error => {
        loading.style.display = 'none';
        alert('Terjadi kesalahan saat kompresi. Silakan coba lagi.');
        console.error('Error:', error);
    });
} 