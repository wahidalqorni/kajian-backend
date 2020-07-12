<nav id="sidebar">
    <div class="sidebar-header">
        <h4><mark style="background-color: #79B41D; border-radius: 5px 5px 5px 5px;">Kajian Sunnah</mark></h4>
    </div>
    <div class="sidebar-profil">
        <img src="<?php echo base_url('assets/images/logoGh.png') ?>"/>
        <span class="profil-text">
        <h5><?php echo $this->session->userdata('nama'); ?></h5>
        <b>Administrator</b>
        </span>
    </div>
    <ul class="list-unstyled components">
        <li class="<?php if ($isi == "layout/beranda") { echo "active"; } ?>">
            <a href="<?php echo base_url() ?>">
                <i class="fa fa-home"></i>
                Beranda
            </a>
        </li>
        <li class="<?php if ($isi == "petugas_view") { echo "active"; } ?>">
            <a href="<?php echo base_url('petugas/tampil') ?>">
                <i class="fa fa-user-circle"></i>
                Administrator
            </a>
        </li>
        <li>
            <a href="#demo" data-toggle="collapse"><i class="fa fa-globe"></i>Wilayah</a>
              <div id="demo" class="collapse" style="background:#6dcc79; ">
                <ul class="list-unstyled">
                    <li class="<?php if ($isi == "kota_view") { ; } ?>"><a href="<?php echo base_url('kota') ?>"><i class="fa fa-globe" aria-hidden="true"></i> Kota/Kab</a></li>
                    <li class="<?php if ($isi == "kecamatan_view") { ; } ?>"><a href="<?php echo base_url('kecamatan') ?>"><i class="fa fa-globe" aria-hidden="true"></i> Kecamatan</a></li>
                    <li class="<?php if ($isi == "kecamatan_view") { ; } ?>"><a href="<?php echo base_url('kelurahan') ?>"><i class="fa fa-globe" aria-hidden="true"></i> Kelurahan</a></li>
                </ul>
              </div>
        </li>
        <li class="<?php if ($isi == "user_view") { echo "active"; } ?>">
            <a href="<?php echo base_url('user/tampil') ?>">
                <i class="fa fa-users"></i>
                Jamaah
            </a>
        </li>
        <li class="<?php if ($isi == "ustad_view") { echo "active"; } ?>">
            <a href="<?php echo base_url('ustad') ?>">
                <i class="fa fa-male"></i>
                Data Ustad
            </a>
        </li>
        <li class="<?php if ($isi == "masjid_view") { echo "active"; } ?>">
            <a href="<?php echo base_url('masjid') ?>">
                <i class="fa fa-building"></i>
                Data Masjid
            </a>
        </li>
        <li class="<?php if ($isi == "slider_view") { echo "active"; } ?>">
            <a href="<?php echo base_url('slider') ?>">
                <i class="fa fa-circle"></i>
                Slider
            </a>
        </li>
         <li class="<?php if ($isi == "jeniskajian_view") { echo "active"; } ?>">
            <a href="<?php echo base_url('jeniskajian') ?>">
                <i class="fa fa-book"></i>
                Jenis Kajian
            </a>
        </li>
       <!-- <li>
            <a href="#demo2" data-toggle="collapse"><i class="fa fa-book"></i>Data Kajian</a>
              <div id="demo2" class="collapse" style="background:#6dcc79; ">
                <ul class="list-unstyled">
                    <li class="<?php if ($isi == "jeniskajian_view") { ; } ?>"><a href="<?php echo base_url('jeniskajian') ?>"><i class="fa fa-book" aria-hidden="true"></i> Jenis Kajian</a></li>
                    <li class="<?php if ($isi == "kajian_view") { ; } ?>"><a href="<?php echo base_url('kajian') ?>"><i class="fa fa-book" aria-hidden="true"></i> Kajian</a></li>
                </ul>
              </div>
        </li>-->
        <li>
            <a href="#demo3" data-toggle="collapse"><i class="fa fa-book"></i>Informasi</a>
                <div id="demo3" class="collapse" style="background:#6dcc79; ">
                    <ul class="list-unstyled">
                        <li class="<?php if ($isi == "video_view") { ; } ?>"><a href="<?php echo base_url('video') ?>"><i class="fa fa-camera" aria-hidden="true"></i> Video</a></li>
                        <li class="<?php if ($isi == "info_view") { ; } ?>"><a href="<?php echo base_url('info') ?>"><i class="fa fa-book" aria-hidden="true"></i> Info</a></li>
                        <li class="<?php if ($isi == "jadwal_view") { ; } ?>"><a href="<?php echo base_url('jadwal') ?>"><i class="fa fa-book" aria-hidden="true"></i> Jadwal Kajian</a></li>
                        <li class="<?php if ($isi == "kehadiran_view") { ; } ?>"><a href="<?php echo base_url('kehadiran') ?>"><i class="fa fa-book" aria-hidden="true"></i> Konfirmasi Kehadiran</a></li>
                    </ul>
                </div>
        </li>
        <li class="">
            <a href="<?php echo base_url('auth/logout') ?>">
                <i class="fa fa-sign-out"></i>
                Logout
            </a>
        </li>
    </ul>
</nav>