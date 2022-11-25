<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\JenisKendaraan;
use CodeIgniter\Exceptions\PageNotFoundException;

class JenisKendaraanController extends BaseController
{
    public function index()
    {
        return view('jeniskendaraan/table');
    }
    public function all(){
        $pm = new JenisKendaraan();
        $pm ->select('id','jenis','aktif');

        return (new Datatable($pm))
            ->setFieldFilter(['id','jenis','aktif'])
            ->draw();
    }
    public function show($id){
        $r = (new JenisKendaraan())->where('id',$id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
}
public function store(){
    $pm = new JenisKendaraan();

    $id = $pm->insert([
        'id' =>$this->request->getVar('id'),
        'jenis' =>$this->request->getVar('jenis'),
        'aktif' =>$this->request->getVar('aktif'),

    ]);
    return $this->response->setJSON(['id' => $id])
                ->setStatusCode(intval($id) > 0 ? 200 : 406);
}
public function update(){
    $pm = new JenisKendaraan();
    $id = (int)$this->request->getVar('id');

    if($pm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();

    $hasil = $pm ->update($id, [
        'id' =>$this->request->getVar('id'),
        'jenis' =>$this->request->getVar('jenis'),
        'aktif' =>$this->request->getVar('aktif'),

    ]);
    return $this->response->setJSON(['result' =>$hasil]);
}
public function delete(){
    $pm = new JenisKendaraan();
    $id = $this->request->getVar('id');
    $hasil = $pm->delete($id);
    return $this->response->setJSON(['result' => $hasil]);
}
}