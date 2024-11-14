<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Profile</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 1200px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
    }
    .profile-info {
        margin-bottom: 20px;
    }
    .profile-info label {
        font-weight: bold;
    }
    .profile-info img {
    width: 120px;
    height: auto;
    display: block;
    margin: auto;
    align: center;
}
</style>
</head>
<body>
<form id="sellerForm" novalidate action="<?= base_url('home/aksisetting/')?>" method="POST" enctype="multipart/form-data">
    <div class="container">
        <h4 style="text-align: center;">SETTING</h4>
        
        <div class="profile-info">
            <label for="logo">Logo:</label>
            <img src="<?php echo base_url('images/'.$user->logo_web) ?>" style="width: 150px; height: auto;">
            <input name="foto" type="file" class="form-control" id="foto" onchange="previewImage()">
            <input name="id" type="hidden" class="form-control" id="id" value="<?= $user->id_setting?>">
           
        </div>
        <div class="profile-info">
            <label for="name">Nama Web:</label>
            <input name="nama" type="text" class="form-control" id="nama" value="<?= $user->nama_web?>">
        </div>
        
        <div class="d-flex justify-content-end">
    <button class="btn btn-warning btn-sm">Save Edit</button>
</div>

    </div>
</form>

<script>
    function previewImage() {
        const fileInput = document.getElementById('foto');
        const preview = document.getElementById('preview');
        
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function (e) {
                preview.src = e.target.result;
            }
            
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>
</body>
</html>
