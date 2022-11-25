<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\StatusPemeriksaan;
use CodeIgniter\Exceptions\PageNotFoundException;

class StatusPemeriksaanController extends BaseController
{
    public function index()
    {
        return view('statuspemeriksaan/table');
    }
    public function all(){
        $pm = new StatusPemeriksaan();
        $pm ->select('id','status','urutan','aktif');

        return (new Datatable($pm))
            ->setFieldFilter(['id','status','urutan','aktif'])
            ->draw();
    }
    public function show($id){
        $r = (new StatusPemeriksaan())->where('id',$id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
}
public function store(){
    $pm = new StatusPemeriksaan();

    $id = $pm->insert([
        'id' =>$this->request->getVar('id'),
        'status' =>$this->request->getVar('status'),
        'urutan' =>$this->request->getVar('urutan'),
        'aktif' =>$this->request->getVar('aktif'),

    ]);
    return $this->response->setJSON(['id' => $id])
                ->setStatusCode(intval($id) > 0 ? 200 : 406);
}
public function update(){
    $pm = new StatusPemeriksaan();
    $id = (int)$this->request->getVar('id');

    if($pm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();

    $hasil = $pm ->update($id, [
        'id' =>$this->request->getVar('id'),
        'status' =>$this->request->getVar('status'),
        'urutan' =>$this->request->getVar('urutan'),
        'aktif' =>$this->request->getVar('aktif'),

    ]);
    return $this->response->setJSON(['result' =>$hasil]);
}
public function delete(){
    $pm = new StatusPemeriksaan();
    $id = $this->request->getVar('id');
    $hasil = $pm->delete($id);
    return $this->response->setJSON(['result' => $hasil]);
}
}