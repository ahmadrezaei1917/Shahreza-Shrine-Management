<?php include "Checklogin.php"; ?>
<?php include "Check_Admin.php"; ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <title>اطلاعیه جدید</title>
  <?php include "Header.php"; ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .upload-container {
      max-width: 800px;
      margin: 50px auto;
      padding: 30px;
      border-radius: 15px;
     
      
    }
    .upload-area {
      border: 2px dashed #ccc;
      border-color: black;
      border-radius: 10px;
      padding: 30px;
      text-align: center;
      margin-bottom: 20px;
      cursor: pointer;
      transition: all 0.3s;
    }
    .upload-area:hover {
      border-color: #0d6efd;
      background-color: #f0f7ff;
    }
    .preview-container {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 20px;
    }
    .preview-item {
      position: relative;
      width: 150px;
      height: 150px;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .preview-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .remove-btn {
      position: absolute;
      top: 5px;
      left: 5px;
      background: rgba(255, 0, 0, 0.7);
      color: white;
      border: none;
      width: 25px;
      height: 25px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
    }
    .btn-submit {
      width: 100%;
      padding: 12px;
      font-size: 18px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="upload-container blur">
      <h2 class="text-center mb-4">آپلود اطلاعیه ها</h2>
      <p class="text-center text-muted mb-4">می‌توانید بین 1 تا 3 عکس آپلود کنید</p>
      
      <form id="uploadForm" action="process_upload.php" method="post" enctype="multipart/form-data">
        <div class="upload-area" id="uploadArea">
          <i class="bi bi-cloud-arrow-up fs-1 text-primary"></i>
          <p class="mt-3">برای انتخاب عکس‌ها کلیک کنید یا فایل‌ها را اینجا بکشید</p>
          <input type="file" id="fileInput" name="slider_images[]" multiple accept="image/*" class="d-none">
        </div>
        
        <div class="preview-container" id="previewContainer"></div>
        
        <div class="d-grid gap-2 mt-4">
          <button type="submit" class="btn btn-primary btn-submit" id="submitBtn" disabled>
            <span class="spinner-border spinner-border-sm d-none" id="spinner"></span>
            ذخیره عکس‌ها
          </button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const fileInput = document.getElementById('fileInput');
    const uploadArea = document.getElementById('uploadArea');
    const previewContainer = document.getElementById('previewContainer');
    const submitBtn = document.getElementById('submitBtn');
    const spinner = document.getElementById('spinner');
    const form = document.getElementById('uploadForm');
    
    let files = [];
    
    // Handle click on upload area
    uploadArea.addEventListener('click', () => {
      fileInput.click();
    });
    
    // Handle drag and drop
    uploadArea.addEventListener('dragover', (e) => {
      e.preventDefault();
      uploadArea.classList.add('bg-light');
    });
    
    uploadArea.addEventListener('dragleave', () => {
      uploadArea.classList.remove('bg-light');
    });
    
    uploadArea.addEventListener('drop', (e) => {
      e.preventDefault();
      uploadArea.classList.remove('bg-light');
      
      if (e.dataTransfer.files.length) {
        handleFiles(e.dataTransfer.files);
      }
    });
    
    // Handle file selection
    fileInput.addEventListener('change', () => {
      if (fileInput.files.length) {
        handleFiles(fileInput.files);
      }
    });
    
    // Process selected files
    function handleFiles(selectedFiles) {
      // Clear previous files if any
      files = [];
      previewContainer.innerHTML = '';
      
      // Limit to 3 files
      const filesToProcess = Array.from(selectedFiles).slice(0, 3);
      
      filesToProcess.forEach((file, index) => {
        if (file.type.startsWith('image/')) {
          files.push(file);
          
          const reader = new FileReader();
          reader.onload = (e) => {
            const previewItem = document.createElement('div');
            previewItem.className = 'preview-item';
            
            previewItem.innerHTML = `
              <img src="${e.target.result}" alt="Preview ${index + 1}">
              <button type="button" class="remove-btn" data-index="${index}">&times;</button>
            `;
            
            previewContainer.appendChild(previewItem);
          };
          reader.readAsDataURL(file);
        }
      });
      
      // Enable submit button if we have at least 1 file
      submitBtn.disabled = files.length === 0;
    }
    
    // Handle remove button clicks
    previewContainer.addEventListener('click', (e) => {
      if (e.target.classList.contains('remove-btn')) {
        const index = parseInt(e.target.getAttribute('data-index'));
        files.splice(index, 1);
        
        // Re-render previews
        previewContainer.innerHTML = '';
        files.forEach((file, newIndex) => {
          const reader = new FileReader();
          reader.onload = (event) => {
            const previewItem = document.createElement('div');
            previewItem.className = 'preview-item';
            
            previewItem.innerHTML = `
              <img src="${event.target.result}" alt="Preview ${newIndex + 1}">
              <button type="button" class="remove-btn" data-index="${newIndex}">&times;</button>
            `;
            
            previewContainer.appendChild(previewItem);
          };
          reader.readAsDataURL(file);
        });
        
        submitBtn.disabled = files.length === 0;
      }
    });
    
    // Handle form submission
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      
      // Show loading spinner
      spinner.classList.remove('d-none');
      submitBtn.disabled = true;
      
      // Create FormData and append files
      const formData = new FormData();
      files.forEach((file, index) => {
        formData.append(`slider_images[]`, file);
      });
      
      // Send AJAX request
      fetch('process_upload.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('عکس‌ها با موفقیت آپلود شدند!');
          window.location.href = 'index.php'; // Redirect to home page
        } else {
          alert(data.message || 'خطا در آپلود عکس‌ها');
        }
      })
      .catch(error => {
        alert('خطا در ارتباط با سرور');
      })
      .finally(() => {
        spinner.classList.add('d-none');
        submitBtn.disabled = false;
      });
    });
  </script>

 <?php include "Footer.php"; ?>