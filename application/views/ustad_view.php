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
				<li class="breadcrumb-item active"><a href="#"><i class="fa fa-tasks"></i> Ustad</a></li>
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
              <th scope="col">Nama Ustad</th>
              <th scope="col">Alamat</th>>
              <th scope="col">No HP</th>
		      <th scope="col">Aksi</th>
		    </tr>
		  </thead>
		  <tbody>

		  </tbody>
		</table>
	</div>
	</div>
</div>

<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document" style="overflow-y: initial !important">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" style="height: 400px; overflow-y: scroll;">
	        <form action="#" id="form" class="form-horizontal">
	        	  <input type="hidden" id="id_ustad" name="id_ustad">
	              <div class="form-group row">
                    <div class="col-sm-12">
    				    <label for="nama_ustad" class="col-form-label">Nama Ustad</label>
    				    <input type="text" name="nama_ustad" id="nama_ustad" class="form-control" placeholder="Nama Ustad" autofocus>
    				    <small class="form-control-feedback"></small>
                    </div>
				  </div>
                  <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="tgl_lahir" class="col-form-label">Tanggal Lahir</label>
                        <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control datepicker" placeholder="">
                        <small class="form-control-feedback"></small>
                    </div>
                    <div class="col-sm-6">
                        <label for="tpt_lahir" class="col-form-label">Tempat Lahir</label>
                        <input type="text" name="tpt_lahir" id="tpt_lahir" class="form-control" placeholder="Tempat Lahir">
                        <small class="form-control-feedback"></small>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="pendidikan" class="col-form-label">Pendidikan Terakhir</label>
                        <select class="form-control" name="pendidikan" id="pendidikan">
                          <option value="">--Pendidikan--</option>
                          <option value="SMA/Sederajat">SMA/Sederajat</option>
                          <option value="D3">D3</option>
                          <option value="D4">D4</option>
                          <option value="S1">S1</option>
                          <option value="S2">S2</option>
                          <option value="S3">S3</option>
                        </select>
                        <small class="form-control-feedback"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="universitas" class="col-form-label">Universitas</label>
                        <input type="text" name="universitas" id="universitas" class="form-control" placeholder="Universitas">
                        <small class="form-control-feedback"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="alamat" class="col-form-label">Alamat Lengkap</label>
                        <textarea name="alamat" id="alamat" class="form-control"></textarea>
                        <small class="form-control-feedback"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="no_hp" class="col-form-label">No HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="No HP">
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
        "scrollX": true,
        "order": [], 
        "aLengthMenu": [[10, 25, 50, 100, 250, 500, 1000], [10, 25, 50, 100, 250, 500, 1000]],
        "pageLength": 10,
        "language": {
            "zeroRecords": "Data Tidak Ditemukan",
        },
        
        "ajax": {
            "url": "<?php echo site_url('ustad/display')?>",
            "type": "POST"
        },

        
        "columnDefs": [
        { 
            "targets": [ 0, 2 ], 
            "orderable": false, 
        },
        ],

    });

    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
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
    $('#form')[0].reset(); 
    $('.form-group').removeClass('has-danger'); 
    $('.form-control').removeClass('form-control-danger');   
    $('.form-control-feedback').empty(); 
    $('#modal_form').modal('show'); 
    $('.modal-title').text('Tambah Ustad'); 
}

function edit(id_ustad)
{
    save_method = 'update';
    $('#form')[0].reset(); 
    $('.form-group').removeClass('has-danger'); 
    $('.form-control').removeClass('form-control-danger');   
    $('.form-control-feedback').empty(); 
    
    $.ajax({
        url : "<?php echo site_url('ustad/edit')?>/" + id_ustad,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_ustad"]').val(data.id_ustad);
            $('[name="nama_ustad"]').val(data.nama_ustad)
            $('[name="tgl_lahir"]').val(data.tgl_lahir);
            $('[name="tpt_lahir"]').val(data.tpt_lahir);
            $('[name="pendidikan"]').val(data.pendidikan);
            $('[name="universitas"]').val(data.universitas);
            $('[name="alamat"]').val(data.alamat);
            $('[name="no_hp"]').val(data.no_hp)
            $('#modal_form').modal('show'); 
            $('.modal-title').text('Edit ustad'); 

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
        url = "<?php echo site_url('ustad/tambah')?>";
        pesan ="Simpan";
        form = '#form';
        modall = '#modal_form';
    } else {
        url = "<?php echo site_url('ustad/update')?>";
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

function hapus(id_ustad)
{
    swal({
        title:"Hapus data Ustad",
        text:"Yakin akan menghapus data Ustad ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Hapus",
        closeOnConfirm: true,
    },
    function(){
        $.ajax({
            url : "<?php echo site_url('ustad/delete')?>/"+id_ustad,
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