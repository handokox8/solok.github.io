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
							<?php echo $this->session->flashdata('flashNO'); ?>
						</div>
						<?php endif ?>

						<div class="peringatan">
							<?php echo form_error('title'); ?>
							<?php echo form_error('email'); ?>
							<?php echo form_error('address'); ?>
							<?php echo form_error('contact'); ?>
							<?php echo form_error('description'); ?>
							<?php echo form_error('keyword'); ?>
						</div>

						<div class="twin-wrapper">
							<div class="twinner">
								<div class="twin-container twin70 twin-awal">
									<div class="twin">	
										<div class="title">
											<h3><?php echo $title; ?></h3>
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

												<?php echo form_open_multipart(base_url('contact/edit_contact')); ?>
												<?php echo form_hidden(array('name'=>'url', 'value'=>$info->maps)); ?>

													<table style="width: 100%">
														<tr>
															<td colspan="2">Title Kontak</td>
														</tr>
														<tr>
															<td colspan="2"><?php echo form_input(array('name'=>'title', 'class'=>'input-medium', 'value'=>$pages_id->title, 'placeholder'=>'Nama pengguna')); ?></td>
														</tr>
														<tr>
															<td class="isi" colspan="2"><?php echo form_textarea(array('name'=>'elm1', 'class'=>'mceEditor', 'value'=>$pages_id->post, 'id'=>'elm1')); ?></td>
														</tr>
													</table>				
											</div>
										</div>
									</div>
								</div>

								<div class="twin-container twin30 twin-akhir">
									<div class="twin">	
										<div class="title">
											<h3>Informasi Kontak</h3>
										</div>								
										<div class="twin-isi">
											<div class="isis">
												<table style="width: 100%">
													<tr>
														<td>
															<div class="image" style="max-width: 100%; height: 150px; background: url(<?php echo base_url('assets/gambar/maps/'.$info->maps); ?>) no-repeat"></div>
														</td>
													</tr>
													<tr>
														<td class="bella">Maps</td>
													</tr>
													<tr>
														<td class="isi"><?php echo form_upload(array('name'=>'userfile', 'class'=>'input-full')); ?></td>
													</tr>
													<tr>
														<td class="bella">E-mail</td>
													</tr>
													<tr>
														<td class="isi"><?php echo form_input(array('name'=>'email', 'class'=>'input-full', 'value'=>$info->email, 'placeholder'=>'E-mail')); ?></td>
													</tr>
													<tr>
														<td class="bella">Alamat</td>
													</tr>
													<tr>
														<td class="isi"><?php echo form_textarea(array('name'=>'address', 'class'=>'textarea-full', 'value'=>$info->address, 'placeholder'=>'Alamat Perusahaan')); ?></td>
													</tr>
													<tr>
														<td class="bella">No. Telp/No. HP</td>
													</tr>
													<tr>
														<td class="isi"><?php echo form_input(array('name'=>'contact', 'class'=>'input-full', 'value'=>$info->contact, 'placeholder'=>'No. Telp/No. HP')); ?></td>
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
														<td><?php echo form_label('Description Pages :', 'deskripsi'); ?></td>
													</tr>
													<tr>
														<td class="isi"><?php echo form_textarea(array('name'=>'description', 'class'=>'textarea-full', 'value'=>$pages_id->deskripsi, 'placeholder'=>'Deskripsi Kontak')); ?></td>
													</tr>
													<tr>
														<td><?php echo form_label('Keyword Pages :', 'keyword'); ?></td>
													</tr>
													<tr>
														<td class="isi"><?php echo form_input(array('name'=>'keyword', 'class'=>'input-full', 'value'=>$pages_id->keyword, 'placeholder'=>'Kata Kunci Kontak, pisahkan dengan tanda \' , \'')); ?></td>
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