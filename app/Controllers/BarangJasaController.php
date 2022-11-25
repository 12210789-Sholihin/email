<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\BarangJasa;
use CodeIgniter\Exceptions\PageNotFoundException;

class BarangJasaController extends BaseController
{
    public function index(){
        return view('metodebayar/table');
    }
    public function all(){
        $pm = new BarangJasa();
        $pm ->select('id, nama, jenis_bj, unitsatuan_id, harga_satuan, keterangan, foto, created_at, updated_at, deleted_at');

        return (new Datatable($pm))
                ->setFieldFilter(['nama','jenis_bj','unitsatuan_id','harga_satuan','keterangan','foto','created_at','updated_at','deleted_at'])
                ->draw();
    }
    public function show($id){
        $r = (new BarangJasa())->where('id',$id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
}
public function store(){
    $pm = new BarangJasa();

    $id = $pm->insert([
        'id' =>$this->request->getVar('id'),
        'nama' =>$this->request->getVar('nama'),
        'jenis_bj' =>$this->request->getVar('jenis_bj'),
        'unitsatuan_id' =>$this->request->getVar('unitsatuan_id'),
        'harga_satuan' =>$this->request->getVar('harga_satuan'),
        'keterangan' =>$this->request->getVar('keterangan'),
        'foto' =>$this->request->getVar('foto'),
        'created_at' =>$this->request->getVar('created_at'),
        'updated_at' =>$this->request->getVar('updated_at'),
        'deleted_at' =>$this->request->getVar('deleted_at'),

    ]);
    return $this->response->setJSON(['id' => $id])
                ->setStatusCode(intval($id) > 0 ? 200 : 406);
}
public function update(){
    $pm = new BarangJasa();
    $id = (int)$this->request->getVar('id');

    if($pm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();

    $hasil = $pm ->update($id, [
        'id' =>$this->request->getVar('id'),
        'nama' =>$this->request->getVar('nama'),
        'jenis_bj' =>$this->request->getVar('jenis_bj'),
        'unitsatuan_id' =>$this->request->getVar('unitsatuan_id'),
        'harga_satuan' =>$this->request->getVar('harga_satuan'),
        'keterangan' =>$this->request->getVar('keterangan'),
        'foto' =>$this->request->getVar('foto'),
        'created_at' =>$this->request->getVar('created_at'),
        'updated_at' =>$this->request->getVar('updated_at'),
        'deleted_at' =>$this->request->getVar('deleted_at'),

    ]);
    return $this->response->setJSON(['result' =>$hasil]);
}
public function delete(){
    $pm = new BarangJasa();
    $id = $this->request->getVar('id');
    $hasil = $pm->delete($id);
    return $this->response->setJSON(['result' => $hasil]);
}
}