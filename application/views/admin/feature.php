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

						<div id="notif" class="peringatan">
							<?php echo form_error('title'); ?>
							<?php echo form_error('url'); ?>
							<?php echo form_error('deskripsi'); ?>
						</div>

						<div class="twin-wrapper">
							<div class="twinner">
								<div class="twin-container twin70 twin-awal">
									<div class="twin">	
										<div class="title">
											<h3>Semua Slider</h3>
										</div>	

										<div class="table-heading">
											<div class="kiri sort">
												<a href="<?php echo base_url('feature/') ?>" class="btn add-page btn-info">Tambah Feature</a>
											</div>
											<div class="kanan kotak-pagination">
												<?php //echo $this->pagination->create_links(); ?>
											</div>
											<div class="clear"></div>
										</div>							
										
										<div class="twin-isi">
											<div class="isis tabel">
												<table style="width: 99%">
													<thead>
														<tr>
															<td width="3%">No</td>
															<td width="20%">Title Feature</td>
															<td width="20%">Deskripsi</td>
															<td width="20%" style="text-align: center">ikon</td>
															<td width="5%" style="text-align: center">Aksi</td>
														</tr>
													</thead>
													<tbody>
													<?php
													if($feature == "NULL"){ ?>
														<tr>
															<td colspan="4" style="text-align: center">Data Tidak Ada</td>
														</tr>
													<?php
													} else {
														$nomor=1;
														foreach ($feature as $feat) { ?>
															<tr>
																<td width="3%"><?php echo $nomor; ?></td>
																<td width="20%"><?php echo $feat->title; ?><br /><?php echo $feat->link; ?></td>
																<td width="20%"><?php echo substr($feat->deskripsi, 0,250).' ...'; ?></td>
																<td width="20%" style="text-align: center"><?php if($feat->icon == ""){ echo 'tidak ada ikon';} else { ?><img style="max-width: 100%" src="<?php echo base_url('assets/gambar/feature/'.$feat->icon); ?>"><?php } ?></td>
																<td width="5%" style="text-align: center">
																	<a style="color: #000" href="<?php echo base_url('feature/edit_feature/'.$feat->idFeature.'/'.$feat->title); ?>" title="ubah feature">
																		<i class="icon-edit icon-large"></i>
																	</a>&nbsp;
																	<a style="color: #ff0000" href="<?php echo base_url('feature/del_feature/'.$feat->idFeature.'/'.$feat->title); ?>" title="hapus feature">
																		<i class="icon-trash icon-large"></i>
																	</a>
																</td>
															</tr>
														<?php
														$nomor++;
														}
													}
													?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="twin-container twin30 twin-akhir">
									<div class="twin">	
										<div class="title">
											<h3><?php echo $title; ?></h3>
										</div>								
										<div class="twin-isi">
											<div class="isis">
												<?php echo form_open_multipart(base_url('feature/add_feature')); ?>
													<table style="width: 100%">
														<tbody>
															<tr>
																<td class="bella">Ikon</td>
																<td class="isi"><?php echo form_upload(array('name'=>'ikon', 'class'=>'input-full')); ?></td>
															</tr>
															<tr>
																<td class="bella">URL</td>
																<td class="isi"><?php echo form_input(array('name'=>'url', 'class'=>'input-full', 'placeholder'=>'URL feature')); ?></td>
															</tr>
															<tr>
																<td class="bella">Title</td>
																<td class="isi"><?php echo form_input(array('name'=>'title', 'class'=>'input-full', 'placeholder'=>'Title feature')); ?></td>
															</tr>
															<tr>
																<td class="bella">Deskripsi</td>
																<td class="isi"><?php echo form_textarea(array('name'=>'deskripsi', 'class'=>'textarea-full', 'placeholder'=>'deskripsi feature')); ?></td>
															</tr>
															<tr>
																<td colspan="2"><?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Simpan')) ?></td>
															</tr>
														</tbody>
													</table>
												<?php echo form_close(); ?>	
											</div>
										</div>
									</div>
								</div>

								<div class="clear"></div>

							</div>
						</div>

					</div>
				</div>