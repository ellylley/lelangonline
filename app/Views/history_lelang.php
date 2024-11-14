<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .disabled-field {
    pointer-events: none;
    background-color: #e9ecef; /* Optional: change the background color to indicate it's disabled */
}
.profile-img {
    border-radius: 8px; /* Buat gambar menjadi kotak dengan sudut sedikit melengkung */
    width: 150px; /* Sesuaikan ukuran yang diinginkan */
    height: 150px; /* Sesuaikan ukuran yang diinginkan */
    object-fit: cover;
}


        </style>
</head>
<body>
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'></nav>
            </div>
        </div>
    </div>

    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="card-title">HISTORY LELANG</h4>

    <!-- Tombol Tambah dan Field Pencarian di Kanan -->
    <div class="d-flex">
        <div class="input-group me-2" style="max-width: 300px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari Lelang">
            <button class="btn btn-warning" onclick="filterTable()">Cari</button>
        </div>
        
    </div>
</div>

                <div class="card-content">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    
                                    <th>Nama Barang</th>
                                    <th>Foto</th>
                                    <th>Harga Awal</th>
                                    <th>Harga Tawaran</th>
                                    <th>Oleh</th>
                                    <th>Tanggal</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach($elly as $gou){
                                    if ($gou->isdelete == 0) {  
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?=$gou->nama_barang?></td>
                                    <td>
                                    <img src="<?php echo base_url('images/'.$gou->foto)?>" style="width: 60px; height: auto;">
                                </td>
                                <td>Rp <?= number_format($gou->harga_awal, 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($gou->penawaran_harga, 0, ',', '.') ?></td>
                                    <td><?=$gou->username . ' - ' . $gou->telp?></td>

                                    <td><?=$gou->created_at?></td>
                                   
                        

                                    
                        


                                </tr>
                                <?php
                                    }}
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

   


    
   


</div>

<!-- Script to populate edit modal with existing data -->
<script>
    
    function filterTable() {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const table = document.querySelector("table tbody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const namaCell = rows[i].getElementsByTagName("td")[1];
            const levelCell = rows[i].getElementsByTagName("td")[3];
            const empatCell = rows[i].getElementsByTagName("td")[4];
            const limaCell = rows[i].getElementsByTagName("td")[5];
            const enamCell = rows[i].getElementsByTagName("td")[6];
            const namaText = namaCell ? namaCell.textContent.toLowerCase() : "";
            const levelText = levelCell ? levelCell.textContent.toLowerCase() : "";
            const empatText = empatCell ? empatCell.textContent.toLowerCase() : "";
            const limaText = limaCell ? limaCell.textContent.toLowerCase() : "";
            const enamText = enamCell ? enamCell.textContent.toLowerCase() : "";

            if (namaText.includes(searchInput) || levelText.includes(searchInput)|| empatText.includes(searchInput)|| limaText.includes(searchInput)|| enamText.includes(searchInput)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

</script>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
