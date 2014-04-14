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

						<div class="peringatan">
							<?php echo form_error('title'); ?>
							<?php echo form_error('elm1'); ?>
							<?php echo form_error('deskripsi'); ?>
							<?php echo form_error('keyword'); ?>
						</div>

						<div class="twin-wrapper">
							<div class="twinner">
								
								<div class="twin-container twin70 twin-awal">
									<div class="twin">	
										<div class="title">
											<h3>Edit Pages <?php echo $pages_id->title; ?></h3>
										</div>								
										
										<div class="twin-isi">
											<div class="isis">
												<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>
												<script type="text/javascript" src="<?php echo base_url()?>assets/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
												<script type="text/javascript" src="<?php echo base_url()?>assets/js/tiny_mce/tiny_mce.js"></script>
												<script type="text/javascript">
													var site_url = '<?php echo base_url();?>'
												</script>
												<script type="text/javascript" src="<?php echo base_url()?>assets/js/setting.tiny_mce.js"></script>

												<?php echo form_open(base_url('admin_pages/edit_pages'), array('id'=>'formPages')); ?>
													<?php echo form_hidden('id',$pages_id->idPages); ?>
													<table style="width: 100%">
														<tr>
															<td><?php echo form_label('Title Pages :', 'title'); ?></td>
														</tr>
														<tr>
															<td class="isi"><?php echo form_input(array('name'=>'title', 'class'=>'input-medium', 'value'=>$pages_id->title)); ?></td>
														</tr>
														<tr>
															<td><p>Upload/Insert
																<button id="setImage" class="btn"><i class="icon-picture"></i></button></p></td>
														</tr>
														<tr>
															<td class="isi"><?php echo form_textarea(array('name'=>'elm1', 'class'=>'mceEditor','value'=>$pages_id->post, 'id'=>'elm1')); ?></td>
														</tr>
													</table>				
											</div>
										</div>
									</div>
								</div>

								<div class="twin-container twin30 twin-akhir">
									<div class="twin">	
										<div class="title">
											<h3>SEO Form</h3>
										</div>								
										<div class="twin-isi">
											<div class="isis">
												<table style="width: 100%">
													<tr>
														<td><?php echo form_label('Jenis Halaman :', 'status'); ?></td>
													</tr>
													<tr>
														<td class="isi">
															<?php if($pages_id->status == "publik"): ?>
																<?php echo form_radio(array('name'=>'jenis', 'class'=>'radio', 'value'=>'publik', 'checked'=>TRUE,)); ?>Publik&nbsp;
															<?php echo form_radio(array('name'=>'jenis', 'class'=>'radio', 'value'=>'privat')); ?>Privat
															<?php else: ?>
																<?php echo form_radio(array('name'=>'jenis', 'class'=>'radio', 'value'=>'publik')); ?>Publish&nbsp;
																<?php echo form_radio(array('name'=>'jenis', 'class'=>'radio', 'value'=>'privat', 'checked'=>TRUE,)); ?>Privat
															<?php endif ?>
														</td>
													</tr>
													<tr>
														<td><?php echo form_label('Description Pages :', 'deskripsi'); ?></td>
													</tr>
													<tr>
														<td class="isi"><?php echo form_textarea(array('name'=>'deskripsi', 'class'=>'textarea-full', 'value'=>$pages_id->deskripsi)); ?></td>
													</tr>
													<tr>
														<td><?php echo form_label('Keyword Pages :', 'keyword'); ?></td>
													</tr>
													<tr>
														<td class="isi"><?php echo form_input(array('name'=>'keyword', 'class'=>'input-full', 'value'=>$pages_id->keyword)); ?></td>
													</tr>
													<tr>
														<td><?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Simpan')); ?></td>
													</tr>
												</table>
												<?php echo form_close(); ?>
											</div>
										</div>
									</div>
								</div>		

							</div>

							<div class="clear"></div>
						</div>
						
					</div>
				</div>