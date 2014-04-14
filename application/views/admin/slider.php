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
												<a href="<?php echo base_url('slider/') ?>" class="btn add-page btn-info">Tambah Slider</a>
											</div>
											<div class="kanan kotak-pagination">
												<?php //echo $this->pagination->create_links(); ?>
											</div>
											<div class="clear"></div>
										</div>							
										
										<div class="twin-isi">
											<div class="isis tabel">
												<table style="width: 100%">
													<thead>
														<tr>
															<td width="3%">No</td>
															<td width="40%">Preview</td>
															<td width="20%">Alternatif Text</td>
															<td width="10%" style="text-align:center">Aksi</td>
														</tr>
													</thead>
													<tbody>
													<?php
													if($slider_all == "NULL"){ ?>
														<tr>
															<td colspan="4">Data Belum Ada !!</td>
														</tr>
													<?php
													} else {
														$nomor=1;
														foreach ($slider_all as $slider) { ?>
															<tr>
																<td width="3%"><?php echo $nomor; ?></td>
																<td width="40%"><img style="width: 100%;" src="<?php echo base_url('assets/gambar/slider/'.$slider->filename); ?>"></td>
																<td width="20%"><?php echo $slider->alt; ?></td>
																<td width="10%" style="text-align:center">
																	<a style="color:#000" href="<?php echo base_url('slider/edit_slider/'.$slider->idSlider.'/'.$slider->filename); ?>" title="edit slider">
																		<i class="icon-edit icon-large"></i>
																	</a>&nbsp;
																	<a style="color:#ff0000" href="<?php echo base_url('slider/del_slider/'.$slider->idSlider.'/'.$slider->filename); ?>" title="hapus slider">
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
												<?php echo form_open_multipart(base_url('slider/add_slider')); ?>
													<table style="width: 100%">
														<tbody>
															<tr>
																<td class="bella">Gambar Slider</td>
																<td class="isi"><?php echo form_upload(array('name'=>'userfile', 'class'=>'input-full')); ?></td>
															</tr>
															<tr>
																<td class="bella">Title</td>
																<td class="isi"><?php echo form_input(array('name'=>'title', 'class'=>'input-full', 'placeholder'=>'Title slider')); ?></td>
															</tr>
															<tr>
																<td class="bella">URL</td>
																<td class="isi"><?php echo form_input(array('name'=>'url', 'class'=>'input-full', 'placeholder'=>'Url slider, gunakan http://...')); ?></td>
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