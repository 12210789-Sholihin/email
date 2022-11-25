<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <div class="container">
        <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
<table id='table-unitsatuan' class="datatable table table-bordered border-primary">
    <thead>
        <tr class='table-primary'>
            <th>satuan</th>
            <th>Aksi</th>
            

        </tr>
    </thead>
</table>
    </div>
<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Unit Satuan</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <div class="modal-body">
                    <form id="formunitsatuan" method="post" action="<?=base_url('unitsatuan')?>">
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">satuan</label>
                        <input type="varchar" name="satuan" class="form-control"/>
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
        $('form#formunitsatuan').submitAjax({
            pre:()=>{
                $('button#btn-kirim').hide();
            },
            pasca:()=>{
                $('button#btn-kirim').show();
            },
            success:(response,status)=>{
                $("#modalForm").modal('hide');
                $("table#table-unitsatuan").DataTable().ajax.reload();
            },
            error: (xhr,status)=>{
                alert('maaf, data pengguna gagal direkam');
            }
        });
        $('button#btn-kirim').on('click', function(){
            $('form#jenis').submit();
        });
        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formTahun').trigger('reset');
            $('input[name=_method]').val('');
        });
        
        $('table#table-unitsatuan').on('click', '.btn-edit', function(){
            let id =$(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/unitsatuan/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=satuan]').val(satuan);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');
            });
        });
        $('table#table-unitsatuan').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm('unitsatuan akan dihapus, ingin melanjutkan?');

            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";
                $.post(`${baseurl}/unitsatuan`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-unitsatuan').DataTable().ajax.reload();
                });
            }
        });
        $('table#table-unitsatuan').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('unitsatuan/all')  ?>",
                method: 'GET'
            },
            columns:[
                {data: 'id', sortable:false, searchable:false,
                render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                }
            },
                // {data: 'id'},
                {data: 'satuan'},
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