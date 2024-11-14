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
    <h4 class="card-title">BARANG LELANG</h4>

    <!-- Tombol Tambah dan Field Pencarian di Kanan -->
    <div class="d-flex">
        <div class="input-group me-2" style="max-width: 300px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari Lelang">
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
                                    <th>Tanggal Lelang</th>
                                    <th>Harga Awal</th>
                                    
                                    <th>Harga Akhir</th>
                                    <?php if (in_array(session()->get('level'), [2])): ?>
                                    <th>Status</th>
                                    <?php endif; ?>
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
                                    <td><?=$gou->tgl_lelang?></td>
                                    <td>Rp <?= number_format($gou->harga_awal, 0, ',', '.') ?></td>
                                    <td>Rp <?= number_format($gou->harga_akhir, 0, ',', '.') ?></td>
                                    <?php if (in_array(session()->get('level'), [2])): ?>
                                    <td>
    <button id="statusButton" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#statusModal" data-id="<?= $gou->id_lelang ?>" data-status="<?= $gou->status ?>">
        <?= ($gou->status == 'Dibuka') ? 'Dibuka' : ($gou->status == 'Ditutup' ? 'Ditutup' : 'Status') ?>
    </button>
</td>
<?php endif; ?>

                                    
                                    <td>
    <div class="dropdown">
        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="actionMenu" data-bs-toggle="dropdown" aria-expanded="false">
            Aksi
        </button>
        <ul class="dropdown-menu" aria-labelledby="actionMenu">
            <li>
                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editUserModal"
                    data-id="<?= $gou->id_lelang ?>"
                    data-nama="<?= $gou->id_barang ?>"
                    data-tgl="<?= $gou->tgl_lelang ?>"
                    data-awal="<?= $gou->harga_awal ?>"
                    data-akhir="<?= $gou->harga_akhir ?>"
                    data-status="<?= $gou->status ?>"
                  
                    >Edit
                </button>
            </li>
            <li><a class="dropdown-item" href="<?= base_url('home/hapuslelang/' . $gou->id_lelang) ?>">Hapus</a></li>
            
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
                    <h5 class="modal-title" id="addUserModalLabel">Tambah Lelang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('home/aksi_tambah_lelang') ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                    

                        <div class="col-md-4">
                                <label>Nama Barang</label>
                            </div>
                            <div class="col-md-8 form-group">
                            <select class="form-select" id="nama" name="nama" onchange="toggleKelas()">
                                <option value="" >Pilih Barang</option>
                        <?php foreach($nama as $barang){ ?>
                            <option value="<?=$barang->id_barang?>"><?=$barang->nama_barang?></option>
                        <?php } ?>
                                </select>
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

    <!-- Status Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Status Lelang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('home/update_status_lelang') ?>" method="POST">
                    <input type="hidden" id="statusId" name="id_lelang">
                    <div class="form-group">
                        <label for="statusSelect">Pilih Status</label>
                        <select id="statusSelect" class="form-select" name="status">
                        <option value="">Pilih</option>
                            <option value="Dibuka">Dibuka</option>
                            <option value="Ditutup">Ditutup</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Cancel</button>
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
                    <h5 class="modal-title" id="editUserModalLabel">Edit Lelang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" action="<?= base_url('home/aksi_edit_lelang') ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">

                        <div class="col-md-4">
                                <label>Nama Barang</label>
                            </div>
                            <div class="col-md-8 form-group">
                            <select class="form-select" id="editnama" name="nama" onchange="toggleKelas()">
                                <option value="" >Pilih Barang</option>
                        <?php foreach($nama as $barang){ ?>
                            <option value="<?=$barang->id_barang?>"><?=$barang->nama_barang?></option>
                        <?php } ?>
                                </select>
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
        var awal = button.getAttribute('data-awal');
        var akhir = button.getAttribute('data-akhir');
        var status = button.getAttribute('data-status');
       

        var modal = document.getElementById('editUserModal');
        modal.querySelector('#editId').value = id;
        modal.querySelector('#editnama').value = nama;
        modal.querySelector('#edittgl').value = tgl;
        modal.querySelector('#editawal').value = awal;
        modal.querySelector('#editakhir').value = akhir;
        modal.querySelector('#editstatus').value = status;
           
        
    });

    document.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var status = button.getAttribute('data-status');
        
        var modal = document.getElementById('statusModal');
        modal.querySelector('#statusId').value = id;
        modal.querySelector('#statusSelect').value = status;
    });



    function filterTable() {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const table = document.querySelector("table tbody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const namaCell = rows[i].getElementsByTagName("td")[1];
            const levelCell = rows[i].getElementsByTagName("td")[3];
            const empatCell = rows[i].getElementsByTagName("td")[4];
            const limaCell = rows[i].getElementsByTagName("td")[5];
            const namaText = namaCell ? namaCell.textContent.toLowerCase() : "";
            const levelText = levelCell ? levelCell.textContent.toLowerCase() : "";
            const empatText = empatCell ? empatCell.textContent.toLowerCase() : "";
            const limaText = limaCell ? limaCell.textContent.toLowerCase() : "";

            if (namaText.includes(searchInput) || levelText.includes(searchInput)|| empatText.includes(searchInput)|| limaText.includes(searchInput)) {
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
