<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\BarangjasaPemeriksaan;
use CodeIgniter\Exceptions\PageNotFoundException;

class BarangjasaPemeriksaanController extends BaseController
{
    public function index()
    {
        return view('barangjasapemeriksaan/table');
    }
    public function all(){
        $pm = new BarangjasaPemeriksaan();
        $pm ->select('id','pemeriksaan_id','barang_jasa_id','qty','harga_satuan','created_at','updated_at');

        return (new Datatable($pm))
            ->setFieldFilter(['id','pemeriksaan_id','barang_jasa_id','qty','harga_satuan','created_at','updated_at'])
            ->draw();
    }
    public function show($id){
        $r = (new BarangjasaPemeriksaan())->where('id',$id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
}
public function store(){
    $pm = new BarangjasaPemeriksaan();

    $id = $pm->insert([
        'id' =>$this->request->getVar('id'),
        'pemeriksaan_id' =>$this->request->getVar('pemeriksaan_id'),
        'barang_jasa_id' =>$this->request->getVar('barang_jasa_id'),
        'qty' =>$this->request->getVar('qty'),
        'harga_satuan' =>$this->request->getVar('harga_satuan'),
        'created_at' =>$this->request->getVar('created_at'),
        'updated_at' =>$this->request->getVar('updated_at'),

    ]);
    return $this->response->setJSON(['id' => $id])
                ->setStatusCode(intval($id) > 0 ? 200 : 406);
}
public function update(){
    $pm = new BarangjasaPemeriksaan();
    $id = (int)$this->request->getVar('id');

    if($pm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();

    $hasil = $pm ->update($id, [
        'id' =>$this->request->getVar('id'),
        'pemeriksaan_id' =>$this->request->getVar('pemeriksaan_id'),
        'barang_jasa_id' =>$this->request->getVar('barang_jasa_id'),
        'qty' =>$this->request->getVar('qty'),
        'harga_satuan' =>$this->request->getVar('harga_satuan'),
        'created_at' =>$this->request->getVar('created_at'),
        'updated_at' =>$this->request->getVar('updated_at'),

    ]);
    return $this->response->setJSON(['result' =>$hasil]);
}
public function delete(){
    $pm = new BarangjasaPemeriksaan();
    $id = $this->request->getVar('id');
    $hasil = $pm->delete($id);
    return $this->response->setJSON(['result' => $hasil]);
}
}