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
							<?php echo form_error('deskripsi'); ?>
							<?php echo form_error('keyword'); ?>
						</div>

						<div class="twin-wrapper">
							<div class="twinner">
								<div class="twin-container twin50 twin-awal">
									<div class="twin">	
										<div class="title">
											<h3>Ubah informasi website</h3>
										</div>
										<div class="twin-isi">								
											<div class="isis">
												<?php echo form_open(base_url('admin_info/edit_info')); ?>
													<table style="width: 99%">
														<tbody>
															<tr>
																<td class="bella">Title Website</td>
																<td class="isi"><?php echo form_input(array('name'=>'title', 'class'=>'input-full', 'value'=>$info_id->title, 'placeholder'=>'Nama pengguna')); ?></td>
															</tr>
															<tr>
																<td class="bella">Deskripsi Website</td>
																<td class="isi"><?php echo form_textarea(array('name'=>'deskripsi', 'class'=>'textarea-full', 'value'=>$info_id->deskripsi, 'placeholder'=>'Nama lengkap')); ?></td>
															</tr>
															<tr>
																<td class="bella">Kata Kunci Website</td>
																<td class="isi"><?php echo form_input(array('name'=>'keyword', 'class'=>'input-full', 'value'=>$info_id->keyword, 'placeholder'=>'Alamat')); ?></td>
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
								<div class="twin-container twin50 twin-akhir">
									<div class="twin">	
										<div class="title">
											<h3><?php echo $title; ?></h3>
										</div>
										<div class="twin-isi">								
											<div class="isis definisi">
												<table>
													<tbody>
														<tr>
															<td class="bella">Title Website</td>
															<td class="isi"><?php echo $info_id->title; ?></td>
														</tr>
														<tr>
															<td class="bella">Deskripsi Website</td>
															<td class="isi"><?php echo $info_id->deskripsi; ?></td>
														</tr>
														<tr>
															<td class="bella">Kata Kunci Website</td>
															<td class="isi"><?php echo $info_id->keyword; ?></td>
														</tr>
													</tbody>
												</table>	
											</div>
										</div>
									</div>

								</div>

								<div class="clear"></div>
							</div>

							<div class="clear"></div>
						</div>

					</div>
				</div>