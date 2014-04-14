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

						<div id="notif" class="peringatan">
							<?php echo form_error('title'); ?>
							<?php echo form_error('info'); ?>
							<?php echo form_error('url'); ?>
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
												<?php echo form_open(base_url('news/flash_news')); ?>
													<table style="width: 99%">
														<tbody>
															<tr>
																<td class="bella">Judul Konten</td>
																<td class="isi"><?php echo form_input(array('name'=>'title', 'class'=>'input-full', 'placeholder'=>'Judul Konten', 'value'=>$flash_id->title)); ?></td>
															</tr>
															<tr>
																<td class="bella">Isi Konten Cepat</td>
																<td class="isi"><?php echo form_textarea(array('name'=>'info', 'class'=>'textarea-full', 'placeholder'=>'isi Konten cepat', 'value'=>$flash_id->isi)); ?></td>
															</tr>
															<tr>
																<td class="bella">Link Konten</td>
																<td class="isi"><?php echo form_input(array('name'=>'url', 'class'=>'input-full', 'placeholder'=>'Link Konten', 'value'=>$flash_id->url)); ?></td>
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
											<h3>Konten Cepat</h3>
										</div>
										<div class="twin-isi">								
											<div class="isis">
												<h3><?php echo $flash_id->title; ?></h3>
												<p><?php echo $flash_id->isi; ?></p>
												<p><?php echo $flash_id->url; ?></p>
											</div>
										</div>
									</div>

								</div>

								<div class="clear"></div>

							</div>
						</div>

					</div>
				</div>