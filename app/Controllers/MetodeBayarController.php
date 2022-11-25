<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\MetodeBayar;
use CodeIgniter\Exceptions\PageNotFoundException;

class MetodeBayarController extends BaseController
{
    public function index()
    {
        return view('metodebayar/table');
    }
    public function all(){
        $pm = new MetodeBayar();
        $pm ->select('id','metodebayar','keterangan','aktif','created_at','updated_at','deleted_at');

        return (new Datatable($pm))
            ->setFieldFilter(['id','metodebayar','keterangan','aktif','created_at','updated_at','deleted_at'])
            ->draw();
    }
    public function show($id){
        $r = (new MetodeBayar())->where('id',$id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
}
public function store(){
    $pm = new MetodeBayar();

    $id = $pm->insert([
        'id' =>$this->request->getVar('id'),
        'metodebayar' =>$this->request->getVar('metodebayar'),
        'keterangan' =>$this->request->getVar('keterangan'),
        'aktif' =>$this->request->getVar('aktif'),
        'created_at' =>$this->request->getVar('created_at'),
        'updated_at' =>$this->request->getVar('updated_at'),
        'deleted_at' =>$this->request->getVar('deleted_at'),

    ]);
    return $this->response->setJSON(['id' => $id])
                ->setStatusCode(intval($id) > 0 ? 200 : 406);
}
public function update(){
    $pm = new MetodeBayar();
    $id = (int)$this->request->getVar('id');

    if($pm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();

    $hasil = $pm ->update($id, [
        'id' =>$this->request->getVar('id'),
        'metodebayar' =>$this->request->getVar('metodebayar'),
        'keterangan' =>$this->request->getVar('keterangan'),
        'aktif' =>$this->request->getVar('aktif'),
        'created_at' =>$this->request->getVar('created_at'),
        'updated_at' =>$this->request->getVar('updated_at'),
        'deleted_at' =>$this->request->getVar('deleted_at'),

    ]);
    return $this->response->setJSON(['result' =>$hasil]);
}
public function delete(){
    $pm = new MetodeBayar();
    $id = $this->request->getVar('id');
    $hasil = $pm->delete($id);
    return $this->response->setJSON(['result' => $hasil]);
}
}