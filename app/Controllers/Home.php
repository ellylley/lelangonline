<?php

namespace App\Controllers;

use Codeigniter\Controllers;
use App\models\M_lelang;
use CodeIgniter\Session\Session;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\LevelPermissionModel;



class Home extends BaseController
{
    public function index()
    {
        if (session()->get('level')>0){
            $model= new M_lelang();
            $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman dashboard'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       
            $where=array(
                'id_setting'=> 1
              );
              $data['setting'] = $model->getWhere('setting',$where);
              $data['currentMenu'] = 'dashboard';
        echo view('header', $data);
        echo view('menu', $data);
        echo view('dashboard', $data);
        echo view('footer');
    }else{
        return redirect()->to('home/login');
 
    } 
    }

    public function login()
    {
        $model= new M_lelang();
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
        echo view('header', $data);
        echo view('login', $data);

} 
public function aksilogin()
{
    $name = $this->request->getPost('nama');
    $pw = $this->request->getPost('password');
    $captchaResponse = $this->request->getPost('g-recaptcha-response');
    $backupCaptcha = $this->request->getPost('backup_captcha');
    
    $secretKey = '6LdLhiAqAAAAAPxNXDyusM1UOxZZkC_BLCgfyoQf'; // Ganti dengan secret key Anda yang sebenarnya
    $recaptchaSuccess = false;

    $captchaModel = new M_lelang();

    // Cek koneksi internet
    if ($this->isInternetAvailable()) {
        // Verifikasi reCAPTCHA
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captchaResponse");
        $responseKeys = json_decode($response, true);
        $recaptchaSuccess = $responseKeys["success"];
    }
    
    if ($recaptchaSuccess) {
        // reCAPTCHA berhasil
        $where = [
            'username' => $name,
            'password' => md5($pw),
        ];

        $model = new M_lelang();
        $check = $model->getWhere('tb_user', $where);

        if ($check) {
            session()->set('id', $check->id_user);
            session()->set('nama', $check->username);
            session()->set('level', $check->id_level);
            return redirect()->to('home');
        } else {
            return redirect()->to('home/login')->with('error', 'Invalid username or password.');
        }
    } else {
        // Validasi CAPTCHA offline
        $storedCaptcha = session()->get('captcha_code'); // Retrieve stored CAPTCHA from session
        
        if ($storedCaptcha !== null) {
            if ($storedCaptcha === $backupCaptcha) {
                // CAPTCHA valid
                $where = [
                    'username' => $name,
                    'password' => md5($pw),
                ];

                $model = new M_lelang();
                $check = $model->getWhere('tb_user', $where);

                if ($check) {
                    session()->set('id', $check->id_user);
                    session()->set('nama', $check->username);
                    session()->set('level', $check->id_level);

                    return redirect()->to('home');
                } else {
                    return redirect()->to('home/login')->with('error', 'Invalid username or password.');
                }
            } else {
                // CAPTCHA tidak valid
                return redirect()->to('home/login')->with('error', 'Invalid CAPTCHA.');
            }
        } else {
            return redirect()->to('home/login')->with('error', 'CAPTCHA session is not set.');
        }
    }
}




    public function generateCaptcha()
{
    $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

    // Store the CAPTCHA code in the session
    session()->set('captcha_code', $code);

    // Generate the image
    $image = imagecreatetruecolor(120, 40);
    $bgColor = imagecolorallocate($image, 255, 255, 255);
    $textColor = imagecolorallocate($image, 0, 0, 0);

    imagefilledrectangle($image, 0, 0, 120, 40, $bgColor);
    imagestring($image, 5, 10, 10, $code, $textColor);

    // Set the content type header - in this case image/png
    header('Content-Type: image/png');

    // Output the image
    imagepng($image);

    // Free up memory
    imagedestroy($image);
}

private function isInternetAvailable()
{
    $connected = @fsockopen("www.google.com", 80);
    if ($connected) {
        fclose($connected);
        return true;
    }
    return false;
}

public function logout()
        {
           session()->destroy();
            return redirect()->to('Home/login');
    
        }


        public function user()
{
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_lelang();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

     
        $data['elly'] = $model->joinkondisi('tb_user', 'tb_level', 'tb_user.id_level = tb_level.id_level', 'tb_user.id_user');
        $data['level'] = $model->tampil('tb_level', 'id_level');

        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('user', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}


public function aksi_tambah_user()
    {
        $model = new M_lelang();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menambah user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       
      
        $a = $this->request->getPost('nama');
        $b = $this->request->getPost('usn');
        $c = md5($this->request->getPost('password'));
        $d = $this->request->getPost('nohp');
        $e = $this->request->getPost('level');
       
        
    
        
        $isi = array(
            'nama_lengkap' => $a,
            'username' => $b,
            'password' => $c,
           'telp' => $d,
            'id_level' => $e,
            'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
            'created_by' => $id_user // ID user yang login
           
            

        );
        $model ->tambah('tb_user', $isi);
        
        return redirect()->to('home/user');
    }

    public function aksi_edit_user()
{
    $model = new M_lelang();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah data user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        // Mengambil data log aktivitas dari model
       
        $a = $this->request->getPost('nama');
        $b = $this->request->getPost('usn');
        
        $d = $this->request->getPost('nohp');
        $e = $this->request->getPost('level');
        $id = $this->request->getPost('id');
    

   

    $isi = array(
       'nama_lengkap' => $a,
            'username' => $b,
            'password' => $c,
           'telp' => $d,
            'id_level' => $e,
            'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
            'updated_by' => $id_user // ID user yang login
    );

    $where = array('id_user' => $id);
    $model->edit('tb_user', $isi, $where);

    return redirect()->to('home/user');
}

public function hapususer($id){
    $model = new M_lelang();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus data user'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
    ];
      
    $model->edit('tb_user', $data, ['id_user' => $id]);

    return redirect()->to('home/user');
}

public function aksi_reset($id)
{
    $model = new M_lelang();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mereset password user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       
      
    $where = array('id_user' => $id);
    
    $isi = array(
        'password' => md5('12345'),
        'updated_at' => date('Y-m-d H:i:s'),
        'updated_by' => $id_user
    );
    $model->edit('tb_user', $isi, $where);

    return redirect()->to('home/user');
}

public function barang()
{
    if (session()->get('level') == 0 || session()->get('level') == 1 || session()->get('level') == 2) {

        $model = new M_lelang();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman barang'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        $data['elly'] = $model->tampil('tb_barang', 'id_barang');
        // $data['satu'] = $model->getWhere('tb_barang', ['id_barang' => $id_barang]);
        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'barang'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('barang', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}

public function aksi_tambah_barang()
    {
        $model = new M_lelang();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menambah data barang'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       
      
        $a = $this->request->getPost('nama');
        $d = $this->request->getPost('harga');
        $e = $this->request->getPost('desk');
        $uploadedFile = $this->request->getFile('foto');

        // Cek apakah file foto di-upload atau tidak
        if ($uploadedFile && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
            $foto = $uploadedFile->getName();
            $model->upload($uploadedFile);
        } else {
            // Set foto default jika tidak ada file yang di-upload
            $foto = 'default.png';
        }
        
        
    
        
        $isi = array(
            'nama_barang' => $a,
            'tgl' =>  date('Y-m-d'), // Waktu saat produk dibuat
           'harga_awal' => $d,
            'deskripsi_barang' => $e,
            'foto' => $foto,
            'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
            'created_by' => $id_user // ID user yang login
           
            

        );
        $model ->tambah('tb_barang', $isi);
        
        return redirect()->to('home/barang');
    }

    public function aksi_edit_barang()
{
    $model = new M_lelang();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah data barang'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $a = $this->request->getPost('nama');
        $d = $this->request->getPost('harga');
        $e = $this->request->getPost('desk');
    $id = $this->request->getPost('id');
    $fotoName = $this->request->getPost('old_foto'); // Mengambil nama foto lama
    $foto = $this->request->getFile('foto');


    if ($foto && $foto->isValid()) {
        // Generate a new name for the uploaded file
        $newName = $foto->getRandomName();
        // Move the file to the target directory
        $foto->move(ROOTPATH . 'public/images', $newName);
        // Set the new file name to be saved in the database
        $fotoName = $newName;
    }

    

    $isi = array(
        'nama_barang' => $a,
        'tgl' =>  date('Y-m-d'), // Waktu saat produk dibuat
        'harga_awal' => $d,
        'deskripsi_barang' => $e,
        'foto' => $foto,
        'foto' => $fotoName,
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    $where = array('id_barang' => $id);
    $model->edit('tb_barang', $isi, $where);

    return redirect()->to('home/barang');
}

public function hapusbarang($id){
    $model = new M_lelang();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus data barang'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
    ];
      
    $model->edit('tb_barang', $data, ['id_barang' => $id]);

    return redirect()->to('home/barang');
}


public function barang_lelang()
{
    if (session()->get('level') == 0 || session()->get('level') == 1 || session()->get('level') == 2) {

        $model = new M_lelang();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman barang lelang'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        // Set the condition to filter out records where isdelete = 0
        $where = ['tb_lelang.isdelete' => 0, 'tb_barang.isdelete' => 0];

        // Join the tables with the additional 'where' condition
        $data['elly'] = $model->joinkondisi('tb_lelang', 'tb_barang', 'tb_lelang.id_barang = tb_barang.id_barang', 'tb_lelang.id_lelang', $where);
        
        $data['nama'] = $model->tampil('tb_barang', 'id_barang');
        $whereSetting = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $whereSetting);
        $data['currentMenu'] = 'barang_lelang'; // Sesuaikan dengan menu yang aktif
        
        echo view('header', $data);
        echo view('menu', $data);
        echo view('barang_lelang', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}



public function aksi_tambah_lelang()
    {
        $model = new M_lelang();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menambah data barang lelang'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        $a = $this->request->getPost('nama');

        
        $isi = array(
            'id_barang' => $a,
            'id_petugas' => $id_user,
            'tgl_lelang' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
            'created_by' => $id_user // ID user yang login


        );
        $model ->tambah('tb_lelang', $isi);
        
        return redirect()->to('home/barang_lelang');
    }

    public function aksi_edit_lelang()
    {
        $model = new M_lelang();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menambah data barang lelang'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        $a = $this->request->getPost('nama');
        $id = $this->request->getPost('id');

        
        $isi = array(
            'id_barang' => $a,
            'id_petugas' => $id_user,
            'tgl_lelang' => date('Y-m-d'),
            'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
            'updated_by' => $id_user // ID user yang login


        );
        $where = array('id_lelang' => $id);
        $model->edit('tb_lelang', $isi, $where);
    
        return redirect()->to('home/barang_lelang');
}

public function hapuslelang($id){
    $model = new M_lelang();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus data barang lelang'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
    ];
      
    $model->edit('tb_lelang', $data, ['id_lelang' => $id]);

    return redirect()->to('home/barang_lelang');
}

public function update_status_lelang() {
    // Inisialisasi model langsung di sini
    $model = new M_lelang();
    
    $id_lelang = $this->request->getPost('id_lelang'); // Pastikan nama field sesuai
    $status = $this->request->getPost('status');

    // Panggil model untuk mengupdate status
    $model->update_status_lelang($id_lelang, $status);

    // Redirect atau tampilkan pesan sukses
    return redirect()->to('home/barang_lelang'); // Sesuaikan dengan URL yang diinginkan
}

public function lelang()
{
    if (session()->get('level') == 0 || session()->get('level') == 3) {

        $model = new M_lelang();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman lelang'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        $where = ['tb_lelang.isdelete' => 0,'tb_barang.isdelete' => 0, 'tb_lelang.status' => 'Dibuka'];

        $data['elly'] = $model->joinkondisi3('tb_lelang', 'tb_barang', 'tb_user', 'tb_lelang.id_barang = tb_barang.id_barang', 'tb_lelang.id_user = tb_user.id_user','tb_lelang.id_lelang', $where);
        
        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'lelang'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('lelang', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}
// Controller: LelangController.php
public function simpan_tawaran()
{
    $model = new M_lelang();
    $id_user = session()->get('id');
    $id_lelang = $this->request->getPost('id_lelang'); // Cek apakah id_lelang ada
    $harga_akhir = $this->request->getPost('harga_akhir'); // Cek apakah harga_akhir ada

    if (empty($id_lelang) || empty($harga_akhir)) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak lengkap']);
    }

    $data = [
        'harga_akhir' => $harga_akhir,
        'id_user' => $id_user,
        'updated_at' => date('Y-m-d H:i:s'),
        'updated_by' => $id_user
    ];

    $where = ['id_lelang' => $id_lelang];
    $updateResult = $model->edit('tb_lelang', $data, $where);

    if ($updateResult) {
        return $this->response->setJSON(['status' => 'success', 'message' => 'Tawaran berhasil disimpan']);
    } else {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan tawaran']);
    }
}

public function simpan_history_lelang()
{
    $model = new M_lelang(); // Pastikan Anda menggunakan model yang sesuai
    $id_user = session()->get('id'); // Ambil ID user dari session
    $id_lelang = $this->request->getPost('id_lelang'); // Ambil ID lelang yang ditawarkan
    $id_barang = $this->request->getPost('id_barang'); // Ambil ID barang
    $penawaran_harga = $this->request->getPost('penawaran_harga'); // Ambil harga tawaran

    // Data untuk disimpan ke history_lelang
    $data = [
        'id_lelang' => $id_lelang,
        'id_barang' => $id_barang,
        'id_user' => $id_user,
        'penawaran_harga' => $penawaran_harga,
        'created_by' => $id_user, // Waktu tawaran dibuat
        'created_at' => date('Y-m-d H:i:s'), // Waktu tawaran dibuat
    ];

    // Simpan data tawaran ke tabel history_lelang
    $model->tambah('history_lelang', $data); // Pastikan Anda memiliki metode tambah di model M_lelang

    return $this->response->setJSON(['status' => 'success', 'message' => 'Tawaran berhasil disimpan']);
}


public function history_lelang()
{
    $model = new M_lelang();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $level = session()->get('level'); // Ambil level pengguna dari session
    $activity = 'Mengakses halaman history lelang'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    if ($level == 0 || $level == 1|| $level == 2) {
        // Menampilkan semua data jika level 0 (admin) atau level 1 (super admin)
        $data['elly'] = $model->joinempat(
            'history_lelang', 'tb_barang', 'tb_user', 'tb_lelang', 
            'history_lelang.id_barang = tb_barang.id_barang', 
            'history_lelang.id_user = tb_user.id_user', 
            'history_lelang.id_lelang = tb_lelang.id_lelang', 
            'history_lelang.id_history'
        );
    } elseif ($level == 3) {
        // Menampilkan data yang sesuai dengan created_by jika level 3 (kepala sekolah)
        $data['elly'] = $model->joinn(
            'history_lelang', 'tb_barang', 'tb_user', 'tb_lelang', 
            'history_lelang.id_barang = tb_barang.id_barang', 
            'history_lelang.id_user = tb_user.id_user', 
            'history_lelang.id_lelang = tb_lelang.id_lelang', 
            'history_lelang.id_history', 
            ['history_lelang.created_by' => $id_user]
        );
    } else {
        return redirect()->to('home/error');
    }

    $where = ['id_setting' => 1];
    $data['setting'] = $model->getWhere('setting', $where);
    $data['currentMenu'] = 'history'; // Sesuaikan dengan menu yang aktif
    
    echo view('header', $data);
    echo view('menu', $data);
    echo view('history_lelang', $data);
    echo view('footer');
}


public function laporan()
{
    if (session()->get('level') == 0 || session()->get('level') == 1|| session()->get('level') == 2) {

        $model = new M_lelang();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman laporan'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        // Set the condition to filter out records where isdelete = 0
        $where = ['tb_lelang.isdelete' => 0];

        // Join the tables with the additional 'where' condition
        $data['elly'] = $model->jointigawhere('tb_lelang', 'tb_barang','tb_user', 'tb_lelang.id_barang = tb_barang.id_barang', 'tb_lelang.id_user = tb_user.id_user', 'tb_lelang.id_lelang', $where);
        
       
        $whereSetting = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $whereSetting);
        $data['currentMenu'] = 'laporan'; // Sesuaikan dengan menu yang aktif
        
        echo view('header', $data);
        echo view('menu', $data);
        echo view('laporan', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}

public function word()
{
    $model = new M_lelang();
    $id_user = session()->get('id'); // Ambil ID user dari session
    
    // Ambil data filter dari POST
    $filterTanggal = $this->request->getPost('filterTanggal');
    $filterStatus = $this->request->getPost('filterStatus');
    
    // Kondisi dasar
    $where = ['tb_lelang.isdelete' => 0];
    
    // Tambahkan filter jika ada
    if ($filterTanggal) {
        $where['tb_lelang.tgl_lelang'] = $filterTanggal;
    }
    if ($filterStatus) {
        $where['tb_lelang.status'] = $filterStatus;
    }

    // Join the tables with the additional 'where' condition
    $data['elly'] = $model->jointigawhere('tb_lelang', 'tb_barang','tb_user', 'tb_lelang.id_barang = tb_barang.id_barang', 'tb_lelang.id_user = tb_user.id_user', 'tb_lelang.id_lelang', $where);
    
    echo view('word', $data);
}

public function setting()
{
    // Memeriksa level akses user
    if (session()->get('level') == 0||session()->get('level') == 1 ) {
      
        $model = new M_lelang();
        
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman setting'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       

    
        $id = 1; // id_toko yang diinginkan

        // Menyusun kondisi untuk query
        $where = array('id_setting' => $id);

        // Mengambil data dari tabel 'toko' berdasarkan kondisi
        $data['user'] = $model->getWhere('setting', $where);
 
        // Memuat view
        $where=array(
          'id_setting'=> 1
        );
        $data['setting'] = $model->getWhere('setting',$where);
        $data['currentMenu'] = 'setting'; 
        echo view('header', $data);
        echo view('menu', $data);
        echo view('setting', $data);
        echo view('footer', $data);
    } else {
        return redirect()->to('home/error');
    } 
}

public function aksisetting()
{
    $model = new M_lelang();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah data setting'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
      
    
       
    $nama = $this->request->getPost('nama');
    
    $id = $this->request->getPost('id');
    $uploadedFile = $this->request->getFile('foto');

    $where = array('id_setting' => $id);

    $isi = array(
        'nama_web' => $nama,
       
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    // Cek apakah ada file yang diupload
    if ($uploadedFile && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
        $foto = $uploadedFile->getName();
        $model->upload($uploadedFile); // Mengupload file baru
        $isi['logo_web'] = $foto; // Menambahkan nama file baru ke array data
    }

    $model->edit('setting', $isi, $where);

    return redirect()->to('home/setting/'.$id);
}

public function log() 
{
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_lelang();

        // Menambahkan log aktivitas ketika user mengakses halaman log
        $id_user = session()->get('id');
        $activity = 'Mengakses halaman log aktivitas';
        $this->addLog($id_user, $activity);
        
        // Ambil data pencarian dari input GET
        $id_user_search = $this->request->getGet('id_user');
        $nama_user_search = $this->request->getGet('username');
        $activity_search = $this->request->getGet('activity');
        $timestamp_search = $this->request->getGet('timestamp');

        // Mengambil data log aktivitas dengan filter
        $data['logs'] = $model->searchActivityLogs($id_user_search, $nama_user_search, $activity_search, $timestamp_search);
        
        // Menambahkan data pencarian ke array data
        $data['id_user'] = $id_user_search;
        $data['username'] = $nama_user_search;
        $data['activity'] = $activity_search;
        $data['timestamp'] = $timestamp_search;

        // Ambil setting seperti biasa
        $where = array('id_setting' => 1);
        $data['setting'] = $model->getWhere('setting', $where);

        $data['currentMenu'] = 'log';
        echo view('header', $data);
        echo view('menu', $data);
        echo view('log', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}
public function addLog($id_user, $activity)
{
    $model = new M_lelang(); // Gunakan model M_kedaikopi
    $id_user = session()->get('id');
    $data = [
        'id_user' => $id_user,
        'activity' => $activity,
        'timestamp' => date('Y-m-d H:i:s'),
    ];
    $model->tambah('activity_log', $data); // Pastikan 'activity_log' adalah nama tabel yang benar
}


public function profile($id)
{
    if (session()->get('level') == 0||session()->get('level') == 1||session()->get('level') == 2||session()->get('level') == 3||session()->get('level') == 4||session()->get('level') == 5||session()->get('level') == 6||session()->get('level') == 7  ) {
        $model = new M_lelang();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman profile'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        
        $where= array('tb_user.id_user'=>$id);
        $where=array('id_user'=>session()->get('id'));
        
        $data['user']=$model->getWhere('tb_user',$where);
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);

        echo view('header',$data);
        echo view ('menu',$data);
        echo view('profile',$data);
        echo view ('footer');
        }else{
        return redirect()->to('home/error');
        }
        
}
public function aksieprofile() 
{
    $model = new M_lelang();

    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah data profile'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       

    $a = $this->request->getPost('nama');
    $b = $this->request->getPost('usn');
    $c = $this->request->getPost('nohp');
    $id = $this->request->getPost('id');

    

    $isi = array(
        'nama_lengkap' => $a,
        'username' => $b,
        'telp' => $c,
        
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    $where = array('id_user' => $id);
    $model->edit('tb_user', $isi, $where);

    return redirect()->to('home/profile/'.$id);
}

public function aksi_changepass() {
    $model = new M_lelang();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'mengubah password profile'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
       
    $oldPassword = $this->request->getPost('old');
    $newPassword = $this->request->getPost('new');
   

    // Dapatkan password lama dari database
    $currentPassword = $model->getPassword($id_user);

    // Verifikasi apakah password lama cocok
    if (md5($oldPassword) !== $currentPassword) {
        // Set pesan error jika password lama salah
        session()->setFlashdata('error', 'Password lama tidak valid.');
        return redirect()->back()->withInput();
    }
 
    // Update password baru
    $data = [
        'password' => md5($newPassword),
        'updated_by' => $id_user,
        'updated_at' => date('Y-m-d H:i:s')
    ];
    $where = ['id_user' => $id_user];
    
    $model->edit('tb_user', $data, $where);
    
    // Set pesan sukses
    session()->setFlashdata('success', 'Password berhasil diperbarui.');
    return redirect()->to('home/profile/'.$id_user);
}

public function register()
{
    $model= new M_lelang();
    $where=array(
        'id_setting'=> 1
      );
      $data['setting'] = $model->getWhere('setting',$where);
    echo view('header', $data);
    echo view('register', $data);

} 

public function aksi_register()
    {
        $model = new M_lelang();
        $id_user = session()->get('id'); // Ambil ID user dari session
       
        
       
      
        $a = $this->request->getPost('nama_lengkap');
        $b = $this->request->getPost('username');
        $c = md5($this->request->getPost('password'));
        $d = $this->request->getPost('telp');
       
       
        
    
        
        $isi = array(
            'nama_lengkap' => $a,
            'username' => $b,
            'password' => $c,
           'telp' => $d,
            'id_level' => '3',
            'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
            'created_by' => $id_user // ID user yang login
           
            

        );
        $model ->tambah('tb_user', $isi);
        
        return redirect()->to('home/login');
    }
    public function restore_user()
    {   
        if (session()->get('level') == 0 || session()->get('level') == 1) {
    	$model= new M_lelang();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        
        $data['elly'] = $model->joinduawhere('tb_user', 'tb_level', 'tb_user.id_level=tb_level.id_level', 'tb_user.id_user', ['tb_user.isdelete' => 1]);
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'restore_user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('restore_user',$data);
        echo view ('footer');
         }else{
        return redirect()->to('home/error');
 
    } 
    }

    public function aksi_restore_user($id) {
        $model = new M_lelang();
         $id_user = session()->get('id'); // Ambil ID user dari session
            $activity = 'Merestore user'; // Deskripsi aktivitas
            $this->addLog($id_user, $activity);
        
        // Data yang akan diupdate untuk mengembalikan produk
        $data = [
            'isdelete' => 0,
            'deleted_by' => null,
            'deleted_at' => null
        ];
    
        // Update data produk dengan kondisi id_produk sesuai
        $model->edit('tb_user', $data, ['id_user' => $id]);
    
        return redirect()->to('home/restore_user');
    }

    public function restore_barang()
    {   
        if (session()->get('level') == 0 || session()->get('level') == 1) {
    	$model= new M_lelang();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore barang'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        
        $data['elly'] = $model->tampil('tb_barang', 'id_barang');
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'restore_barang'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('restore_barang',$data);
        echo view ('footer');
         }else{
        return redirect()->to('home/error');
 
    } 
    }

    public function aksi_restore_barang($id) {
        $model = new M_lelang();
         $id_user = session()->get('id'); // Ambil ID user dari session
            $activity = 'Merestore barang'; // Deskripsi aktivitas
            $this->addLog($id_user, $activity);
        
        // Data yang akan diupdate untuk mengembalikan produk
        $data = [
            'isdelete' => 0,
            'deleted_by' => null,
            'deleted_at' => null
        ];
    
        // Update data produk dengan kondisi id_produk sesuai
        $model->edit('tb_barang', $data, ['id_barang' => $id]);
    
        return redirect()->to('home/restore_barang');
    }

    public function restore_lelang()
    {   
        if (session()->get('level') == 0 || session()->get('level') == 1) {
    	$model= new M_lelang();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore barang lelang'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        
        $data['elly'] = $model->joinduawhere('tb_lelang', 'tb_barang', 'tb_lelang.id_barang=tb_barang.id_barang', 'tb_lelang.id_lelang', ['tb_lelang.isdelete' => 1]);
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'restore_lelang'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('restore_lelang',$data);
        echo view ('footer');
         }else{
        return redirect()->to('home/error');
 
    } 
    }

    public function aksi_restore_lelang($id) {
        $model = new M_lelang();
         $id_user = session()->get('id'); // Ambil ID user dari session
            $activity = 'Merestore barang lelang'; // Deskripsi aktivitas
            $this->addLog($id_user, $activity);
        
        // Data yang akan diupdate untuk mengembalikan produk
        $data = [
            'isdelete' => 0,
            'deleted_by' => null,
            'deleted_at' => null
        ];
    
        // Update data produk dengan kondisi id_produk sesuai
        $model->edit('tb_lelang', $data, ['id_lelang' => $id]);
    
        return redirect()->to('home/restore_lelang');
    }
}