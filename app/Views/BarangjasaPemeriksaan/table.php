<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <div class="container">
        <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
<table id='table-barangjasapemeriksaan' class="datatable table table-bordered border-primary">
    <thead>
        <tr class='table-primary'>
            <th>pemeriksaan id</th>
            <th>barang jasa id</th>
            <th>qty</th>
            <th>harga satuan</th>
            <th>Aksi</th>
            

        </tr>
    </thead>
</table>
    </div>
<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Barang Jasa Pemeriksaan</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <div class="modal-body">
                    <form id="formbarangjasapemeriksaan" method="post" action="<?=base_url('barangjasapemeriksaan')?>">
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">pemeriksaan id</label>
                        <input type="int" name="pemeriksaan_id" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">barang jasa id</label>
                        <input type="int" name="barang_jasa_id" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">qty</label>
                        <input type="double" name="qty" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">harga satuan</label>
                        <input type="double" name="harga_satuan" class="form-control"/>
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
        $('form#formbarangjasapemeriksaan').submitAjax({
            pre:()=>{
                $('button#btn-kirim').hide();
            },
            pasca:()=>{
                $('button#btn-kirim').show();
            },
            success:(response,status)=>{
                $("#modalForm").modal('hide');
                $("table#table-barangjasapemeriksaan").DataTable().ajax.reload();
            },
            error: (xhr,status)=>{
                alert('maaf, data pengguna gagal direkam');
            }
        });
        $('button#btn-kirim').on('click', function(){
            $('form#barangjasapemeriksaan').submit();
        });
        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formbarangjasapemeriksaan').trigger('reset');
            $('input[name=_method]').val('');
        });
        
        $('table#table-barangjasapemeriksaan').on('click', '.btn-edit', function(){
            let id =$(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/barangjasapemeriksaan/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=pemeriksaan_id]').val(pemeriksaan_id);
                $('input[name=barang_jasa_id]').val(barang_jasa_id);
                $('input[name=qty').val(qty);
                $('input[name=harga_satuan]').val(harga_satuan);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');
            });
        });
        $('table#table-barangjasapemeriksaan').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm('barangjasapemeriksaan akan dihapus, ingin melanjutkan?');

            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";
                $.post(`${baseurl}/barangjasapemeriksaan`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-barangjasapemeriksaan').DataTable().ajax.reload();
                });
            }
        });
        $('table#table-barangjasapemeriksaan').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('barangjasapemeriksaan/all')  ?>",
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
                {data: 'barang_jasa_id'},
                {data: 'qty'},
                {data: 'harga_satuan'},
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