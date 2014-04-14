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

						<div id="notif" class="peringatan">
							<?php echo form_error('label'); ?>
						</div>

						<div class="twin-wrapper">
							<div class="twinner">
								<div class="twin-container twin30 twin-awal">
									<div class="twin">	
										<div class="title">
											<h3><?php echo $title; ?></h3>
										</div>								
										
										<div class="twin-isi">
											<div class="isis">
												<?php echo form_open(base_url('label/edit_label/'.$label_id->idLabel.'/'.$label_id->label)); ?>
													<?php echo form_hidden(array('name'=>'kdLabel', 'value'=>$label_id->idLabel)); ?>
													<table style="width: 100%">
														<tbody>
															<tr>
																<td class="bella">Label</td>
																<td class="isi"><?php echo form_input(array('name'=>'label', 'class'=>'input-full', 'value'=>$label_id->label, 'placeholder'=>'Label baru')); ?></td>
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
								<div class="twin-container twin70 twin-akhir">
									<div class="twin">	
										<div class="title">
											<h3>Sampel SEO Form</h3>
										</div>								
										<div class="twin-isi">
											<div class="isis label">
												<?php
												if($label_all == 'NULL'){
													echo 'belum ada label';
												} else {
													?><ul><?php
													foreach ($label_all as $labels) { ?>
														<li><?php echo $labels->label; ?>
															
															<span>
																<a href="<?php echo base_url('label/edit_label/'.$labels->idLabel.'/'.$labels->label); ?>"><i class="icon-edit icon-large"></i></a>
																<a href="<?php echo base_url('label/del_label/'.$labels->idLabel.'/'.$labels->label); ?>" onclick="return confirm('setuju dihapus?')" style="color:#ff0000;"><i class="icon-trash icon-large"></i></a>
															</span>
															
														</li>
													<?php
													}
													?></ul><?php
												}
												?>

												<div class="clear"></div>
											</div>
										</div>
									</div>
								</div>

							</div>

							<div class="clear"></div>
						</div>

					</div>
				</div>