// JS for Evidence Upload Page
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('uploadForm');
    const progressBar = document.getElementById('uploadProgress');

    if(form){
        form.addEventListener('submit', function(e){
            e.preventDefault();

            const fileInput = document.getElementById('evidenceFile');
            const file = fileInput.files[0];
            if(!file) {
                alert("Please select a file to upload!");
                return;
            }

            const formData = new FormData();
            formData.append('file', file);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/upload', true);

            xhr.upload.onprogress = function(e){
                if(e.lengthComputable){
                    const percentComplete = (e.loaded / e.total) * 100;
                    progressBar.style.width = percentComplete + '%';
                    progressBar.innerText = Math.floor(percentComplete) + '%';
                }
            };

            xhr.onload = function(){
                if(xhr.status === 200){
                    showAlert("File uploaded successfully!");
                    form.reset();
                    progressBar.style.width = '0%';
                    progressBar.innerText = '0%';
                } else {
                    showAlert("Upload failed!", "danger");
                }
            };

            xhr.send(formData);
        });
    }
});
