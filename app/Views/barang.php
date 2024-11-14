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
    <h4 class="card-title">BARANG</h4>

    <!-- Tombol Tambah dan Field Pencarian di Kanan -->
    <div class="d-flex">
        <div class="input-group me-2" style="max-width: 300px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari Barang">
            <button class="btn btn-warning" onclick="filterTable()">Cari</button>
        </div>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">Tambah</button>
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
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
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

                                    <td><?=$gou->deskripsi_barang?></td>
                                    
                                    <td>
    <div class="dropdown">
        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="actionMenu" data-bs-toggle="dropdown" aria-expanded="false">
            Aksi
        </button>
        <ul class="dropdown-menu" aria-labelledby="actionMenu">
            <li>
                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editUserModal"
                    data-id="<?= $gou->id_barang ?>"
                    data-nama="<?= $gou->nama_barang ?>"
                    data-tgl="<?= $gou->tgl ?>"
                    data-harga="<?= $gou->harga_awal ?>"
                    data-deskripsi="<?= $gou->deskripsi_barang ?>"
                    data-foto="<?= $gou->foto ?>"
                  
                    >Edit
                </button>
            </li>
            <li><a class="dropdown-item" href="<?= base_url('home/hapusbarang/' . $gou->id_barang) ?>">Hapus</a></li>
            
        </ul>
    </div>
</td>


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

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('home/aksi_tambah_barang') ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                    

                            <div class="col-md-4">
                                <label>Nama Barang</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama Barang">
                            </div>

                            <div class="col-md-4">
                                <label>Foto</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="file" id="foto" class="form-control" name="foto" placeholder="Foto">
                            </div>

                            <div class="col-md-4">
                                <label>Harga Awal</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" id="harga" class="form-control" name="harga" placeholder="Harga Awal">
                            </div>
                            <div class="col-md-4">
                                <label>Deskripsi Barang</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="desk" class="form-control" name="desk" placeholder="Deskripsi Barang">
                            </div>
            

 

                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" action="<?= base_url('home/aksi_edit_barang') ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">

                        <div class="col-md-4">
                                <label>Nama Barang</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="editnama" class="form-control" name="nama" placeholder="Nama Barang">
                            </div>

                            <div class="col-md-4">
                                <label>Foto</label>
                            </div>
                            <div class="col-md-8 form-group">
    <img id="editProfileImg" src="<?php echo base_url('images/'.$satu->foto) ?>" class="profile-img mb-3" alt="Profile Picture">
    <input type="file" id="foto" class="form-control" name="foto">
    <input type="hidden" id="old_foto" name="old_foto">
</div>


                            <div class="col-md-4">
                                <label>Harga Awal</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" id="editharga" class="form-control" name="harga" placeholder="Harga Awal">
                            </div>
                            <div class="col-md-4">
                                <label>Deskripsi Barang</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="editdesk" class="form-control" name="desk" placeholder="Deskripsi Barang">
                            </div>

                            
                            <input type="hidden" id="editId" name="id">

                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

   


</div>

<!-- Script to populate edit modal with existing data -->
<script>
    document.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nama = button.getAttribute('data-nama');
        var tgl = button.getAttribute('data-tgl');
        var harga = button.getAttribute('data-harga');
        var deskripsi = button.getAttribute('data-deskripsi');
        var foto = button.getAttribute('data-foto');
       

        var modal = document.getElementById('editUserModal');
        modal.querySelector('#editId').value = id;
        modal.querySelector('#editnama').value = nama;
        modal.querySelector('#editharga').value = harga;
        modal.querySelector('#editdesk').value = deskripsi;
           
        modal.querySelector('#old_foto').value = foto;
        modal.querySelector('#editProfileImg').src = "<?= base_url('images/')?>" + '/' + foto;
    });



    function filterTable() {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const table = document.querySelector("table tbody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const namaCell = rows[i].getElementsByTagName("td")[1];
            const levelCell = rows[i].getElementsByTagName("td")[3];
            const empatCell = rows[i].getElementsByTagName("td")[4];
            const namaText = namaCell ? namaCell.textContent.toLowerCase() : "";
            const levelText = levelCell ? levelCell.textContent.toLowerCase() : "";
            const empatText = empatCell ? empatCell.textContent.toLowerCase() : "";

            if (namaText.includes(searchInput) || levelText.includes(searchInput)|| empatText.includes(searchInput)) {
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
