<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\Karyawan;
use CodeIgniter\Email\Email;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Email as ConfigEmail;
use Config\Kint;

class KaryawanController extends BaseController
{
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('sandi');

        $karyawan = (new Karyawan()) ->where('email',$email)->first();

        if($karyawan == null){
            return $this->response->setJSON(['message' => 'Email tidak terdaftar'])
                        ->setStatusCode(404);
        }
        $cekPassword = password_verify($password, $karyawan['sandi']);
        if($cekPassword == false){
            return $this->response->setJSON(['message'=>'Email dan sandi tidak cocok'])
                        ->setStatusCode(403);
        }
        $this->session->set('karyawan',$karyawan);
        return $this->response->setJSON(['message' =>"Selamat datang {$karyawan['nama_depan']} "])
                    ->setStatusCode(200);
    }
    public function viewLogin(){
        return view('login');
    }
    public function lupaPassword(){
        $_email = $this->request->getPost('email');
        $karyawan = (new Karyawan())->where('email',$_email)->first();

        if($karyawan == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                        ->setStatusCode(404);
        }
        $sandibaru = substr(md5(date('Y-m-dH:i:s')),5,5);
        $karyawan['sandi'] = password_hash($sandibaru, PASSWORD_BCRYPT);
        $r =(new Karyawan())->update($karyawan['id'], $karyawan);

        if($r == false){
            return $this->response->setJSON(['message' =>'Gagal merubah sandi'])
                        ->setStatusCode(502);
        }
        $email = new Email(new ConfigEmail());
        $email ->setFrom('marsianusyhzkl@gmail.com', 'Sistem Informasi Bengkel');
        $email ->setTo($karyawan['email']);
        $email ->setSubject('Reset Sandi Pengguna');
        $email ->setMessage("hallo {$karyawan['nama']} telah meminta reset baru. reset baru kamu adalah <b>$sandibaru</b>");
        $r = $email->send();

        if($r == true){
            return $this->response->setJSON(['message'=>"sandi baru sudah di kirim ke alamat email $_email"])
                        ->setStatusCode(200);
        }else{
            return $this->response->setJSON(['message' =>"maaf ada kesalahan pengiriman email ke $_email"])
                        ->setStatusCode(500);
        }

    }
    public function viewLupaPassword(){
        return view('lupa_password');
    }
    public function logout(){
        $this->session->destroy();
        return redirect()->to('login');
    }
    public function index(){
        return view('karyawan/table');
    }
    public function all(){
        $pm = new Karyawan();
        $pm->select(['id','nama_lengkap','email','nohp','alamat','kota','sandi','token_reset','level','foto','created_at','updated_at']);

        return(new Datatable($pm))
            ->setFieldFilter(['id','nama_lengkap','email','nohp','alamat','kota','sandi','token_reset','level','foto','created_at','updated_at']);
    }
    public function show($id){
        $r = (new Karyawan())->where('id',$id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $pm = new Karyawan();
        $sandi = $this->request->getVar('sandi');

        $id = $pm->insert([
            'id' =>$this->request->getVar('id'),
            'nama_lengkap' =>$this->request->getVar('nama_lengkap'),
            'email' =>$this->request->getVar('email'),
            'nohp' =>$this->request->getVar('nohp'),
            'alamat' =>$this->request->getVar('alamat'),
            'kota' =>$this->request->getVar('kota'),
            'sandi' =>$this->request->getVar('sandi'),
            'token_reset' =>$this->request->getVar('token_reset'),
            'level' =>$this->request->getVar('level'),
            'foto' =>$this->request->getVar('foto'),
            'created_at' =>$this->request->getVar('created_at'),
            'updated_at' =>$this->request->getVar('updated_at'),
        
        ]);
        return $this->response->setJSON(['id' => $id])
                    ->setStatusCode(intval($id) > 0 ? 200 : 406);
    }
    public function update(){
        $pm = new Karyawan();
        $id = (int)$this->request->getVar('id');

        if($pm->find($id) == null)
            throw PageNotFoundException::forPageNotFound();

        $hasil = $pm ->update($id, [
            'id' =>$this->request->getVar('id'),
            'nama_lengkap' =>$this->request->getVar('nama_lengkap'),
            'email' =>$this->request->getVar('email'),
            'nohp' =>$this->request->getVar('nohp'),
            'alamat' =>$this->request->getVar('alamat'),
            'kota' =>$this->request->getVar('kota'),
            'sandi' =>$this->request->getVar('sandi'),
            'token_reset' =>$this->request->getVar('token_reset'),
            'level' =>$this->request->getVar('level'),
            'foto' =>$this->request->getVar('foto'),
            'created_at' =>$this->request->getVar('created_at'),
            'updated_at' =>$this->request->getVar('updated_at'),

        ]);
        return $this->response->setJSON(['result' =>$hasil]);
    }
    public function delete(){
        $pm = new Karyawan();
        $id = $this->request->getVar('id');
        $hasil = $pm->delete($id);
        return $this->response->setJSON(['result' => $hasil]);
    }
}