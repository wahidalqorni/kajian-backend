<div id="content">
	<nav class="navbar navbar-toggleable-md navbar-light bg-light">
	  	<button type="button" id="sidebarCollapse" class="btn btn-light navbar-btn" style="padding: .5rem .5rem;">
	        <i class="fa fa-bars"></i>
	    </button>
	  	<div class="collapse navbar-collapse justify-content-end avatar" id="navbarNavDropdown">
	    	<ul class="navbar-nav">
	      		<span>Selamat Datang!, <?php echo $this->session->userdata('nama'); ?></span>
		  		<img src="<?php echo base_url('assets/images/icon.png') ?>">
	    	</ul>
	  	</div>
	</nav>
	<nav aria-label="breadcrumb" role="navigation">
		<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Beranda</a></li>
				<li class="breadcrumb-item active"><a href="#"><i class="fa fa-users"></i> Customer</a></li>
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
		      <th scope="col">Email</th>
		      <th scope="col">Nama</th>
		      <th scope="col">TTL</th>
		      <th scope="col">HP</th>
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
	<div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="#" id="form" class="form-horizontal">
	              <div class="form-group row">
				    <label for="email" class="col-sm-3 col-form-label">Email</label>
				    <div class="col-sm-9">
				    	<input type="email" name="email" id="email" class="form-control" placeholder="Email">
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="password" class="col-sm-3 col-form-label">Password</label>
				    <div class="col-sm-9">
				    	<input type="password" name="password" id="password" class="form-control" placeholder="Password">
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div>  
				  <div class="form-group row">
				    <label for="password2" class="col-sm-3 col-form-label">Ulangi Password</label>
				    <div class="col-sm-9">
				    	<input type="password" name="password2" id="password2" class="form-control" placeholder="Ulangi Password">
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div>  
				  <div class="form-group row">
				    <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
				    <div class="col-sm-9">
				    	<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap">
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div>      
				  <div class="form-group row">
				    <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
				    <div class="col-sm-9">
				    	<input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div> 
				  <div class="form-group row">
				    <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
				    <div class="col-sm-9">
				    	<input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control datepicker" placeholder="Tanggal Lahir">
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div> 
				  <div class="form-group row">
				    <label for="hp" class="col-sm-3 col-form-label">HP</label>
				    <div class="col-sm-9">
				    	<input type="text" name="hp" id="hp" class="form-control" placeholder="Nomor Handphone">
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

<div class="modal fade" id="modal_edit_form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="#" id="form_edit" class="form-horizontal">
	              <input type="hidden" name="id_customer" id="id_customer">
				  <div class="form-group row">
				    <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
				    <div class="col-sm-9">
				    	<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap">
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div>      
				  <div class="form-group row">
				    <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
				    <div class="col-sm-9">
				    	<input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div> 
				  <div class="form-group row">
				    <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
				    <div class="col-sm-9">
				    	<input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control datepicker" placeholder="Tanggal Lahir">
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div> 
				  <div class="form-group row">
				    <label for="hp" class="col-sm-3 col-form-label">HP</label>
				    <div class="col-sm-9">
				    	<input type="text" name="hp" id="hp" class="form-control" placeholder="Nomor Handphone">
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
        "aLengthMenu": [[10, 25, 50, 100, 250, 500, 1000, 2000], [10, 25, 50, 100, 250, 500, 1000, 2000]],
        "pageLength": 10,
        "language": {
            "zeroRecords": "Data Tidak Ditemukan",
        },
        
        "ajax": {
            "url": "<?php echo site_url('customer/display')?>",
            "type": "POST"
        },

        
        "columnDefs": [
        { 
            "targets": [ 0, 1, 4, 5 ], 
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
    $('.modal-title').text('Tambah Customer'); 
}

function edit(id_customer)
{
    save_method = 'update';
    $('#form')[0].reset(); 
    $('.form-group').removeClass('has-danger'); 
    $('.form-control').removeClass('form-control-danger');   
    $('.form-control-feedback').empty(); 
    
    $.ajax({
        url : "<?php echo site_url('customer/edit')?>/" + id_customer,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="nama"]').val(data.nama);
            $('[name="tempat_lahir"]').val(data.tempat_lahir);
            $('[name="tgl_lahir"]').val(data.tgl_lahir);
            $('[name="hp"]').val(data.hp);
            $('#modal_edit_form').modal('show'); 
            $('.modal-title').text('Edit Customer'); 

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
        url = "<?php echo site_url('customer/tambah')?>";
        pesan ="Simpan";
        form = '#form';
        modall = '#modal_form';
    } else {
        url = "<?php echo site_url('customer/update')?>";
        pesan ="Update";
        form = '#form_edit';
        modall = '#modal_edit_form';
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

function hapus(id_customer)
{
    swal({
        title:"Hapus Customer",
        text:"Yakin akan menghapus customer ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Hapus",
        closeOnConfirm: true,
    },
    function(){
        $.ajax({
            url : "<?php echo site_url('customer/delete')?>/"+id_customer,
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