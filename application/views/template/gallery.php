		<!--KONTEN UTAMA MULAI-->
	<div id="bodi-background">
		<div class="content-left" style="margin-top:10px;">
			 <?php $this->load->view('template/sidebar'); ?>
			</div>
			 <div id="content">
			 	<div class="content-title">
			 		<h2><?php echo $title; ?></h2>
			 	</div>
			 	<?php
								if($gallery_all == "NULL"){
									echo 'tidak ada photo ditampilkan';
								} else {
									foreach ($gallery_all as $gallery) {
										?>
										<a href="<?php echo base_url('assets/gambar/galery/'.$gallery->file); ?>" rel="lightbox[roadtrip]">
										<div class="galeri-thumb">
											<img src="<?php echo base_url('assets/gambar/galery/'.$gallery->file); ?>" >
											<div class="galeri-caption">
												<p><?php echo $gallery->deskripsi; ?></p>
											</div>
										</div>
										</a>
										<?php
									}
								}	
								?>
		<div class="clear">
			 </div>
		</div>

		<!--KONTEN UTAMA SELESAI-->
		<div class="clear"></div>