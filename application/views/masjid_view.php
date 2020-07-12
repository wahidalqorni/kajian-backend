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
                <li class="breadcrumb-item active"><a href="#"><i class="fa fa-tasks"></i> Masjid
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
              <th scope="col">Nama Masjid</th>
              <th scope="col">Alamat</th>
              <th scope="col">Kota</th>
              <!--<th scope="col">Kecamatan</th>
              <th scope="col">Kelurahan</th>-->
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
<!-- form tambah/edit kecamatan -->
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
                <input type="hidden" id="id_masjid" name="id_masjid">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="nama_masjid" class="col-form-label">Nama Masjid</label>
                        <input type="text" name="nama_masjid" id="nama_masjid" class="form-control" placeholder="Nama Masjid">
                        <small class="form-control-feedback"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="alamat" class="col-form-label">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control"></textarea>
                        <small class="form-control-feedback"></small>
                    </div>
                </div> 
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="kota" class="col-form-label">Kota</label>
                        <select class="form-control" name="kota" id="kota">
                            <option value="">Pilih</option>
                            <?php
                            foreach($kota as $data){ 
                              echo "<option value='".$data->id_kota_kab."'>".$data->nama_kota_kab."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="kecamatan" class="col-form-label">Kecamatan</label>
                        <select class="form-control" name="kecamatan" id="kecamatan">
                            <option value="">Pilih</option>
                        </select>
                        <div id="loading" style="margin-top: 15px;">
                            <img src="<?php echo base_url('assets/images/loading.gif') ;?>" width="18"> <small>Loading...</small>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="kelurahan" class="col-form-label">Kelurahan</label>
                        <select class="form-control" name="kelurahan" id="kelurahan">
                            <option value="">Pilih</option>
                        </select>
                        <div id="loading2" style="margin-top: 15px;">
                            <img src="<?php echo base_url('assets/images/loading.gif') ;?>" width="18"> <small>Loading...</small>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="longitude" class="col-form-label">Longitude </label>
                        <input type="text" name="longitude" id="longitude" class="form-control" placeholder="Longitude">
                        <small class="form-control-feedback"></small>
                    </div>
                    <div class="col-sm-6">
                        <label for="latitude" class="col-form-label">Latitude </label>
                        <input type="text" name="latitude" id="latitude" class="form-control" placeholder="Latitude">
                        <small class="form-control-feedback"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <a href="https://www.latlong.net/" target="_blank" style="color: #3C72ED"><small>Klik di sini untuk mengambil titik koordinat Longitutde dan Latitude</small></a>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="deskripsi" class="col-form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control"></textarea>
                        <small class="form-control-feedback"></small>
                    </div>
                    <div class="col-sm-6">
                        <label for="gambar" class="col-sm-3 col-form-label">Gambar</label>
                        <label class="custom-file" style="width:100%;">
                            <input type="file" name="gambar" id="gambar" class="form-control" placeholder="Gambar" >
                            <input type="text" name="tampilgambar" class="form-control" readonly disabled>
                        </label>
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
            "url": "<?php echo site_url('masjid/display')?>",//'kelurahan'=class, 
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

    //combobox
    $("#loading").hide();
    
    $("#kota").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#kecamatan").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading").show(); // Tampilkan loadingnya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url('index.php/masjid/listKecamatan'); ?>", // Isi dengan url/path file php yang dituju
        data: {id_kota : $("#kota").val()}, // data yang akan dikirim ke file yang dituju
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){ // Ketika proses pengiriman berhasil
          $("#loading").hide(); // Sembunyikan loadingnya
          // set isi dari combobox kecamatan
          // lalu munculkan kembali combobox kecamatannya
          $("#kecamatan").html(response.list_kecamatan).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });
    //akhir combobox
    
    //combobox2
    $("#loading2").hide();
    
    $("#kecamatan").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#kelurahan").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading2").show(); // Tampilkan loadingnya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url('index.php/masjid/listKelurahan'); ?>", // Isi dengan url/path file php yang dituju
        data: {id_kecamatan : $("#kecamatan").val()}, // data yang akan dikirim ke file yang dituju
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){ // Ketika proses pengiriman berhasil
          $("#loading2").hide(); // Sembunyikan loadingnya
          // set isi dari combobox kecamatan
          // lalu munculkan kembali combobox kecamatannya
          $("#kelurahan").html(response.list_kelurahan).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });
    //akhir combobox2
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
    $('.modal-title').text('Tambah Data Masjid'); //mengisi title pada form modal tambah
}

function edit(id_masjid)
{
    save_method = 'update';
    $('#form')[0].reset(); 
    $('.form-group').removeClass('has-danger'); 
    $('.form-control').removeClass('form-control-danger');   
    $('.form-control-feedback').empty(); 
    
    $.ajax({
        url : "<?php echo site_url('masjid/edit')?>/" + id_masjid,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_masjid"]').val(data.id_masjid);
            $('[name="nama_masjid"]').val(data.nama_masjid);
            $('[name="alamat"]').val(data.alamat);
            $('[name="kota"]').val(data.id_kota_kab);
            $('[name="kecamatan"]').val(data.id_kecamatan);
            $('[name="kelurahan"]').val(data.id_kelurahan);
            $('[name="longitude"]').val(data.longitude);
            $('[name="latitude"]').val(data.latitude);
            $('[name="deskripsi"]').val(data.deskripsi);
            $('[name="tampilgambar"]').val(data.gambar);
            $('#modal_form').modal('show'); 
            $('.modal-title').text('Edit Data Masjid'); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function detail(id_masjid)
{
    //save_method = 'update';
    $('#formdetail')[0].reset(); 
    $('.form-group').removeClass('has-danger'); 
    $('.form-control').removeClass('form-control-danger');   
    $('.form-control-feedback').empty(); 
    
    $.ajax({
        url : "<?php echo site_url('masjid/detail')?>/" + id_masjid,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_masjid"]').val(data.id_masjid);
            $('[name="nama_masjid"]').val(data.nama_masjid);
            $('[name="alamat"]').val(data.alamat);
            $('[name="kota"]').val(data.nama_kota_kab);
            $('[name="kecamatan"]').val(data.id_kecamatan);
            $('[name="kelurahan"]').val(data.id_kelurahan);
            $('[name="deskripsi"]').val(data.deskripsi);
            $('#modal_form_detail').modal('show'); 
            $('.modal-title').text('Detail'); 

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
        url = "<?php echo site_url('masjid/tambah')?>";//'kecamatan'=class, 'tambah'=fungsi
        pesan ="Simpan";
        form = '#form';
        modall = '#modal_form';
    } else {
        url = "<?php echo site_url('masjid/update')?>";
        pesan ="Update";
        form = '#form';
        modall = '#modal_form';
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
//muncul form hapus konfirmasi
function hapus(id_masjid)
{
    swal({
        title:"Hapus Masjid",
        text:"Yakin akan menghapus Masjid ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya",
        closeOnConfirm: true,
    },
    function(){
        $.ajax({
            url : "<?php echo site_url('masjid/delete')?>/"+id_masjid,
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