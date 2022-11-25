<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\UnitSatuan;
use CodeIgniter\Exceptions\PageNotFoundException;

class UnitSatuanController extends BaseController
{
    public function index()
    {
        return view('unitsatuan/table');
    }
    public function all(){
        $pm = new UnitSatuan();
        $pm ->select('id','satuan');

        return (new Datatable($pm))
            ->setFieldFilter(['id','satuan'])
            ->draw();
    }
    public function show($id){
        $r = (new UnitSatuan())->where('id',$id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
}
public function store(){
    $pm = new UnitSatuan();

    $id = $pm->insert([
        'id' =>$this->request->getVar('id'),
        'satuan' =>$this->request->getVar('satuan'),

    ]);
    return $this->response->setJSON(['id' => $id])
                ->setStatusCode(intval($id) > 0 ? 200 : 406);
}
public function update(){
    $pm = new UnitSatuan();
    $id = (int)$this->request->getVar('id');

    if($pm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();

    $hasil = $pm ->update($id, [
        'id' =>$this->request->getVar('id'),
        'satuan' =>$this->request->getVar('satuan'),

    ]);
    return $this->response->setJSON(['result' =>$hasil]);
}
public function delete(){
    $pm = new UnitSatuan();
    $id = $this->request->getVar('id');
    $hasil = $pm->delete($id);
    return $this->response->setJSON(['result' => $hasil]);
}
}
