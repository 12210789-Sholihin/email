<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <div class="container">
        <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
<table id='table-pembayaran' class="datatable table table-bordered border-primary">
    <thead>
        <tr class='table-primary'>
            <th>pemeriksaan id</th>
            <th>tgl bayar</th>
            <th>metode bayar id</th>
            <th>di bayar oleh</th>
            <th>catatan</th>
            <th>karyawan id</th>
            <th>total bayar</th>
            <th>Aksi</th>
            

        </tr>
    </thead>
</table>
    </div>
<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">pembayaran</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <div class="modal-body">
                    <form id="formtpembayaran" method="post" action="<?=base_url('pembayaran')?>">
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">pemeriksaan id</label>
                        <input type="int" name="pemeriksaan_id" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">tgl bayar</label>
                        <input type="datetime" name="tgl_bayar" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">metode bayar id</label>
                        <input type="int" name="metode_bayar_id" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">dibayaroleh</label>
                        <input type="varchar" name="dibayaroleh" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">catatan</label>
                        <input type="text" name="catatan" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">karyawan id</label>
                        <input type="int" name="karyawan_id" class="form-control"/>
                    <div class="mb-3">
                        <label class="form-label">total bayar</label>
                        <input type="double" name="total_bayar" class="form-control"/>
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
        $('form#formpembayaran').submitAjax({
            pre:()=>{
                $('button#btn-kirim').hide();
            },
            pasca:()=>{
                $('button#btn-kirim').show();
            },
            success:(response,status)=>{
                $("#modalForm").modal('hide');
                $("table#table-pembayaran").DataTable().ajax.reload();
            },
            error: (xhr,status)=>{
                alert('maaf, data pengguna gagal direkam');
            }
        });
        $('button#btn-kirim').on('click', function(){
            $('form#pembayaran').submit();
        });
        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formpembayaran').trigger('reset');
            $('input[name=_method]').val('');
        });
        
        $('table#table-pembayaran').on('click', '.btn-edit', function(){
            let id =$(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/pembayaran/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=pemeriksaan_id]').val(pemeriksaan_id);
                $('input[name=tgl_bayar]').val(tgl_bayar);
                $('input[name=metode_bayar_id]').val(meetode_bayar_id);
                $('input[name=dibayaroleh]').val(dibayaroleh);
                $('input[name=catatan]').val(catatan);
                $('input[name=karyawan_id]').val(karyawan_id);
                $('input[name=total_bayar]').val(total_bayar);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');
            });
        });
        $('table#table-pembayaran').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm('pembayaran akan dihapus, ingin melanjutkan?');

            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";
                $.post(`${baseurl}/pembayaran`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-pembayaran').DataTable().ajax.reload();
                });
            }
        });
        $('table#table-pembayaran').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('pembayaran/all')  ?>",
                method: 'GET'
            },
            columns:[
                {data: 'id', sortable:false, searchable:false,
                render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                }
            },
                // {data: 'id'},
                {data: 'pemeriksaan_id'},
                {data: 'tgl_bayar'},
                {data: 'metode_bayar_id'},
                {data: 'dibayaroleh'},
                {data: 'catatan'},
                {data: 'karyawan_id'},
                {data: 'total_bayar'},
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