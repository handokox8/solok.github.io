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
							<?php echo form_error('nama'); ?>
							<?php echo form_error('detail'); ?>
						</div>

						<div class="twin-wrapper">
							<div class="twinner">
								<div class="twin-container twin70 twin-awal">
									<div class="twin">	
										<div class="title">
											<h3>Semua Klien</h3>
										</div>

										<div class="table-heading">
											<div class="kiri sort">
												<a href="<?php echo base_url('client/') ?>" class="btn add-page btn-info">Tambah Klien</a>
											</div>
											<div class="kanan kotak-pagination">
												<?php //echo $this->pagination->create_links(); ?>
											</div>
											<div class="clear"></div>
										</div>							
										
										<div class="twin-isi">
											<div class="isis">
												<table style="width: 99%">
													<thead>
														<tr>
															<td width="3%">No</td>
															<td width="20%">Nama Klien</td>
															<td width="20%">Detail</td>
															<td width="20%" style="text-align: center">Logo</td>
															<td width="5%" style="text-align: center">Aksi</td>
														</tr>
													</thead>
													<tbody>
													<?php
													if($client_all == "NULL"){ ?>
														<tr>
															<td colspan="5" style="text-align: center">Data Tidak Ada</td>
														</tr>
													<?php
													} else {
														$nomor=1;
														foreach ($client_all as $client) { ?>
															<tr>
																<td width="3%"><?php echo $nomor; ?></td>
																<td width="20%"><?php echo $client->namaClient ?></td>
																<td width="20%"><?php echo strip_tags($client->detail); ?></td>
																<td width="20%" style="text-align: center"><img src="<?php echo base_url('assets/gambar/client/'.$client->image); ?>" alt="<?php echo $client->image; ?>"></td>
																<td width="5%" style="text-align: center">
																	<a style="color: #000" href="<?php echo base_url('client/edit_client/'.$client->idClient.'/'.preg_replace("![^a-z0-9]+!i", "-", $client->namaClient)); ?>" title="ubah klien">
																		<i class="icon-edit icon-large"></i>
																	</a>&nbsp;
																	<a style="color: #ff0000" href="<?php echo base_url('client/del_client/'.$client->idClient.'/'.preg_replace("![^a-z0-9]+!i", "-", $client->namaClient)); ?>" onclick="return confirm('setuju dihapus?')" title="hapus klien">
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
												<?php echo form_open_multipart(base_url('client/edit_client')); ?>
													<?php echo form_hidden('kdClient', $client_id->idClient); ?>
													<?php echo form_hidden('kdTitle', $this->uri->segment(4)); ?>
													<?php echo form_hidden('kdImage', $client_id->image); ?>
													<table style="width: 100%">
														<tbody>
															<tr>
																<td class="bella">Nama Klien</td>
																<td class="isi"><?php echo form_input(array('name'=>'nama', 'class'=>'input-full', 'placeholder'=>'Nama klien', 'value'=>$client_id->namaClient)); ?></td>
															</tr>
															<tr>
																<td class="bella">Rincian</td>
																<td class="isi"><?php echo form_textarea(array('name'=>'detail', 'class'=>'textarea-full', 'placeholder'=>'Rincian klien', 'value'=>$client_id->detail)); ?></td>
															</tr>
															<tr>
																<td class="bella">&nbsp;</td>
																<td class="isi"><img src="<?php echo base_url('assets/gambar/client/'.$client_id->image) ?>" alt="<?php echo $client_id->image; ?>" style="max-width: 100%"></td>
															</tr>
															<tr>
																<td class="bella">Logo</td>
																<td class="isi"><?php echo form_upload(array('name'=>'logo', 'class'=>'input-full')); ?></td>
															</tr>
															<tr>
																<td colspan="2"><?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Simpan')); ?></td>
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