<div id="content">
	<nav class="navbar navbar-toggleable-md navbar-light bg-light">
	  	<button type="button" id="sidebarCollapse" class="btn btn-light navbar-btn" style="padding: .5rem .5rem;">
	        <i class="fa fa-bars"></i>
	    </button>
	  	<div class="collapse navbar-collapse justify-content-end avatar" id="navbarNavDropdown">
	    	<ul class="navbar-nav">
	      		<span>Selamat Datang!, <?php echo $this->session->userdata('nama'); ?> </span>
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
				<li class="breadcrumb-item active"><a href="#"><i class="fa fa-tasks"></i> Info Berita</a></li>
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
              <th scope="col">Judul</th>
              <!--<th scope="col">Deskripsi</th>-->
              <th scope="col">Waktu Upload</th>
              <th scope="col">Gambar</th>
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
	        	  <input type="hidden" id="id_info" name="id_info">
	              <div class="form-group row">
                    <div class="col-sm-12">
    				    <label for="judul_info" class="col-form-label">Judul</label>
    				    <input type="text" name="judul_info" id="judul_info" class="form-control" placeholder="Judul" autofocus>
    				    <small class="form-control-feedback"></small>
                    </div>
				  </div>
         
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="deskripsi" class="col-form-label">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="3"></textarea>
                        <script type="text/javascript">tinymce.init({ selector : 'textarea', height : '250px', }); </script>
                        <small class="form-control-feedback"></small>
                    </div>
                </div>
                <div class="form-group row">
                        <label for="gambar" class="col-sm-3 col-form-label">Gambar</label>
                        <div class="col-sm-9">
                            <input type="file" name="gambar" id="gambar" class="form-control" placeholder="Gambar" >
                            <input type="text" name="tampilgambar" class="form-control" readonly disabled>
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
            "url": "<?php echo site_url('info/display')?>",
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
    $('#form')[0].reset(); 
    $('.form-group').removeClass('has-danger'); 
    $('.form-control').removeClass('form-control-danger');   
    $('.form-control-feedback').empty(); 
    $('#modal_form').modal('show'); 
    $('.modal-title').text('Tambah info'); 
}

function edit(id_info)
{
    save_method = 'update';
    $('#form')[0].reset(); 
    $('.form-group').removeClass('has-danger'); 
    $('.form-control').removeClass('form-control-danger');   
    $('.form-control-feedback').empty(); 
    
    $.ajax({
        url : "<?php echo site_url('info/edit')?>/" + id_info,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_info"]').val(data.id_info);
            $('[name="judul_info"]').val(data.judul_info);
            $('[name="tampilgambar"]').val(data.gambar);
            tinyMCE.get('deskripsi').setContent(data.deskripsi);
            $('#modal_form').modal('show'); 
            $('.modal-title').text('Edit info'); 

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
    tinyMCE.triggerSave();

    if(save_method == 'add') {
        url = "<?php echo site_url('info/tambah')?>";
        pesan ="Simpan";
        form = '#form';
        modall = '#modal_form';
    } else {
        url = "<?php echo site_url('info/update')?>";
        pesan ="Update";
        form = '#form';
        modall = '#modal_form';
    }

    var data = new FormData($(form)[0]);
    
    $.ajax({
        url : url,
        type: "POST",
        mimeType: "multipart/form-data",
        dataType: 'json',
        data: data,
        contentType: false,
        cache: false,
        processData: false,
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

function hapus(id_info)
{
    swal({
        title:"Hapus data info",
        text:"Yakin akan menghapus data info ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Hapus",
        closeOnConfirm: true,
    },
    function(){
        $.ajax({
            url : "<?php echo site_url('info/delete')?>/"+id_info,
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