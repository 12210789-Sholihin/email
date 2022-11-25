<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\Kendaraan;
use CodeIgniter\Exceptions\PageNotFoundException;

class KendaraanController extends BaseController
{
    public function index()
    {
        return view('kendaraan/table');
    }
    public function all(){
        $pm = new Kendaraan();
        $pm ->select('id','pelanggan_id','jeniskendaraan_id','no_pol','tahun','warnakendaraan_id','created_at','updated_at','deleted_at');

        return (new Datatable($pm))
            ->setFieldFilter(['id','pelanggan_id','jeniskendaraan_id','no_pol','tahun','warnakendaraan_id','created_at','updated_at','deleted_at'])
            ->draw();
    }
    public function show($id){
        $r = (new Kendaraan())->where('id',$id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
}
public function store(){
    $pm = new Kendaraan();

    $id = $pm->insert([
        'id' =>$this->request->getVar('id'),
        'pelanggan_id' =>$this->request->getVar('pelanggan_id'),
        'no_pol' =>$this->request->getVar('no_pol'),
        'tahun' =>$this->request->getVar('tahun'),
        'warnakendaraan_id' =>$this->request->getVar('warnakendaraan_id'),
        'created_at' =>$this->request->getVar('created_at'),
        'updated_at' =>$this->request->getVar('updated_at'),
        'deleted_at' =>$this->request->getVar('deleted_at'),

    ]);
    return $this->response->setJSON(['id' => $id])
                ->setStatusCode(intval($id) > 0 ? 200 : 406);
}
public function update(){
    $pm = new Kendaraan();
    $id = (int)$this->request->getVar('id');

    if($pm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();

    $hasil = $pm ->update($id, [
        'id' =>$this->request->getVar('id'),
        'pelanggan_id' =>$this->request->getVar('pelanggan_id'),
        'no_pol' =>$this->request->getVar('no_pol'),
        'tahun' =>$this->request->getVar('tahun'),
        'warnakendaraan_id' =>$this->request->getVar('warnakendaraan_id'),
        'created_at' =>$this->request->getVar('created_at'),
        'updated_at' =>$this->request->getVar('updated_at'),
        'deleted_at' =>$this->request->getVar('deleted_at'),


    ]);
    return $this->response->setJSON(['result' =>$hasil]);
}
public function delete(){
    $pm = new Kendaraan();
    $id = $this->request->getVar('id');
    $hasil = $pm->delete($id);
    return $this->response->setJSON(['result' => $hasil]);
}
}