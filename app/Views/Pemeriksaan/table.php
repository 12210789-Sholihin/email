<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <div class="container">
        <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
<table id='table-pemeriksaan' class="datatable table table-bordered border-primary">
    <thead>
        <tr class='table-primary'>
            <th>tgl</th>
            <th>kendaraan id</th>
            <th>kilometer skr</th>
            <th>catatan</th>
            <th>sa karyawan id</th>
            <th>mon karyawan id</th>
            <th>tagihan</th>
            <th>status pemeriksaan id</th>
            <th>Aksi</th>
            

        </tr>
    </thead>
</table>
    </div>
<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pemeriksaan</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <div class="modal-body">
                    <form id="formpemeriksaan" method="post" action="<?=base_url('pemeriksaan')?>">
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">tgl</label>
                        <input type="datetime" name="tgl" class="form-control"/>
                        </div>
                    <div class="mb-3">
                        <label class="form-label">kendaraan id</label>
                        <input type="int" name="kendaraan_id" class="form-control"/>
                        </div>
                    <div class="mb-3">
                        <label class="form-label">kilometer skr</label>
                        <input type="double" name="kilometer_skr" class="form-control"/>
                        </div>
                    <div class="mb-3">
                        <label class="form-label">catatan</label>
                        <input type="text" name="catatan" class="form-control/">
                        </div>
                    <div class="mb-3">
                        <label class="form-label">sa karyawan id</label>
                        <input type="int" name="sa_karyawan_id" class="form-control/">
                        </div>
                    <div class="mb-3">
                        <label class="form-label">mon karyawan id</label>
                        <input type="int" name="mon_karyawan_id" class="form-control/">
                        </div>
                    <div class="mb-3">
                        <label class="form-label">tagihan</label>
                        <input type="double" name="tagihan" class="form-control/">
                        </div>
                    <div class="mb-3">
                        <label class="form-label">status pemeriksaan id</label>
                        <input type="int" name="statuspemeriksaan_id" class="form-control/">
                        </div>
                    </div>
                
                </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" id='btn-kirim'>Kirim</button>
                    </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('form#formpemeriksaan').submitAjax({
            pre:()=>{
                $('button#btn-kirim').hide();
            },
            pasca:()=>{
                $('button#btn-kirim').show();
            },
            success:(response,status)=>{
                $("#modalForm").modal('hide');
                $("table#table-pemeriksaan").DataTable().ajax.reload();
            },
            error: (xhr,status)=>{
                alert('maaf, data pengguna gagal direkam');
            }
        });
        $('button#btn-kirim').on('click', function(){
            $('form#status').submit();
        });
        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formpemeriksaan').trigger('reset');
            $('input[name=_method]').val('');
        });
        
        $('table#table-pemeriksaan').on('click', '.btn-edit', function(){
            let id =$(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/pemeriksaan/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=tgl]').val(tgl);
                $('input[name=kendaraan_id]').val(kendaraan_id);
                $('input[name=kilometer_skr]').val(kilometer_skr);
                $('input[name=catatan]').val(catatan);
                $('input[name=sa_karyawan_id]').val(sa_karyawan_id);
                $('input[name=mon_karyawan_id]').val(mon_karyawan_id);
                $('input[name=tagihan]').val(tagihan);
                $('input[name=statuspemeriksaan_id]').val(statuspemeriksaan_id);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');
            });
        });
        $('table#table-pemeriksaaan').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm('kendaraan akan dihapus, ingin melanjutkan?');

            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";
                $.post(`${baseurl}/pemeriksaan`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-pemeriksaan').DataTable().ajax.reload();
                });
            }
        });
        $('table#table-pemeriksaan').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('pemeriksaan/all')  ?>",
                method: 'GET'
            },
            columns:[
                {data: 'id', sortable:false, searchable:false,
                render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                }
            },
                // {data: 'id'},
                {data: 'tgl'},
                {data: 'kendaraan_id'},
                {data: 'kilometer_skr'},
                {data: 'catatan'},
                {data: 'sa_karyawan_id'},
                {data: 'mon_karyawan_id'},
                {data: 'tagihan'},
                {data: 'statuspemeriksaan_id'},
                {data: 'id',
                    render: (data, type, meta, row)=>{
                        var btnEdit = `<button class='btn-edit' data-id='${data}'> Edit </button>`;
                        var btnHapus = `<button class='btn-hapus' data-id='${data}'> Hapus </button>`;
                        return btnEdit + btnHapus;
                    }
                }
            ]
        });
    });
</script>