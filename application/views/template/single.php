		<!--KONTEN UTAMA MULAI-->


		
		<!--KONTEN UTAMA MULAI-->

	<div id="bodi-background">
		<div class="content-left" style="margin-top:10px;">
			 <?php $this->load->view('template/sidebar'); ?>
			</div>
			 <div id="content">
			 	<div class="content-title">
			 		<h2><?php echo $title; ?></h2>
			 	</div>
			 	<div class="content-isi">
			 		<?php if(isset($tanggal)) { ?>
			 		
			 		<div class="tanggal">
                                			<?php 
                                			$namahari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
                                			$tgl =$tanggal;
                                			$a=explode('-', $tgl);
                                			$tanggalgb = $a[2].'-'.$a[1].'-'.$a[0];

                                			echo $tanggalgb; ?>
                                			</div>
			 		
			 		<?php } else {  } ?>
					<?php echo $paragraf; ?>
			 	</div>
			 </div>
			 <div class="clear"></div>
		</div>
	<div class="clear">

		<!--KONTEN UTAMA SELESAI-->
		<div class="clear"></div>