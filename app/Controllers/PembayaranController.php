<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\Pembayaran;
use CodeIgniter\Exceptions\PageNotFoundException;

class PembayaranController extends BaseController
{
    public function index()
    {
        return view('pembayaran/table');
    }
    public function all(){
        $pm = new Pembayaran();
        $pm ->select('id','pemeriksaan_id','tgl_bayar','metode_bayar_id','dibayaroleh','catatan','karyawan_id','total_bayar','created_at','updated_at');

        return (new Datatable($pm))
            ->setFieldFilter(['id','pemeriksaan_id','tgl_bayar','metode_bayar_id','dibayaroleh','catatan','karyawan_id','total_bayar','created_at','updated_at'])
            ->draw();
    }
    public function show($id){
        $r = (new Pembayaran())->where('id',$id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
}
public function store(){
    $pm = new Pembayaran();

    $id = $pm->insert([
        'id' =>$this->request->getVar('id'),
        'pemeriksaan_id' =>$this->request->getVar('pemeriksaan_id'),
        'tgl_bayar' =>$this->request->getVar('tgl_bayar'),
        'metode_bayar_id' =>$this->request->getVar('metode_bayar_id'),
        'dibayaroleh' =>$this->request->getVar('dibayaroleh'),
        'catatan' =>$this->request->getVar('catatan'),
        'karyawan_id' =>$this->request->getVar('karyawan_id'),
        'total_bayar' =>$this->request->getVar('total_bayar'),
        'created_at' =>$this->request->getVar('created_at'),
        'updated_at' =>$this->request->getVar('updated_at'),

    ]);
    return $this->response->setJSON(['id' => $id])
                ->setStatusCode(intval($id) > 0 ? 200 : 406);
}
public function update(){
    $pm = new Pembayaran();
    $id = (int)$this->request->getVar('id');

    if($pm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();

    $hasil = $pm ->update($id, [
        'id' =>$this->request->getVar('id'),
        'pemeriksaan_id' =>$this->request->getVar('pemeriksaan_id'),
        'tgl_bayar' =>$this->request->getVar('tgl_bayar'),
        'metode_bayar_id' =>$this->request->getVar('metode_bayar_id'),
        'dibayaroleh' =>$this->request->getVar('dibayaroleh'),
        'catatan' =>$this->request->getVar('catatan'),
        'karyawan_id' =>$this->request->getVar('karyawan_id'),
        'total_bayar' =>$this->request->getVar('total_bayar'),
        'created_at' =>$this->request->getVar('created_at'),
        'updated_at' =>$this->request->getVar('updated_at'),

    ]);
    return $this->response->setJSON(['result' =>$hasil]);
}
public function delete(){
    $pm = new Pembayaran();
    $id = $this->request->getVar('id');
    $hasil = $pm->delete($id);
    return $this->response->setJSON(['result' => $hasil]);
}
}