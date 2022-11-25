<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\WarnaKendaraan;
use CodeIgniter\Exceptions\PageNotFoundException;

class WarnaKendaraanController extends BaseController
{
    public function index()
    {
        return view('warnakendaraan/table');
    }
    public function all(){
        $pm = new WarnaKendaraan();
        $pm ->select('id','warna');

        return (new Datatable($pm))
            ->setFieldFilter(['id','warna'])
            ->draw();
    }
    public function show($id){
        $r = (new WarnaKendaraan())->where('id',$id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
}
public function store(){
    $pm = new WarnaKendaraan();

    $id = $pm->insert([
        'id' =>$this->request->getVar('id'),
        'warna' =>$this->request->getVar('warna'),

    ]);
    return $this->response->setJSON(['id' => $id])
                ->setStatusCode(intval($id) > 0 ? 200 : 406);
}
public function update(){
    $pm = new WarnaKendaraan();
    $id = (int)$this->request->getVar('id');

    if($pm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();

    $hasil = $pm ->update($id, [
        'id' =>$this->request->getVar('id'),
        'warna' =>$this->request->getVar('warna'),

    ]);
    return $this->response->setJSON(['result' =>$hasil]);
}
public function delete(){
    $pm = new WarnaKendaraan();
    $id = $this->request->getVar('id');
    $hasil = $pm->delete($id);
    return $this->response->setJSON(['result' => $hasil]);
}
}
