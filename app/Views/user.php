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
.img-circle {
    border-radius: 50%;
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
    <h4 class="card-title">USER</h4>

    <!-- Tombol Tambah dan Field Pencarian di Kanan -->
    <div class="d-flex">
        <div class="input-group me-2" style="max-width: 300px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari User">
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
                                    <th>Username</th>
                                    <th>Nomor Telepon</th>
                                    <th>Level</th>
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
                                    <td><?=$gou->username?></td>
                                    <td><?=$gou->telp?></td>
                                    <td><?=$gou->level?></td>
                                    
                                    <td>
    <div class="dropdown">
        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="actionMenu" data-bs-toggle="dropdown" aria-expanded="false">
            Aksi
        </button>
        <ul class="dropdown-menu" aria-labelledby="actionMenu">
            <li>
                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editUserModal"
                    data-id="<?= $gou->id_user ?>"
                    data-nama="<?= $gou->nama_lengkap ?>"
                    data-usn="<?= $gou->username ?>"
                    data-telp="<?= $gou->telp ?>"
                    data-level="<?= $gou->id_level ?>"
                  
                    >Edit
                </button>
            </li>
            <li><a class="dropdown-item" href="<?= base_url('home/hapususer/' . $gou->id_user) ?>">Hapus</a></li>
            <li><a class="dropdown-item" href="<?= base_url('home/aksi_reset/' . $gou->id_user) ?>">Reset Password</a></li>
            
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
                    <h5 class="modal-title" id="addUserModalLabel">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('home/aksi_tambah_user') ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                        <div class="col-md-4">
                                <label>Level</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" id="level" name="level" onchange="toggleKelas()">
                                <option value="" >Pilih Level</option>
                        <?php foreach($level as $lvl){ ?>
                            <option value="<?=$lvl->id_level?>"><?=$lvl->level?></option>
                        <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Nama Lengkap</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama Lengkap">
                            </div>

                            <div class="col-md-4">
                                <label>Username</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="usn" class="form-control" name="usn" placeholder="Username">
                            </div>
                            <div class="col-md-4">
                                <label>Nomor Telepon</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nohp" class="form-control" name="nohp" placeholder="Nomor Telepon">
                            </div>
                            <div class="col-md-4">
                                <label>Password</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="password" id="password" class="form-control" name="password" placeholder="Password">
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
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" action="<?= base_url('home/aksi_edit_user') ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">

                        <div class="col-md-4">
                                <label>Level</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" id="editlevel" name="level" onchange="toggleKelas()">
                                <option value="" >Pilih Level</option>
                        <?php foreach($level as $lvl){ ?>
                            <option value="<?=$lvl->id_level?>"><?=$lvl->level?></option>
                        <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Nama Lengkap</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="editnama" class="form-control" name="nama" placeholder="Nama Lengkap">
                            </div>

                            <div class="col-md-4">
                                <label>Username</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="editusn" class="form-control" name="usn" placeholder="Username">
                            </div>
                            <div class="col-md-4">
                                <label>Nomor Telepon</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="editnohp" class="form-control" name="nohp" placeholder="Nomor Telepon">
                            </div>


                            
                            

                            <!-- Hidden Password Field -->
                            <input type="hidden" id="editPassword" name="password">
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
        var usn = button.getAttribute('data-usn');
        var nohp = button.getAttribute('data-telp');
        var level = button.getAttribute('data-level');
        var password = button.getAttribute('data-password');

        var modal = document.getElementById('editUserModal');
        modal.querySelector('#editId').value = id;
        modal.querySelector('#editnama').value = nama;
        modal.querySelector('#editusn').value = usn;
        modal.querySelector('#editnohp').value = nohp;
        modal.querySelector('#editlevel').value = level;
        modal.querySelector('#editPassword').value = password;
       

      


       
       
    });

    



    function filterTable() {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const table = document.querySelector("table tbody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const namaCell = rows[i].getElementsByTagName("td")[1];
            const nomorCell = rows[i].getElementsByTagName("td")[2];
            const levelCell = rows[i].getElementsByTagName("td")[3];
            const namaText = namaCell ? namaCell.textContent.toLowerCase() : "";
            const nomorText = nomorCell ? nomorCell.textContent.toLowerCase() : "";
            const levelText = levelCell ? levelCell.textContent.toLowerCase() : "";

            if (namaText.includes(searchInput) || nomorText.includes(searchInput) || levelText.includes(searchInput)) {
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
