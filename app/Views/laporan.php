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
            background-color: #e9ecef;
            /* Optional: change the background color to indicate it's disabled */
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
                        <h4 class="card-title">LAPORAN LELANG</h4>

                        <!-- Tombol Tambah, Field Pencarian, dan Tombol Print -->
                        <div class="d-flex">
                            <div class="input-group me-2">
                                <input type="date" id="filterTanggal" class="form-control" placeholder="Filter Tanggal">
                            </div>
                            <div class="input-group me-2">
                                <select id="filterStatus" class="form-select">
                                    <option value="">Filter Status</option>
                                    <option value="Dibuka">Dibuka</option>
                                    <option value="Ditutup">Ditutup</option>
                                </select>
                            </div>

                            <!-- Tombol Filter dan Print -->
                            <button class="btn btn-primary me-2" onclick="filterTable()">Filter</button>
                            <!-- Form untuk Print dengan filter -->
                            <form action="<?= base_url('home/word') ?>" method="POST" class="d-inline">
                                <input type="hidden" name="filterTanggal" id="hiddenFilterTanggal" value="" />
                                <input type="hidden" name="filterStatus" id="hiddenFilterStatus" value="" />
                                <button type="submit" class="btn btn-success" name="action" value="word">Print</button>
                            </form>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="lelangTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Tanggal Lelang</th>
                                        <th>Harga Awal</th>
                                        <th>Harga Akhir</th>
                                        <th>Oleh</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($elly as $gou) {
                                        if ($gou->isdelete == 0) {
                                    ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $gou->nama_barang ?></td>
                                                <td><?= $gou->tgl_lelang ?></td>
                                                <td>Rp <?= number_format($gou->harga_awal, 0, ',', '.') ?></td>
                                                <td>Rp <?= number_format($gou->harga_akhir, 0, ',', '.') ?></td>
                                                <td><?=$gou->username . ' - ' . $gou->telp?></td>
                                                <td><?= $gou->status ?></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for Filter and Print -->
    <script>
        // Fungsi untuk menerapkan filter pada tampilan
        function filterTable() {
            var filterTanggal = document.getElementById('filterTanggal').value;
            var filterStatus = document.getElementById('filterStatus').value;
            var table = document.getElementById('lelangTable').getElementsByTagName('tbody')[0];
            var rows = table.getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                var tanggalLelang = cells[2].innerText;
                var status = cells[5] ? cells[5].innerText : '';

                // Logika untuk menyaring baris berdasarkan input pengguna
                if ((filterTanggal && tanggalLelang !== filterTanggal) ||
                    (filterStatus && status !== filterStatus)) {
                    rows[i].style.display = "none";
                } else {
                    rows[i].style.display = "";
                }
            }
        }

        // Fungsi untuk mengatur nilai filter pada form print
        function setFilters() {
            document.getElementById('hiddenFilterTanggal').value = document.getElementById('filterTanggal').value;
            document.getElementById('hiddenFilterStatus').value = document.getElementById('filterStatus').value;
        }

        // Memastikan nilai filter dikirimkan saat tombol print diklik
        document.querySelector("button[type='submit']").addEventListener("click", setFilters);
    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
