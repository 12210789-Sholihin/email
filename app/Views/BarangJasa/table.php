<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <div class="container">
        <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
<table id='table-barangjasa' class="datatable table table-bordered border-primary">
    <thead>
        <tr class='table-primary'>
            <th>nama</th>
            <th>jenis bj</th>
            <th>unit satuan id</th>
            <th>harga satuan</th>
            <th>keterangan</th>
            <th>Aksi</th>
            

        </tr>
    </thead>
</table>
    </div>
<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Barang Jasa</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <div class="modal-body">
                    <form id="formbarangjasa" method="post" action="<?=base_url('barangjasa')?>">
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">nama</label>
                        <input type="varchar" name="nama" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">jenis bj</label>
                    <select name="jenis_bj" class="form-control">
                        <option value="B">Barang</option>
                        <option value="J">Jasa</option>
                    </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">unit satuan id</label>
                        <input type="int" name="unitsatuan_id" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">harga satuan</label>
                        <input type="double" name="harga_satuan" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">keterangan</label>
                        <input type="text" name="keterangan" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">foto</label>
                        <input type="varbinary" name="foto" class="form-control"/>
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
        $('form#formbarangjasa').submitAjax({
            pre:()=>{
                $('button#btn-kirim').hide();
            },
            pasca:()=>{
                $('button#btn-kirim').show();
            },
            success:(response,status)=>{
                $("#modalForm").modal('hide');
                $("table#table-barangjasa").DataTable().ajax.reload();
            },
            error: (xhr,status)=>{
                alert('maaf, data pengguna gagal direkam');
            }
        });
        $('button#btn-kirim').on('click', function(){
            $('form#barangjasa').submit();
        });
        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formbarangjasa').trigger('reset');
            $('input[name=_method]').val('');
        });
        
        $('table#table-barangjasa').on('click', '.btn-edit', function(){
            let id =$(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/barangjasa/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=nama]').val(nama);
                $('input[name=jenis_bj]').val(jenis_bj);
                $('input[name=unitsatuan_id]').val(unitsatuan_id);
                $('input[name=harga_satuan]').val(harga_satuan);
                $('input[name=keterangan]').val(keterangan);
                $('input[name=foto]').val(foto);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');
            });
        });
        $('table#table-barangjasa').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm('barangjasa akan dihapus, ingin melanjutkan?');

            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";
                $.post(`${baseurl}/barangjasa`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-barangjasa').DataTable().ajax.reload();
                });
            }
        });
        $('table#table-barangjasa').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('barangjasa/all')  ?>",
                method: 'GET'
            },
            columns:[
                {data: 'id', sortable:false, searchable:false,
                render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                }
            },
                // {data: 'id'},
                {data: 'nama'},
                {data: 'jenis_bj'},
                {data: 'unitsatuan_id'},
                {data: 'harga_satuan'},
                {data: 'keterangan'},
                {data: 'foto'},
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