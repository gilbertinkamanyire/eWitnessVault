/**
 * eWitnessVault - Upload Script
 * Handles file upload, validation, progress tracking, and success alerts.
 * Author: Tinkamanyire Gilbert & Team
 */

document.addEventListener("DOMContentLoaded", function () {
  console.log("%c📤 Upload Module Ready", "color: green; font-weight: bold;");

  const uploadForm = document.getElementById("uploadForm");
  const fileInput = document.getElementById("evidenceFile");
  const description = document.getElementById("description");
  const progressBar = document.getElementById("uploadProgress");
  const statusText = document.getElementById("uploadStatus");
  const previewBox = document.getElementById("filePreview");
  const MAX_FILE_SIZE_MB = 100;

  // Preview selected file
  fileInput.addEventListener("change", function () {
    previewBox.innerHTML = "";
    const file = fileInput.files[0];
    if (file) {
      const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
      const fileInfo = document.createElement("p");
      fileInfo.textContent = `📄 ${file.name} (${sizeMB} MB)`;
      previewBox.appendChild(fileInfo);

      if (file.type.startsWith("image/")) {
        const img = document.createElement("img");
        img.src = URL.createObjectURL(file);
        img.classList.add("preview-image");
        previewBox.appendChild(img);
      }
    }
  });

  // Form submission
  uploadForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const file = fileInput.files[0];

    if (!file) {
      alert("Please select a file to upload.");
      return;
    }

    if (file.size > MAX_FILE_SIZE_MB * 1024 * 1024) {
      alert(`File too large! Max allowed size is ${MAX_FILE_SIZE_MB} MB.`);
      return;
    }

    const formData = new FormData();
    formData.append("evidenceFile", file);
    formData.append("description", description.value);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/api/evidence/upload", true);

    // Update progress bar
    xhr.upload.onprogress = function (event) {
      if (event.lengthComputable) {
        const percent = Math.round((event.loaded / event.total) * 100);
        progressBar.style.width = percent + "%";
        progressBar.textContent = percent + "%";
      }
    };

    // On success
    xhr.onload = function () {
      if (xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        if (response.success) {
          progressBar.style.width = "100%";
          progressBar.textContent = "✅ Uploaded";
          statusText.textContent = "Upload complete!";
          statusText.classList.add("success");
          uploadForm.reset();
          previewBox.innerHTML = "";
        } else {
          statusText.textContent = "❌ Upload failed: " + response.message;
          statusText.classList.add("error");
        }
      } else {
        statusText.textContent = "⚠️ Server error. Try again.";
        statusText.classList.add("error");
      }
    };

    // On error
    xhr.onerror = function () {
      statusText.textContent = "❌ Network error. Please try again.";
      statusText.classList.add("error");
    };

    // Start upload
    xhr.send(formData);
    statusText.textContent = "Uploading...";
    statusText.classList.remove("success", "error");
  });
});
