<!DOCTYPE html>
<html lang="en">
	<head>

		<title><?php echo $title; ?> | <?php echo $author; ?></title>
		<meta name="description" content="<?php echo $description; ?>">
	    <meta name="keywords" content="<?php echo $keyword; ?>">
	    <meta name="google-site-verification" content="tFsemqXgCvUR4LJK0pPZ-owCuiyC0aBLOgGeyq5j1IM" />
	    <link rel="stylesheet" href="<?php echo base_url('assets/template/themes/default/default.css'); ?>" type="text/css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/style.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/template/js/nivo-slider.css'); ?>" type="text/css" media="screen" />
		<link rel="shortcut icon" href="<?php echo base_url('assets/template/images/fav.png'); ?>" type="image/x-icon" />
		<script src="<?php echo base_url('assets/template/js/jquery-1.8.3.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/jquery.nivo.slider.js'); ?>" type="text/javascript"></script>

		<!--Galeri need-->
		<link rel="stylesheet" href="<?php echo base_url('assets/template/lightbox.css'); ?>">
		<script src="<?php echo base_url('assets/template/js/jquery.smooth-scroll.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/lightbox.js'); ?>"></script>
		<!--Galeri need-->
		
		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-40611586-1']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		
		</script>

	</head>

<body>
		<div id="wraper"> 
		<div id="header-bg">
			<div class="top-menu">
				<div class="menu-kiri">
					<?php 
					if($this->session->userdata('idFolower')){ ?>
						<a href="<?php echo base_url('member/logout'); ?>">Logout</a>
					<?php } else { ?>
						<a href="<?php echo base_url('member/login'); ?>">Login</a>
						|
						<a href="<?php echo base_url('member/registrasi'); ?>">Registrasi</a>
					<?php }
					echo $this->session->flashdata('flashOK'); ?>
				</div>
				<div class="menu-tengah">
				<?php
  $namahari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
  $namabulan = array("","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"); 
  echo $namahari[date("w")].", ".date("j")." ".$namabulan[date("n")]." ".date("Y");
?>
				</div>
				<div class="menu-kanan">
					<?php if($sosial->facebook){ ?><a href="<?php echo $sosial->facebook; ?>"><img src="<?php echo base_url('assets/template/images/facebook.png'); ?>" alt="facebook"></a><?php } ?>
					<?php if($sosial->twitter){ ?><a href="<?php echo $sosial->twitter; ?>"><img src="<?php echo base_url('assets/template/images/twitter.png'); ?>" alt="twitter"></a><?php } ?>
					<?php if($sosial->ym){ ?><a href="ymsgr:SendIM?<?php echo $sosial->ym; ?>"><img src="<?php echo base_url('assets/template/images/yahoo.png'); ?>" alt="yahoo"></a><?php } ?>
					<?php if($sosial->linkedin){ ?><a href="<?php echo $sosial->linkedin; ?>"><img src="<?php echo base_url('assets/template/images/linkedin.png'); ?>" alt="linkedin"></a><?php } ?>
					<?php if($sosial->flikr){ ?><a href="<?php echo $sosial->flikr; ?>"><img src="<?php echo base_url('assets/template/images/flickr.png'); ?>" alt="flikr"></a><?php } ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="box-logo">
			<div class="logo">
			<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url($setting->logo); ?>" alt="logo"></a>
			</div>
			<div class="clear"></div>
			<div class="name-logo">
			</div> 
			</div>
			

		</div>
		<div id="bodi-menu">
			
					
			<div class="menu-box">
				<div class="menu">
					<?php
                    if($gabul == "NULL"){
                        echo '<ul>
                        <li>
                        	<a href="">Menu belum tersedia</a>
                        </li>
                        	</ul>';
                    } else {
                        echo $gabul;
                    } ?>
				</div>
				<div class="search">
					<?php echo form_open(base_url('search/index')); ?>
						<?php echo form_input(array('name'=>'s', 'placeholder'=>'cari sesuatu...')); ?>
						<span class="img-box">
							<input type="image" style="width:9px;" alt="search" src="<?php echo base_url('assets/template/images/search.png'); ?>">
						</span>
						<div class="clear"></div>
					<?php echo form_close(); ?>
				</div>
				<div class="clear"></div>
			</div>
			
		</div>