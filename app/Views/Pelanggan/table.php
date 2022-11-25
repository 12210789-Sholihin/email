<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <div class="container">
        <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
<table id='table-pelanggan' class="datatable table table-bordered border-primary">
    <thead>
        <tr class='table-primary'>
            <th>no</th>
            <th>nama depan</th>
            <th>nama belakang</th>
            <th>gender</th>
            <th>alamat</th>
            <th>kota</th>
            <th>notelp</th>
            <th>hp</th>
            <th>email</th>
            <th>tgl daftar</th>
            <th>Aksi</th>
            

        </tr>
    </thead>
</table>
    </div>
<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pelanggan</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <div class="modal-body">
                    <form id="formpelanggan" method="post" action="<?=base_url('pelanggan')?>">
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">nama lengkap</label>
                        <input type="varchar" name="nama_lengkap" class="form-control"/>
                        </div>
                    <div class="mb-3">
                        <label class="form-label">nama belakang</label>
                        <input type="varchar" name="nama_belakang" class="form-control"/>
                        </div>
                    <div class="mb-3">
                        <label class="form-label">gender</label>
                    <select name="gender" class="form-control">
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">alamat</label>
                        <input type="varchar" name="alamat" class="form-control/">
                        </div>
                    <div class="mb-3">
                        <label class="form-label">kota</label>
                        <input type="varchar" name="kota" class="form-control/">
                        </div>
                    <div class="mb-3">
                        <label class="form-label">notelp</label>
                        <input type="varchar" name="notelp" class="form-control/">
                        </div>
                    <div class="mb-3">
                        <label class="form-label">hp</label>
                        <input type="varchar" name="hp" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">email</label>
                        <input type="varchar" name="email" class="form-control/">
                        </div>
                    <div class="mb-3">
                        <label class="form-label">tgl daftar</label>
                        <input type="date" name="tgl_daftar" class="form-control/">
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
        $('form#formpelanggan').submitAjax({
            pre:()=>{
                $('button#btn-kirim').hide();
            },
            pasca:()=>{
                $('button#btn-kirim').show();
            },
            success:(response,status)=>{
                $("#modalForm").modal('hide');
                $("table#table-pelanggan").DataTable().ajax.reload();
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
            $('form#formpelanggan').trigger('reset');
            $('input[name=_method]').val('');
        });
        
        $('table#table-pelanggan').on('click', '.btn-edit', function(){
            let id =$(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/pelanggan/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=nama_lengkap]').val(nama_lengkap);
                $('input[name=nama_belakang]').val(nama_belakang);
                $('input[name=gender]').val(gender);
                $('input[name=alamat]').val(alamat);
                $('input[name=kota]').val(kota);
                $('input[name=notelp]').val(notelp);
                $('input[name=hp]').val(hp);
                $('input[name=email]').val(email);
                $('input[name=tgl_daftar]').val(tgl_daftar);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');
            });
        });
        $('table#table-pelanggan').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm('pelanggan akan dihapus, ingin melanjutkan?');

            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";
                $.post(`${baseurl}/pelanggan`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-pelanggan').DataTable().ajax.reload();
                });
            }
        });
        $('table#table-pelanggan').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('pelanggan/all')  ?>",
                method: 'GET'
            },
            columns:[
                {data: 'id', sortable:false, searchable:false,
                render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                }
            },
                // {data: 'id'},
                {data: 'nama_lengkap'},
                {data: 'nama_belakang'},
                {data: 'gender'},
                {data: 'alamat'},
                {data: 'kota'},
                {data: 'notelp'},
                {data: 'hp'},
                {data: 'email'},
                {data: 'tgl_daftar'},
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