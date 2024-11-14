<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                </nav>
            </div>
        </div>
    </div>

    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" align="center">RESTORE BARANG</h4>
                </div>
                <div class="card-content">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>  
                                    <th>Tanggal</th>  
                                    <th>Nama Barang</th>    
                                    <th>Harga Awal</th>
                                    <th>Deskripsi</th>
                                    
                                    
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($elly as $gou) {
                                    if ($gou->isdelete == 1) { 
                                      
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $gou->tgl ?></td> 
                                        <td><?= $gou->nama_barang ?></td> 
                                        <td>Rp <?= number_format($gou->harga_awal, 0, ',', '.') ?></td>
                                       
                                     <td><?= $gou->deskripsi_barang ?></td> 
                                        <td>
                                      
                                        <a href="<?= base_url('home/aksi_restore_barang/'.$gou->id_barang)?>">
    <button class="btn btn-danger btn-sm ">Restore</button>
    </a>
                                        </td>
                                    </tr>
                                <?php
                                    
                                }}
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end of .card -->
        </div> <!-- end of .col-12 -->
    </div> <!-- end of .row -->
</div> <!-- end of .main-content container-fluid -->



<script>

</script>
