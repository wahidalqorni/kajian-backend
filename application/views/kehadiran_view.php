<script type="text/javascript" src="<?php echo base_url('assets/selectize/selectize.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/selectize/index.js') ?>"></script>
<div id="content">
	<nav class="navbar navbar-toggleable-md navbar-light bg-light">
	  	<button type="button" id="sidebarCollapse" class="btn btn-light navbar-btn" style="padding: .5rem .5rem;">
	        <i class="fa fa-bars"></i>
	    </button>
	  	<div class="collapse navbar-collapse justify-content-end avatar" id="navbarNavDropdown">
	    	<ul class="navbar-nav">
	      		<span>Selamat Datang!, <?php echo $this->session->userdata('nama'); ?></span>
		  		<img src="<?php echo base_url('assets/images/logoGh.png') ?>">
	    	</ul>
	  	</div>
        <a href="<?php echo base_url('auth/logout') ?>" class="btn btn-outline-success btn-xs">
            <i class="fa fa-sign-out"></i>
            Logout
        </a>
	</nav>
	<nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Beranda</a></li>
                <li class="breadcrumb-item active"><a href="#"><i class="fa fa-tasks"></i> Kehadiran
        </ol>
    </nav>
    
    <div class="container-fluid">
    <div class="jumbotron">
        <div class="header-table">
            <button class="btn btn-outline-primary" onclick="tambah()">TAMBAH</button>
            <button class="btn btn-outline-success" onclick="reload_table()">REFRESH</button>
        </div>
        <table class="table" id="table" cellspacing="0" width="100%">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Kajian</th>
              <!--<th scope="col">Jadwal</th>-->
              <th scope="col">Konfirmasi</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
    </div>
    </div>
</div>
<!-- form tambah/edit kehadiran -->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="#" id="form" class="form-horizontal">
                  <input type="hidden" id="id_kehadiran" name="id_kehadiran">
                  <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="id_user" class="col-form-label">Jamaah</label>
                        <select class="form-control" name="id_user" id="id_user">
                          <option value="">--Pilih Jamaah--</option>
                          <?php foreach ($user as $user) { ?>
                              <option value="<?php echo $user->id_user; ?>"><?php echo $user->nama; ?></option>
                          <?php } ?>
                        </select>
                        <small class="form-control-feedback"></small>
                    </div>
                    <div class="col-sm-12">
                        <label for="kajian" class="col-form-label">Kajian</label>
                        <select class="form-control" name="id_jadwal" id="id_jadwal">
                          <option value="">--Pilih kajian--</option>
                          <?php foreach ($jadwal as $jadwal) { ?>
                              <option value="<?php echo $jadwal->id_jadwal; ?>"><?php echo $jadwal->judul_kajian; ?></option>
                          <?php } ?>
                        </select>
                        <small class="form-control-feedback"></small>
                    </div>
                    <div class="col-sm-12">
                        <label for="konfirmasi" class="col-form-label">Konfirmasi</label>
                        <select name="konfirmasi" class="form-control">
                            <option value="">--Pilih--</option>
                            <option value="Insya Allah">Insya Allah</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                        <small class="form-control-feedback"></small>
                    </div>
                  </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" id="btnSave" onclick="simpan()">Simpan</button>
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
          </div>
        </div>
     </div>
</div>

<script type="text/javascript">

var save_method; 
var table;

$(document).ready(function() {

    table = $('#table').DataTable({ 

        "processing": true, 
        "serverSide": true, 
        "order": [], 
        "aLengthMenu": [[10, 25, 50, 100, 250, 500, 1000], [10, 25, 50, 100, 250, 500, 1000]],
        "pageLength": 10,
        "language": {
            "zeroRecords": "Data Tidak Ditemukan",
        },
        
        "ajax": {
            "url": "<?php echo site_url('kehadiran/display')?>",//'kategori'=class, 
            "type": "POST"
        },

        
        "columnDefs": [
        { 
            "targets": [ 0, 2 ], 
            "orderable": false, 
        },
        ],

    });
    
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-danger');
        $(this).removeClass('form-control-danger');
        $(this).next().empty();
    });

    $('#table').on('draw.dt', function () {
        $('[data-toggle="tooltip"]').tooltip();
    }); 

});

function reload_table()
{
    table.ajax.reload(null,false); 
}

function tambah()
{
    save_method = 'add';
    $('#form')[0].reset(); //memanggil id form
    $('.form-group').removeClass('has-danger'); 
    $('.form-control').removeClass('form-control-danger');   
    $('.form-control-feedback').empty(); 
    $('#modal_form').modal('show'); 
    $('.modal-title').text('Tambah kehadiran'); //mengisi title pada form modal tambah
}

function edit(id_konfir)
{
    save_method = 'update';
    $('#form')[0].reset(); 
    $('.form-group').removeClass('has-danger'); 
    $('.form-control').removeClass('form-control-danger');   
    $('.form-control-feedback').empty(); 
    
    $.ajax({
        url : "<?php echo site_url('kehadiran/edit')?>/" + id_konfir,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_kehadiran"]').val(data.id_konfir);
            $('[name="id_user"]').val(data.id_user);
            $('[name="id_jadwal"]').val(data.id_jadwal);
            $('[name="konfirmasi"]').val(data.konfirmasi);
            $('#modal_form').modal('show'); 
            $('.modal-title').text('Edit kehadiran'); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); 
}

function simpan()
{
    $('#btnSave').text('Simpan...'); 
    $('#btnSave').attr('disabled',true); 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('kehadiran/tambah')?>";//'kehadiran'=class, 'tambah'=fungsi
        pesan ="Simpan";
        form = '#form';
        modall = '#modal_form';
    } else {
        url = "<?php echo site_url('kehadiran/update')?>";
        pesan ="Update";
        form = '#form';
        modall = '#modal_form';
    }

    
    $.ajax({
        url : url,
        type: "POST",
        data: $(form).serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) 
            {
                $(modall).modal('hide');
                swal("",pesan+" Data Berhasil","success");
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-danger'); 
                    $('[name="'+data.inputerror[i]+'"]').addClass('form-control-danger'); 
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                }
            }
            $('#btnSave').text('Simpan'); 
            $('#btnSave').attr('disabled',false); 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Operasi Gagal, Periksa Koneksi Internet Anda!');
            $('#btnSave').text('Simpan'); 
            $('#btnSave').attr('disabled',false); 

        }
    });
}
//muncul form hapus konfirmasi
function hapus(id_kehadiran)
{
    swal({
        title:"Hapus kehadiran",
        text:"Yakin akan menghapus kehadiran ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya",
        closeOnConfirm: true,
    },
    function(){
        $.ajax({
            url : "<?php echo site_url('kehadiran/delete')?>/"+id_kehadiran,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                swal("","Hapus Data Berhasil","success");
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    });  
}

</script>