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
				<li class="breadcrumb-item active"><a href="#"><i class="fa fa-jadwals"></i> Jadwal Kajian</a></li>
		</ol>
	</nav>
	
    <div class="container-fluid">
    <div class="jumbotron">
    	<div class="header-table">
	    	<button class="btn btn-outline-primary" onclick="tambah()">TAMBAH</button>
			<button class="btn btn-outline-success" onclick="reload_table()">REFRESH</button>
		</div>
		<table class="table display nowrap" id="table" cellspacing="0" width="100%">
		  <thead class="thead-light">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Judul Kajian</th>
		      <th scope="col">Jenis Kajian</th>
		      <th scope="col">Masjid</th>
		      <th scope="col">Ustad</th>
		      <th scope="col">Waktu Kajian</th>
		      <th scope="col">Kelompok</th>
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
	        	<div class="form-group row">
				    <label for="judul_kajian" class="col-sm-3 col-form-label">Judul Kajian</label>
				    <div class="col-sm-9">
				    	<input type="text" name="judul_kajian" id="judul_kajian" class="form-control" placeholder="Judul Kajian" maxlength="500">
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="jenis_kajian" class="col-sm-3 col-form-label">Jenis Kajian</label>
				    <div class="col-sm-9">
				    	<select class="form-control" name="jenis_kajian" id="jenis_kajian">
                            <option value="">--Pilih--</option>
                            <?php
                            foreach($jeniskajian as $data){ 
                              echo "<option value='".$data->id_jenis_kajian."'>".$data->jenis_kajian."</option>";
                            }
                            ?>
                        </select>
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div>  
				  <div class="form-group row">
				    <label for="masjid" class="col-sm-3 col-form-label">Masjid</label>
				    <div class="col-sm-9">
				    	<select class="form-control" name="masjid" id="masjid">
                            <option value="">--Pilih--</option>
                            <?php
                            foreach($masjid as $data){ 
                              echo "<option value='".$data->id_masjid."'>".$data->nama_masjid."</option>";
                            }
                            ?>
                        </select>
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="ustad" class="col-sm-3 col-form-label">Ustad</label>
				    <div class="col-sm-9">
				    	<select class="form-control" name="ustad" id="ustad">
                            <option value="">--Pilih--</option>
                            <?php
                            foreach($ustad as $data){ 
                              echo "<option value='".$data->id_ustad."'>".$data->nama_ustad."</option>";
                            }
                            ?>
                        </select>
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div> 
	              <div class="form-group row">
				    <label for="waktu_kajian" class="col-sm-3 col-form-label">Waktu Kajian</label>
				    <div class="col-sm-9">
				    	<input type="text" name="waktu_kajian" id="waktu_kajian" class="form-control datepicker" placeholder="Waktu Kajian">
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div>
				  <div class="form-group row">
                <label for="bada" class="col-sm-3 col-form-label">Ba'da</label>
                <div class="col-sm-9">
                    <select name="bada" id="bada" class="form-control">
                        <option value="">--Pilih--</option>
                        <option value="Shubuh">Shubuh</option>
                        <option value="Zuhur">Zuhur</option>
                        <option value="Asar">Asar</option>
                        <option value="Maghrib">Maghrib</option>
                        <option value="Isya">Isya</option>
                    </select>
                    <small style="color:#659bf2"><strong>Atau isi jika waktu kajian Ba'da Waktu Sholat</strong></small>
                    <small class="form-control-feedback"></small>
                </div>
                </div>
				  <div class="form-group row">
				    <label for="waktu_kajian" class="col-sm-3 col-form-label">Deskripsi</label>
				    <div class="col-sm-9">
				    	<textarea class="form-control" name="deskripsi" rows="10"></textarea>
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="kelompok" class="col-sm-3 col-form-label">Kelompok</label>
				    <div class="col-sm-9">
				    	<select name="kelompok" class="form-control" id="kelompok">
				    		<option value="">--Pilih--</option>
				    		<option value="akhwat">Akhwat</option>
							<option value="ikhwan">Ikhwan</option>
							<option value="umum">Umum</option>
				    	</select>
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div> 
			   <div class="form-group row">
                    <label for="gambar" class="col-sm-3 col-form-label">Gambar</label>
                    <div class="col-sm-9">
                        <input type="file" name="gambar" id="gambar" class="form-control" placeholder="Gambar" >
                    </div>
              </div>
              <div class="form-group row">
			    <label for="url_video" class="col-sm-3 col-form-label">URL Video</label>
			    <div class="col-sm-9">
			    	<input type="text" name="url_video" id="url_video" class="form-control" placeholder="URL Video Streaming"><small style="color:#659bf2"><strong>Isi jika mengadakan Live Streaming via Facebook/Youtube</strong></small>
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
	<div class="modal-dialog modal-lg" role="document" style="overflow-y: initial !important">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" style="height: 400px; overflow-y: scroll;">
	        <form action="#" id="form_edit" class="form-horizontal">
	              <input type="hidden" name="id_jadwal" id="id_jadwal">
				  <div class="form-group row">
				    <label for="judul_kajian" class="col-sm-3 col-form-label">Judul Kajian</label>
				    <div class="col-sm-9">
				    	<input type="text" name="judul_kajian" id="judul_kajian" class="form-control" placeholder="Judul Kajian">
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="jenis_kajian" class="col-sm-3 col-form-label">Jenis Kajian</label>
				    <div class="col-sm-9">
				    	<select class="form-control" name="jenis_kajian" id="jenis_kajian">
                            <option value="">--Pilih--</option>
                            <?php
                            foreach($jeniskajian as $data){ 
                              echo "<option value='".$data->id_jenis_kajian."'>".$data->jenis_kajian."</option>";
                            }
                            ?>
                        </select>
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div>  
				  <div class="form-group row">
				    <label for="masjid" class="col-sm-3 col-form-label">Masjid</label>
				    <div class="col-sm-9">
				    	<select class="form-control" name="masjid" id="masjid">
                            <option value="">--Pilih--</option>
                            <?php
                            foreach($masjid as $data){ 
                              echo "<option value='".$data->id_masjid."'>".$data->nama_masjid."</option>";
                            }
                            ?>
                        </select>
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="ustad" class="col-sm-3 col-form-label">Ustad</label>
				    <div class="col-sm-9">
				    	<select class="form-control" name="ustad" id="ustad">
                            <option value="">--Pilih--</option>
                            <?php
                            foreach($ustad as $data){ 
                              echo "<option value='".$data->id_ustad."'>".$data->nama_ustad."</option>";
                            }
                            ?>
                        </select>
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div> 
	              <div class="form-group row">
				    <label for="waktu_kajian" class="col-sm-3 col-form-label">Waktu Kajian</label>
				    <div class="col-sm-9">
				    	<input type="text" name="waktu_kajian" id="waktu_kajian" class="form-control datepicker" placeholder="Waktu Kajian">
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div>
				  <div class="form-group row">
                <label for="bada" class="col-sm-3 col-form-label">Ba'da</label>
                <div class="col-sm-9">
                    <select name="bada" id="bada" class="form-control">
                        <option value="">--Pilih--</option>
                        <option value="Shubuh">Shubuh</option>
                        <option value="Zuhur">Zuhur</option>
                        <option value="Asar">Asar</option>
                        <option value="Maghrib">Maghrib</option>
                        <option value="Isya">Isya</option>
                    </select>
                    <small style="color:#659bf2"><strong>Atau isi jika waktu kajian Ba'da Waktu Sholat</strong></small>
                    <small class="form-control-feedback"></small>
                </div>
                </div>
				  <div class="form-group row">
				    <label for="waktu_kajian" class="col-sm-3 col-form-label">Deskripsi</label>
				    <div class="col-sm-9">
				    	<textarea class="form-control" name="deskripsi" rows="10"></textarea>
				    	<small class="form-control-feedback"></small>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="kelompok" class="col-sm-3 col-form-label">Kelompok</label>
				    <div class="col-sm-9">
				    	<select name="kelompok" class="form-control" id="kelompok">
				    		<option value="">--Pilih--</option>
				    		<option value="akhwat">Akhwat</option>
							<option value="ikhwan">Ikhwan</option>
							<option value="umum">Umum</option>
				    	</select>
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
                <div class="form-group row">
			    <label for="url_video" class="col-sm-3 col-form-label">URL Video</label>
			    <div class="col-sm-9">
			    	<input type="text" name="url_video" id="url_video" class="form-control" placeholder="URL Video Streaming"><small style="color:#659bf2"><strong>Isi jika mengadakan Live Streaming via Facebook/Youtube</strong></small>
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
        //"scrollY": 200,
        "scrollX": true,
        "order": [], 
        "aLengthMenu": [[10, 25, 50, 100, 250, 500, 1000, 2000], [10, 25, 50, 100, 250, 500, 1000, 2000]],
        "pageLength": 10,
        "language": {
            "zeroRecords": "Data Tidak Ditemukan",
        },
        
        "ajax": {
            "url": "<?php echo site_url('jadwal/display')?>",
            "type": "POST"
        },

        
        "columnDefs": [
        { 
            "targets": [ 0, 1, 4, 5 ], 
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

$('.datepicker').datetimepicker({
        format: 'dd-mm-yyyy hh:ii',
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left",
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
    $('.modal-title').text('Tambah jadwal'); 
}

function edit(id_jadwal)
{
    save_method = 'update';
    $('#form')[0].reset(); 
    $('.form-group').removeClass('has-danger'); 
    $('.form-control').removeClass('form-control-danger');   
    $('.form-control-feedback').empty(); 
    
    $.ajax({
        url : "<?php echo site_url('jadwal/edit')?>/" + id_jadwal,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
        	$('[name="id_jadwal"]').val(data.id_jadwal);
            $('[name="judul_kajian"]').val(data.judul_kajian);
            $('[name="jenis_kajian"]').val(data.id_jenis_kajian);
            $('[name="masjid"]').val(data.id_masjid);
            $('[name="ustad"]').val(data.id_ustad);
            var currentTime = new Date(data.waktu_kajian);
	        var month = currentTime.getMonth() + 1;
	        var day = currentTime.getDate();
	        var year = currentTime.getFullYear();
	        var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
	        $('[name="waktu_kajian"]').val(day + "-" + month + "-" + year+" "+hours+":"+minutes);
	        $('[name="bada"]').val(data.bada);
	        $('[name="deskripsi"]').val(data.deskripsi_kajian);
	        $('[name="tampilgambar"]').val(data.gambar);
            $('[name="kelompok"]').val(data.kelompok);
            $('[name="url_video"]').val(data.video_url);
            $('#modal_edit_form').modal('show'); 
            $('.modal-title').text('Edit jadwal'); 

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
        url = "<?php echo site_url('jadwal/tambah')?>";
        pesan ="Simpan";
        form = '#form';
        modall = '#modal_form';
    } else {
        url = "<?php echo site_url('jadwal/update')?>";
        pesan ="Update";
        form = '#form_edit';
        modall = '#modal_edit_form';
    }

    
   var data = new FormData($(form)[0]);
    
    $.ajax({
        url : url,
        type: "POST",
        data: data,
        mimeType: "multipart/form-data",
        dataType: "JSON",
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

function hapus(id_jadwal)
{
    swal({
        title:"Hapus jadwal",
        text:"Yakin akan menghapus jadwal ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Hapus",
        closeOnConfirm: true,
    },
    function(){
        $.ajax({
            url : "<?php echo site_url('jadwal/delete')?>/"+id_jadwal,
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