<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\Pelanggan;
use CodeIgniter\Exceptions\PageNotFoundException;

class PelangganController extends BaseController
{
    public function index()
    {
        return view('pelanggan/table');
    }
    public function all(){
        $pm = new Pelanggan();
        $pm ->select('id','nama_depan','nama_belakang','gender','alamat','kota','notelp','hp','email','tgl_daftar','created_at','updated_at','delete_at');

        return (new Datatable($pm))
            ->setFieldFilter(['id','nama_depan','nama_belakang','gender','alamat','kota','notelp','hp','email','tgl_daftar','created_at','updated_at','delete_at'])
            ->draw();
    }
    public function show($id){
        $r = (new Pelanggan())->where('id',$id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
}
public function store(){
    $pm = new Pelanggan();

    $id = $pm->insert([
        'id' =>$this->request->getVar('id'),
        'nama_depan' =>$this->request->getVar('nama_depan'),
        'nama_belakang' =>$this->request->getVar('nama_belakang'),
        'gender' =>$this->request->getVar('gender'),
        'alamat' =>$this->request->getVar('alamat'),
        'kota' =>$this->request->getVar('kota'),
        'notelp' =>$this->request->getVar('notelp'),
        'hp' =>$this->request->getVar('hp'),
        'email' =>$this->request->getVar('email'),
        'tgl_daftar' =>$this->request->getVar('tgl_daftar'),
        'created_at' =>$this->request->getVar('created_at'),
        'updated_at' =>$this->request->getVar('updated_at'),
        'deleted_at' =>$this->request->getVar('deleted_at'),

    ]);
    return $this->response->setJSON(['id' => $id])
                ->setStatusCode(intval($id) > 0 ? 200 : 406);
}
public function update(){
    $pm = new Pelanggan();
    $id = (int)$this->request->getVar('id');

    if($pm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();

    $hasil = $pm ->update($id, [
        'id' =>$this->request->getVar('id'),
        'nama_depan' =>$this->request->getVar('nama_depan'),
        'nama_belakang' =>$this->request->getVar('nama_belakang'),
        'gender' =>$this->request->getVar('gender'),
        'alamat' =>$this->request->getVar('alamat'),
        'kota' =>$this->request->getVar('kota'),
        'notelp' =>$this->request->getVar('notelp'),
        'hp' =>$this->request->getVar('hp'),
        'email' =>$this->request->getVar('email'),
        'tgl_daftar' =>$this->request->getVar('tgl_daftar'),
        'created_at' =>$this->request->getVar('created_at'),
        'updated_at' =>$this->request->getVar('updated_at'),
        'deleted_at' =>$this->request->getVar('deleted_at'),

    ]);
    return $this->response->setJSON(['result' =>$hasil]);
}
public function delete(){
    $pm = new Pelanggan();
    $id = $this->request->getVar('id');
    $hasil = $pm->delete($id);
    return $this->response->setJSON(['result' => $hasil]);
}
}