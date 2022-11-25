<?php


namespace App\Controllers;
use App\Controllers\BaseController;
use Agoenxz21\Datatables\Datatable;
use App\Models\Pemeriksaan;
use CodeIgniter\Exceptions\PageNotFoundException;

class PemeriksaanController extends BaseController
{
    public function index()
    {
        return view('pemeriksaan/table');
    }
    public function all(){
        $pm = new Pemeriksaan();
        $pm ->select('id','tgl','kendaraan_id','kilometer_skr','catatan','sa_karyawan_id','mon_karyawan_id','tagihan','statuspemeriksaan_id','created_at','updated_at');

        return (new Datatable($pm))
            ->setFieldFilter(['id','tgl','kendaraan_id','kilometer_skr','catatan','sa_karyawan_id','mon_karyawan_id','tagihan','statuspemeriksaan_id','created_at','updated_at'])
            ->draw();
    }
    public function show($id){
        $r = (new Pemeriksaan())->where('id',$id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
}
public function store(){
    $pm = new Pemeriksaan();

    $id = $pm->insert([
        'id' =>$this->request->getVar('id'),
        'tgl' =>$this->request->getVar('tgl'),
        'kendaraan_id' =>$this->request->getVar('kendaraan_id'),
        'kilometer_skr' =>$this->request->getVar('kilometer_skr'),
        'catatan' =>$this->request->getVar('catatan'),
        'sa_karyawan_id' =>$this->request->getVar('sa_karyawan_id'),
        'mon_karyawan_id' =>$this->request->getVar('mon_karyawan_id'),
        'tagihan' =>$this->request->getVar('tagihan'),
        'statuspemeriksaan_id' =>$this->request->getVar('statuspemeriksaan_id'),
        'created_at' =>$this->request->getVar('created_at'),
        'updated_at' =>$this->request->getVar('updated_at'),

    ]);
    return $this->response->setJSON(['id' => $id])
                ->setStatusCode(intval($id) > 0 ? 200 : 406);
}
public function update(){
    $pm = new Pemeriksaan();
    $id = (int)$this->request->getVar('id');

    if($pm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();

    $hasil = $pm ->update($id, [
        'id' =>$this->request->getVar('id'),
        'tgl' =>$this->request->getVar('tgl'),
        'kendaraan_id' =>$this->request->getVar('kendaraan_id'),
        'kilometer_skr' =>$this->request->getVar('kilometer_skr'),
        'catatan' =>$this->request->getVar('catatan'),
        'sa_karyawan_id' =>$this->request->getVar('sa_karyawan_id'),
        'mon_karyawan_id' =>$this->request->getVar('mon_karyawan_id'),
        'tagihan' =>$this->request->getVar('tagihan'),
        'statuspemeriksaan_id' =>$this->request->getVar('statuspemeriksaan_id'),
        'created_at' =>$this->request->getVar('created_at'),
        'updated_at' =>$this->request->getVar('updated_at'),

    ]);
    return $this->response->setJSON(['result' =>$hasil]);
}
public function delete(){
    $pm = new Pemeriksaan();
    $id = $this->request->getVar('id');
    $hasil = $pm->delete($id);
    return $this->response->setJSON(['result' => $hasil]);
}
}