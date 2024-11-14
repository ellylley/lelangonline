<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-12 text-center">
                <h3>LELANG</h3>
                
            </div>
            <div class="col-12 col-md-6">
                <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
                   
                </nav>
            </div>
        </div>
    </div>

    <style>
    .card img {
        width: 200px; /* Menentukan ukuran gambar lebih besar */
        height: auto; /* Menjaga rasio gambar */
    }
</style>

    <!-- Basic card section start -->
    <section id="content-types">
        <div class="row">
            <?php
            $no = 1;
            foreach ($elly as $gou): ?>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Card title mengambil nama_barang -->
                            <h4 class="card-title"><?= esc($gou->nama_barang); ?></h4>
                            <!-- Card text mengambil deskripsi -->
                            <p class="card-text"><?= esc($gou->deskripsi_barang); ?></p>
                            </div>
                            
                            <div class="d-flex justify-content-center">
    <img src="<?php echo base_url('images/'.$gou->foto)?>" class="mx-auto">
</div>

                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <!-- Menampilkan harga_akhir -->
                        <span>Rp <?= number_format(esc($gou->harga_awal), 0, ',', '.'); ?></span>

                        <!-- Tombol Read More dengan data yang dibutuhkan -->
                        <button class="btn btn-light-primary" 
    data-toggle="modal" 
    data-target="#itemModal" 
    data-nama="<?= esc($gou->nama_barang); ?>" 
    data-deskripsi="<?= esc($gou->deskripsi_barang); ?>" 
    data-harga_awal="<?= esc($gou->harga_awal); ?>" 
    data-harga_akhir="<?= esc($gou->harga_akhir); ?>" 
    data-oleh="<?= esc($gou->username); ?>" 
    data-nohp="<?= esc($gou->telp); ?>" 
    data-id_lelang="<?= esc($gou->id_lelang); ?>"
    data-id_barang="<?= esc($gou->id_barang); ?>">Detail</button>


                    </div>
                </div>
            </div>
            <?php
            $no++;
            endforeach;
            ?>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itemModalLabel">Detail Lelang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Menampilkan Data Barang -->
                <p><strong>Nama Barang:</strong> <span id="modal-nama"></span></p>
                <p><strong>Deskripsi:</strong> <span id="modal-deskripsi"></span></p>
                <p><strong>Harga Awal:</strong> <span id="modal-harga-awal"></span></p>
                <p><strong>Harga Akhir:</strong> <span id="modal-harga-akhir"></span></p>
               
                
                <!-- Tombol Tawar dan Form Input Harga -->
                <div id="tawar-section" style="display:none;">
                    <hr>
                    <h5>Tawar Harga</h5>
                    <form id="tawar-form">
                        <div class="form-group">
                            <label for="input-tawar">Masukkan Harga Tawaran:</label>
                            <input type="number" class="form-control" id="input-tawar" min="0" required>
                            <div id="error-message" class="text-danger" style="display:none;">Harga tawaran harus lebih tinggi dari harga awal dan harga akhir.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Tawaran</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" id="btn-tawar">Tawar</button>
            </div>
        </div>
    </div>
</div>


<!-- Pastikan untuk menambahkan jQuery dan Bootstrap JS di bagian bawah halaman sebelum penutupan body -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Menangani klik tombol Read More
$('#itemModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Tombol yang diklik
    var nama = button.data('nama');
    var deskripsi = button.data('deskripsi');
    var harga_awal = parseFloat(button.data('harga_awal')); // Mengonversi harga_awal ke tipe angka
    var harga_akhir = parseFloat(button.data('harga_akhir')); // Mengonversi harga_akhir ke tipe angka
    // var oleh = button.data('oleh');
    // var nohp = button.data('nohp');
    var id_lelang = button.data('id_lelang'); // Menyimpan ID Lelang untuk dikirim ke server

    // Mengisi data modal
    var modal = $(this);
    modal.find('#modal-nama').text(nama);
    modal.find('#modal-deskripsi').text(deskripsi);
    modal.find('#modal-harga-awal').text(harga_awal);
    modal.find('#modal-harga-akhir').text(harga_akhir);
    // modal.find('#modal-oleh').text(oleh);
    // modal.find('#modal-nohp').text(nohp);

    // Menyimpan harga awal dan harga akhir untuk validasi tawaran
    modal.find('#tawar-section').hide();
    modal.find('#input-tawar').val('');
    modal.find('#error-message').hide();

    modal.find('#btn-tawar').off('click').on('click', function() {
        modal.find('#tawar-section').show(); // Menampilkan form tawaran
    });

    // Validasi harga tawaran
// Validasi harga tawaran
$('#tawar-form').submit(function(e) {
    e.preventDefault();
    var tawarHarga = parseFloat($('#input-tawar').val()); // Mengambil harga tawaran dari input

    // Memeriksa apakah tawaran harga lebih kecil atau sama dengan harga awal atau harga akhir
    if (tawarHarga <= harga_awal || tawarHarga <= harga_akhir) {
        $('#error-message').show(); // Menampilkan pesan error jika tawaran tidak valid

        // Menghilangkan pesan error setelah 3 detik (3000 ms)
        setTimeout(function() {
            $('#error-message').fadeOut(); // Pesan error akan menghilang dengan efek fadeOut
        }, 3000);
    } else {
        $('#error-message').hide(); // Menyembunyikan pesan error jika tawaran valid

        // Kirim tawaran ke server menggunakan AJAX
        $.ajax({
            url: '<?= base_url('home/simpan_tawaran'); ?>',
            method: 'POST',
            data: {
                id_lelang: id_lelang, // ID lelang yang ditawarkan
                harga_akhir: tawarHarga // Harga tawaran yang diajukan
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message); // Pesan sukses
                    // Menutup modal setelah tawaran berhasil dikirim
$('#itemModal').hide();// Menutup modal
$('.modal-backdrop').remove(); // Menghapus elemen backdrop modal yang tersisa
location.reload();
                    $.ajax({
    url: '<?= base_url('home/simpan_history_lelang'); ?>',
    method: 'POST',
    data: {
        id_lelang: id_lelang, // ID lelang yang ditawarkan
        id_barang: button.data('id_barang'), // ID barang yang ditawar
        id_user: '<?= session()->get('id'); ?>', // ID user yang sedang login
        penawaran_harga: tawarHarga // Harga tawaran yang diajukan
    },
    success: function(historyResponse) {
        if (historyResponse.status === 'success') {
            console.log('Tawaran berhasil disimpan di history lelang');
        } else {
            alert('Error saat menyimpan ke history lelang');
        }
    }
});


                } else {
                    alert('Error: ' + response.message); // Pesan error
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat mengirim tawaran');
            }
        });
    }
});

});



</script>
