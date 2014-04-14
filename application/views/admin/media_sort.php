				<div id="content">
					<div class="content">
						<div class="judul">
							<h2>Dashboard</h2>
							<p>Selamat Datang di ngAdmin panel versi 1.0</p>
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

						<div class="editor1">
							<div class="sticky">
								<div class="close-btn"><a id="btnShowHide" href="javascript:toggle2('stickyShow','btnShowHide');" ><i class='icon-remove-sign icon-large'></i></a></div>
								<div class="clear"></div>
								<div id="stickyShow" style="display: block;" class="saksake">
									Untuk menggunakan media ini, silahkan copy URL yang ada didalam kotak dibawah gambar dan tambahkan ketempat sesuai kebutuhan.
								</div>
							</div>
						</div>

						<div class="editor">
							<div class="title">
								<h3><?php echo $title; ?></h3>
							</div>

							<div class="table-heading" style="border-bottom: 2px solid #ccc;">
								<div class="kiri form">
									<?php echo form_open_multipart('uploads/upload_media','','id="image-form" class="media-upload-form type-form validate html-uploader"'); ?>
										<?php echo form_label('Tambah File : ', 'add'); ?>
										<input type="file" name="userfile" class="input" id="async-upload" />
	        							<input type="submit" name="html-upload" id="html-upload" class="btn btn-info" value="Upload" />
        							<?php echo form_close(); ?>
								</div>
								<div class="kanan form">
									<?php echo form_open(base_url('media/sort_media')); ?>
										<select name="m" class="dropdown">
											<?php if(count($year_month)>0):?>
										        <?php foreach($year_month as $yr):?>
										            <option value="<?php echo $yr->year?>-<?php echo $yr->month;?>"><?php echo date("F",mktime(0,0,0,($yr->month)+1,0,0) ); ?>(<?php echo $yr->year;?>)</option>
										        <?php endforeach;?>
										    <?php endif;?>
										</select>
										<?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Filter')); ?>
        							<?php echo form_close(); ?>
								</div>
								<div class="clear"></div>
							</div>

								<?php
								if($media_all == "NULL"){
									echo '<div style="font-weight: bold; color: #333;padding:10px;">tidak ada galeri</div>';
								} else {
									?><div id="galeri"><?php
									foreach ($media_all as $media) {
										?>
										<div class="box">
											<img src="<?php echo base_url('assets/uploads/'.$media->file); ?>" alt="<?php echo $media->file; ?>">
											<div class="box-url">
												<?php echo form_textarea(array('name'=>'url', 'id'=>'holdtext', 'onClick'=>'this.focus();this.select();','readonly'=>'readonly', 'value'=>base_url('assets/uploads/'.$media->file))); ?>
											</div>
											<div class="box-action">
												<a class="btn btn-danger" href="<?php echo base_url('media/del_media/'.$media->id_attach.'/'.$media->file); ?>" onclick="return confirm('setuju dihapus?')"><i class="icon-trash" title="Hapus"></i></a>				
											</div>
										</div>
									<?php
									}
									?></div><?php
								}
								?>

							<!-- START GALERY FUNCTION -->
							<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-latest.js'); ?>"></script>
							<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.masonry.js'); ?>"></script>

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
							
						</div>
					</div>
				</div>