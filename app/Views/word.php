<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Lelang</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-title {
            font-weight: bold;
            font-size: 1.5rem;
        }
        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            margin-top: 15px;
        }
        table th, table td {
            padding: 12px;
            text-align: center;
        }
        table th {
            background-color: #007bff;
            color: #fff;
            border-top: 1px solid #ddd;
        }
        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tbody tr:hover {
            background-color: #e8f6ff;
        }
        table td {
            border: 1px solid #ddd;
        }
        @media print {
            .card-header, .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">LAPORAN LELANG</h4>
                    <button onclick="window.print()" class="btn btn-light btn-print">Print</button>
                </div>
                <div class="card-body">
                <h1 class="text-center" style="text-align: center; margin-bottom: 20px;">LAPORAN LELANG</h1>

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
                                foreach($elly as $gou){
                                    if ($gou->isdelete == 0) {  
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?=$gou->nama_barang?></td>
                                    <td><?=$gou->tgl_lelang?></td>
                                    <td>Rp <?= number_format($gou->harga_awal, 0, ',', '.') ?></td>
                                    <td>Rp <?= number_format($gou->harga_akhir, 0, ',', '.') ?></td>
                                    <td><?=$gou->username . ' - ' . $gou->telp?></td>
                                    <td><?=$gou->status?></td>
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

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
