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
							<?php echo form_error('url'); ?>
							<?php echo form_error('label'); ?>
						</div>

						<div class="twin-wrapper">
							<div class="twinner">
								<div class="twin-container twin50 twin-awal">
									<div class="twin">	
										<div class="title">
											<h3><?php echo $title; ?></h3>
										</div>
										<div class="twin-isi">								
											<div class="isis">
												<?php echo form_open_multipart(base_url('setting/save_banner')); ?>
													<table style="width: 99%">
														<tbody>
															<tr>
																<td class="bella">Judul Banner</td>
																<td class="isi"><?php echo form_input(array('name'=>'title', 'class'=>'input-full', 'value'=>$setting_id->titleBanner, 'placeholder'=>'judul banner')); ?></td>
															</tr>
															<tr>
																<td class="bella">Link Banner</td>
																<td class="isi"><?php echo form_input(array('name'=>'url', 'class'=>'input-full', 'value'=>$setting_id->linkBanner, 'placeholder'=>'URL banner')); ?></td>
															</tr>
															<tr>
																<td class="bella">&nbsp;</td>
																<td class="isi"><img style="width: max-width: 100%" src="<?php echo base_url($setting_id->banner); ?>" alt="" /></td>
															</tr>
															<tr>
																<td class="bella">Pilih Banner</td>
																<td class="isi"><?php echo form_upload(array('name'=>'userfile', 'class'=>'input-full')); ?></td>
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
							</div>
							<div class="clear"></div>
						</div>

					</div>
				</div>