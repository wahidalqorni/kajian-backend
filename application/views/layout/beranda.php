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
				<li class="breadcrumb-item active"><a href="#"><i class="fa fa-home"></i> Beranda</a></li>
		</ol>
	</nav>
	
    <div class="container-fluid">
    <div class="jumbotron">
		<div class="foo">
		  <span class="letter" data-letter="S">S</span>
		  <span class="letter" data-letter="E">E</span>
		  <span class="letter" data-letter="L">L</span>
		  <span class="letter" data-letter="A">A</span>
		  <span class="letter" data-letter="M">M</span>
		  <span class="letter" data-letter="A">A</span>
		  <span class="letter" data-letter="T">T</span><br>
		  <span class="letter" data-letter="D">D</span>
		  <span class="letter" data-letter="A">A</span>
		  <span class="letter" data-letter="T">T</span>
		  <span class="letter" data-letter="A">A</span>
		  <span class="letter" data-letter="N">N</span>
		  <span class="letter" data-letter="G">G</span>
		</div>	 
	</div>
	</div>
</div>