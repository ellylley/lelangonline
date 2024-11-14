<?php

namespace App\Models;
use CodeIgniter\Model;

Class M_lelang extends Model
{
  public function tampil($tabel,$id){
    return $this->db->table($tabel)
                    ->orderby ($id,'desc') 
                    ->get()
                    ->getResult();
  } 
  public function join($tabel, $tabel2, $on, $id){
    return $this->db->table($tabel)
                    ->join($tabel2,$on,'left')
                    ->orderby ($id,'desc') 
                    ->get()
                    ->getResult();
                    
  }


public function searchActivityLogs($id_user = null, $nama_user = null, $activity = null, $timestamp = null)
{
    $builder = $this->db->table('activity_log')
                        ->join('tb_user', 'tb_user.id_user = activity_log.id_user');

    if ($id_user) {
        $builder->like('activity_log.id_user', $id_user);
    }
    if ($nama_user) {
        $builder->like('user.username', $username);
    }
    if ($activity) {
        $builder->like('activity_log.activity', $activity);
    }
    if ($timestamp) {
        $builder->like('activity_log.timestamp', $timestamp);
    }

    $builder->orderBy('activity_log.timestamp', 'DESC');

    return $builder->get()->getResult();
}

  
 
// Di dalam M_projek2.php
public function getBackupUser($id_user)
{
    return $this->db->table('backup_user')->where('id_user', $id_user)->get()->getRow();
}
public function getBackupjenis($id_jenis)
{
    return $this->db->table('backup_jenis')->where('id_jenis', $id_jenis)->get()->getRow();
}
public function getBackupsuratk($id_keluar)
{
    return $this->db->table('backup_suratk')->where('id_keluar', $id_keluar)->get()->getRow();
}
public function getBackupsuratm($id_masuk)
{
    return $this->db->table('backup_suratm')->where('id_masuk', $id_masuk)->get()->getRow();
}

public function getBackupsurat($id_surat)
{
    return $this->db->table('backup_surat')->where('id_surat', $id_surat)->get()->getRow();
}

public function getBackupterlambat($id_keterlambatan)
{
    return $this->db->table('backup_keterlambatan')->where('id_keterlambatan', $id_keterlambatan)->get()->getRow();
}

public function getBackuptercuti($id_cuti)
{
    return $this->db->table('backup_cuti')->where('id_cuti', $id_cuti)->get()->getRow();
}






  public function joinkondisi($tabel, $tabel2, $on, $id, $where = [])
{
    $builder = $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->orderby($id, 'desc');

    // Jika ada kondisi where, tambahkan ke query
    if (!empty($where)) {
        $builder->where($where);
    }

    return $builder->get()->getResult();
}
public function joinkondisi3($tabel, $tabel2, $tabel3, $on,$on2, $id, $where = [])
{
    $builder = $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->join($tabel3, $on2, 'left')
                        ->orderby($id, 'desc');

    // Jika ada kondisi where, tambahkan ke query
    if (!empty($where)) {
        $builder->where($where);
    }

    return $builder->get()->getResult();
}

  public function joinWhereresult($tabel, $tabel2, $on, $where){
    return $this->db->table($tabel)
            ->join($tabel2, $on, 'left')
            ->where($where)
            ->get()
            ->getResult(); // Mengembalikan array objek
}
 


  public function getUserById2($id_user) {
    $this->db->where('id_user', $id_user);
    $query = $this->db->get('user'); // Sesuaikan dengan nama tabel
    return $query->row();
}
   public function joinempat($tabel, $tabel2, $tabel3, $tabel4, $on, $on2, $on3, $id){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->join($tabel3, $on2,'left')
                    ->join($tabel4, $on3,'left')
                    ->orderby($id,'desc')
                    ->get()
                    ->getResult();
}

public function jointiga($tabel, $tabel2, $tabel3, $on, $on2, $id){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->join($tabel3, $on2,'left')
                    ->orderby($id,'desc')
                    ->get()
                    ->getResult();
}  
    public function joinWhere($tabel, $tabel2, $on, $where){
    return $this->db->table($tabel)
            ->join($tabel2,$on,'left')
            ->getWhere($where)
            ->getRow();
  }
  public function joinWherebaru($tabel, $tabel2, $on, $where) {
    return $this->db->table($tabel)
            ->join($tabel2, $on, 'left')
            ->where($where)
            ->get()
            ->getResult(); // Mengambil banyak hasil
}
  public function getWhere($tabel,$where){
    return $this->db->table($tabel)
             ->getWhere($where)
             ->getRow();
             
}


public function getWhereres($tabel, $where)
{
    $query = $this->db->table($tabel)->getWhere($where);
    // Cek jika hasil query tidak false atau tidak null
    if ($query && $query->getNumRows() > 0) {
        return $query->getResult();  // Mengembalikan hasil jika ada
    }
    return [];  // Kembalikan array kosong jika query gagal atau tidak ada hasil
}

public function tambahBatch($table, $data)
{
    return $this->db->table($table)->insertBatch($data);
}
public function cari($tabel,$tabel2, $on, $awal, $akhir, $field){
    return $this->db->table($tabel)
            ->join($tabel2,$on,'left')
            ->getWhere("tgl_pesanan between '$awal' and '$akhir'")
            ->getResult();
}

public function carik($tabel,$tabel2, $on, $awal, $akhir, $field){
    return $this->db->table($tabel)
            ->join($tabel2,$on,'left')
            ->getWhere("tanggal_k between '$awal' and '$akhir'")
            ->getResult();
}

public function caritiga($tabel,$tabel2,$tabel3, $on, $on2, $awal, $akhir, $field){
    return $this->db->table($tabel)
            ->join($tabel2,$on,'left')
            ->join($tabel3, $on2,'left')
            ->getWhere("tgl_pesanan between '$awal' and '$akhir'")
            // ->getWhere($field. "between '$awal' and '$akhir'")
  // return $this->db->query ("select*from brg_msk join barang on brg_msk.id_brg=barang.id_brg")
                    ->getResult();
}

  public function upload($photo){
    
        $imageName = $photo->getName();
        $photo->move(ROOTPATH .'public/images', $imageName);
    }  

public function joinn($tabel, $tabel2, $tabel3,$tabel4, $on, $on2,$on3, $id, $where){
 return $this->db->table($tabel)
 ->join($tabel2, $on,'left')
 ->join($tabel3, $on2,'left')
 ->join($tabel4, $on3,'left')
 ->orderby($id,'desc')
 ->getWhere($where)
 ->getResult();
 
}
public function jointigawhere($tabel, $tabel2, $tabel3, $on, $on2, $id, $where){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->join($tabel3, $on2,'left')
                    ->orderby($id,'desc')
                    ->getWhere($where)
                    ->getResult();
}
public function joinempatwhere($tabel, $tabel2, $tabel3, $tabel4, $on, $on2, $on3, $id, $where){
  return $this->db->table($tabel)
                 ->join($tabel2, $on,'left')
                 ->join($tabel3, $on2,'left')
                 ->join($tabel4, $on3,'left')
                 ->orderby($id,'desc')
                 ->getWhere($where)
                 ->getResult();
}
public function joinduawhere($tabel, $tabel2, $on, $id, $where){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->orderby($id,'desc')
                    ->getWhere($where)
                    ->getResult();
}


public function getWherecon($table, $conditions)
{
    return $this->db->table($table)->where($conditions)->get()->getResult();
}

public function getPassword($userId)
{
  return $this->db->table('tb_user')
                        ->select('password')
                        ->where('id_user', $userId)
                        ->get()
                        ->getRow()
                        ->password;

}



  
  public function tambah($tabel, $isi){
    return $this->db->table($tabel)
                    ->insert($isi);
  }
  public function edit($tabel, $isi, $where){
    return $this->db->table($tabel)
                    ->update($isi,$where);
  }

  public function update_status_lelang($id_lelang, $status) {
    $data = ['status' => $status];
    return $this->db->table('tb_lelang')->update($data, ['id_lelang' => $id_lelang]);
}

  
  public function hapus($tabel, $where){
    return $this->db->table($tabel)
                    ->delete($where);
                    
  }
  public function getLastOrderNumber($tanggal)
{
    // Query untuk mendapatkan nomor urut terakhir pada hari tertentu
    $query = $this->db->table('pesanan')
                      ->select('kode_pesanan')
                      ->like('kode_pesanan', $tanggal, 'after')
                      ->orderBy('kode_pesanan', 'DESC')
                      ->get()
                      ->getRow();

    if ($query) {
        // Ambil 3 digit terakhir dari kode_pesanan
        return (int)substr($query->kode_pesanan, -3);
    } else {
        // Jika tidak ada pesanan pada hari tersebut, kembalikan 0
        return 0;
    }
}




public function getActivityLogs()
{
    return $this->db->table('activity_log')
                    ->join('tb_user', 'activity_log.id_user = tb_user.id_user', 'left')
                    ->select('activity_log.*, tb_user.username')
                    ->orderBy('activity_log.timestamp', 'DESC')
                    ->get()
                    ->getResult();
}


public function carilaporan($tabel, $tabel2, $on, $awal, $akhir, $field)
{
    return $this->db->table($tabel)
        ->join($tabel2, $on, 'left')
        ->where("{$field} >=", $awal)
        ->where("{$field} <=", $akhir)
        ->where('pesanan.isdelete', 0) // Pastikan filter ini hanya berlaku jika diperlukan
        ->get()
        ->getResult();
}
public function getjenisById($id)
{
    return $this->db->table('jenis')->where('id_jenis', $id)->get()->getRow();
}
public function getsuratkById($id)
{
    return $this->db->table('surat_keluar')->where('id_keluar', $id)->get()->getRow();
}

public function getsuratmById($id)
{
    return $this->db->table('surat_masuk')->where('id_masuk', $id)->get()->getRow();
}

public function getsuratById($id)
{
    return $this->db->table('surat_surat')->where('id_surat', $id)->get()->getRow();
}


public function getUserById($id)
{
    return $this->db->table('user')->where('id_user', $id)->get()->getRow();
}


public function gettelatById($id)
{
    return $this->db->table('keterlambatan')->where('id_keterlambatan', $id)->get()->getRow();
}

public function getcutiById($id)
{
    return $this->db->table('cuti')->where('id_cuti', $id)->get()->getRow();
}

public function tampilkondisi($table, $order_by, $where = [])
{
    return $this->db->table($table)
                    ->where($where) // Menambahkan kondisi isdelete
                    ->orderBy($order_by)
                    ->get()
                    ->getResult();
}

public function saveAccessLevel($data)
    {
        return $this->db->table('akses')->insert($data); // Sebutkan 'akses' di sini
    }

    // Fungsi untuk menghapus data akses berdasarkan id_jenis
    public function deleteAccessByJenis($id_jenis)
    {
        return $this->db->table('akses') // Sebutkan 'akses' di sini
            ->where('id_jenis', $id_jenis)
            ->delete();
    }

    // Fungsi untuk mengecek akses
    public function checkAccess($level, $id_jenis)
{
    // Jika level adalah 1 (admin), langsung beri akses tanpa cek tabel
    if ($level == 1) {
        return true;
    }

    // Cek akses dari tabel jika level selain 1
    return $this->db->table('akses')
        ->where('level', $level)
        ->where('id_jenis', $id_jenis)
        ->where('can_access', 1)
        ->countAllResults() > 0;
}

public function getAccessByJenis($id_jenis)
{
    // Ambil data akses untuk id_jenis tertentu
    return $this->db->table('akses')
                    ->select('level')  // Mengambil kolom level
                    ->where('id_jenis', $id_jenis)  // Filter berdasarkan id_jenis
                    ->where('can_access', 1)  // Hanya ambil yang memiliki akses (can_access = 1)
                    ->get()
                    ->getResult();  // Mengambil hasil query sebagai array objek
}



}