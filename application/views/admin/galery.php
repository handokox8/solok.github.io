				<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-latest.js'); ?>"></script>
				<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.masonry.js'); ?>"></script>
				
				<!-- START GALERY FUNCTION -->
							<script>

							  $(function(){
							    
							    $('#galeri').masonry({
							      itemSelector: '.box',
							      isAnimated: true,
								  animationOptions: {
								    duration: 750,
								    easing: 'linear',
								    queue: false
								  }
							    });

							    var $container = $('#galeri');

								$container.imagesLoaded( function(){
								  $container.masonry({
								    itemSelector : '.box'
								  });
								});

							  });

							</script>
				<!-- END GALERY FUNCTION -->
				<div id="content">
					<div class="content">
						<div class="judul">
							<h2>Dashboard</h2>
							<p>Welcome to admin panel version 0.1</p>
						</div>

						<?php if($this->session->flashdata('flashOK')): ?>
						<div id="notif" class="sukses">
							<p><i class="icon-ok icon-large"></i><?php echo $this->session->flashdata('flashOK'); ?></p>
						</div>
						<?php endif ?>
						<?php if($this->session->flashdata('flashNO')): ?>
						<div id="notif" class="peringatan">
							<p><i class="icon-exclamation-sign icon-large"></i><?php echo $this->session->flashdata('flashNO'); ?></p>
						</div>
						<?php endif ?>

						<?php if($this->session->flashdata('flashNOP')): ?>
						<div id="notif" class="peringatan">
							<?php echo $this->session->flashdata('flashNOP'); ?>
						</div>
						<?php endif ?>

						<div id="notif" class="peringatan">
							<?php echo form_error('title'); ?>
							<?php echo form_error('alt'); ?>
							<?php echo form_error('deskripsi'); ?>
						</div>

						

						<div class="editor">
							<div class="title">
								<h3><?php echo $title; ?></h3>
							</div>

							<div class="table-heading">
								<div class="kiri sort">
									<?php echo form_open(base_url('gallery/add_gallery')); ?>
										<button class="btn btn-info">Tambah Album</button>
									<?php echo form_close(); ?>
								</div>
								<div class="kanan form">
									<!--pagination space-->
									

											
									
								</div>
								<div class="clear"></div>
							</div>

							
								<?php
								if($album_all == "NULL"){
									echo '<div style="font-weight: bold; color: #333;padding:10px;">tidak ada album</div>';
								} else {
									?>
									<div id="galeri">
										<?php
									foreach ($album_all as $album) {
										?>
										<div class="box">
											<img src="<?php echo base_url('assets/gambar/galery/'.$album->file); ?>" alt="">
											<div class="box-url">
												<?php echo $album->title; ?>
											</div>
											<div class="box-action">
											<a href="<?php echo base_url('gallery/edit_album/'.$album->idAlbum.'/'.preg_replace("![^a-z0-9]+!i", "-", $album->title)); ?>" class="btn btn-success">Kelola Album</a>
											<a href="<?php echo base_url('gallery/del_album/'.$album->idAlbum.'/'.preg_replace("![^a-z0-9]+!i", "-", $album->title)); ?>" onClick="return confirm('setuju akan dihapus?')" class="btn btn-danger"><i class="icon-trash"></i></a>	
										
											</div>
										</div>
									<?php
									}
									?>
								</div>
									<?php
								}
								?>

								<div class="clear"></div>
							
						</div>
					</div>
				</div>