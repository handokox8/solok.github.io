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
							<?php echo form_error('title'); ?>
							<?php echo form_error('link'); ?>
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
												<?php echo form_open(base_url('setting/link')); ?>
													<table style="width: 100%">
														<tbody>
															<tr>
																<td class="bella">Judul Link</td>
																<td class="isi"><?php echo form_input(array('name'=>'title', 'class'=>'input-full', 'placeholder'=>'judul link')); ?></td>
															</tr>
															<tr>
																<td class="bella">Link URL</td>
																<td class="isi"><?php echo form_input(array('name'=>'link', 'class'=>'input-full', 'placeholder'=>'link URL')); ?></td>
															</tr>
															<tr>
																<td colspan="2"><?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-info', 'value'=>'Simpan')) ?></td>
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
											<h3>Struktur Link</h3>
										</div>								
										<div class="twin-isi">
											<div class="isis label">
												<?php
												if($link_all == "NULL"){
													echo 'belum ada link ditambahkan';
												} else {
													$nomor=1;
													foreach ($link_all as $link) {
														$url = preg_replace("![^a-z0-9]+!i", "-", $link->title);
														?>
														<div id="menu-parent" style="width: 95%; margin-bottom: 5px; padding: 10px 20px; background: grey; color: #000; overflow: hidden; border-radius: 5px">
															<span class="kanan" style="float: left" title="<?php echo $link->url; ?>"><?php echo $nomor; ?>.&nbsp;&nbsp;<?php echo $link->title; ?></span>
															<span class="kiri" style="float: right"><a href="<?php echo base_url('setting/edit_link/'.$link->idLink.'/'.$url); ?>" style="color: #fff"><i class="icon-edit icon-large"></i></a>&nbsp;&nbsp;<a href="<?php echo base_url('setting/del_link/'.$link->idLink.'/'.$url); ?>" onclick="return confirm('setuju dihapus?')" style="color: #ff0000"><i class="icon-trash icon-large"></i></a></span>
														</div>
														<?php
													$nomor++;
													}
												}
												?>
											</div>
										</div>
									</div>
								</div>

							</div>

							<div class="clear"></div>
						</div>

					</div>
				</div>