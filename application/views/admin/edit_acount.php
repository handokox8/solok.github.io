				<div id="content">
					<div class="content">
						<div class="judul" id="version_mbus">
							<h2>Dashboard</h2>
							<p>Selamat Datang di ngAdmin panel versi 1.0</p>
						</div>

						<?php if($this->session->flashdata('flashOK')): ?>
						<div id="notif" class="sukses">
							<p><i class="icon-ok icon-large"></i><?php echo $this->session->flashdata('flashOK'); ?></p>
						</div>
						<?php endif ?>
						<?php if($this->session->flashdata('flashNO')): ?>
						<div class="peringatan">
							<p><i class="icon-exclamation-sign icon-large"></i><?php echo $this->session->flashdata('flashNO'); ?></p>
						</div>
						<?php endif ?>

						<div class="peringatan">
							<?php echo form_error('facebook'); ?>
							<?php echo form_error('twitter'); ?>
							<?php echo form_error('ym'); ?>
							<?php echo form_error('linkedin'); ?>
							<?php echo form_error('flikr'); ?>
						</div>


						<div class="twin-wrapper">
							<div class="twinner">
								<div class="twin-container twin50 twin-awal">
									<div class="twin">	
										<div class="title">
											<h3>Ubah Sosial media akun</h3>
										</div>
										<div class="twin-isi">								
											<div class="isis">
												<?php echo form_open(base_url('sosial/setting_acount')); ?>
													<table style="width: 100%">
														<tr>
															<td class="bella">Facebook Acount</td>
															<td class="isi"><?php echo form_input(array('name'=>'facebook', 'class'=>'input-full', 'value'=>$setting_id->facebook)); ?></td>
														</tr>
														<tr>
															<td class="bella">&nbsp;</td>
															<td class="note">* contoh : https://www.facebook.com/hostingindonesia</td>
														</tr>
														<tr>
															<td class="bella">Twitter Acount</td>
															<td class="isi"><?php echo form_input(array('name'=>'twitter', 'class'=>'input-full', 'value'=>$setting_id->twitter)); ?></td>
														</tr>
														<tr>
															<td class="bella">&nbsp;</td>
															<td class="note">* contoh : https://www.twitter.com/jogjahost</td>
														</tr>
														<tr>
															<td class="bella">YM Acount</td>
															<td class="isi"><?php echo form_input(array('name'=>'ym', 'class'=>'input-full', 'value'=>$setting_id->ym)); ?></td>
														</tr>
														<tr>
															<td class="bella">&nbsp;</td>
															<td class="note">* contoh : jogjahost</td>
														</tr>
														<tr>
															<td class="bella">linkedin Acount</td>
															<td class="isi"><?php echo form_input(array('name'=>'linkedin', 'class'=>'input-full', 'value'=>$setting_id->linkedin)); ?></td>
														</tr>
														<tr>
															<td class="bella">&nbsp;</td>
															<td class="note">* contoh : http://www.linkedin.com/in/username</td>
														</tr>
														<tr>
															<td class="bella">flickr Acount</td>
															<td class="isi"><?php echo form_input(array('name'=>'flikr', 'class'=>'input-full', 'value'=>$setting_id->flikr)); ?></td>
														</tr>
														<tr>
															<td class="bella">&nbsp;</td>
															<td class="note">* contoh : http://www.flickr.com/people/userID/</td>
														</tr>
														<tr>
															<td colspan="2"><?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Simpan')) ?></td>
														</tr>
													</table>
												<?php echo form_close(); ?>
											</div>										
										</div>
									</div>
								</div>
								<div class="twin-container twin50 twin-akhir">
									<div class="twin">	
										<div class="title">
											<h3>Sosial Media Akun</h3>
										</div>
										<div class="twin-isi">								
											<ol>
												<?php if($setting_id->facebook): ?><li><?php echo 'Facebook : '.$setting_id->facebook; ?></li><?php endif ?>
												<?php if($setting_id->twitter): ?><li><?php echo 'Twitter : '.$setting_id->twitter; ?></li><?php endif ?>
												<?php if($setting_id->ym): ?><li><?php echo 'Yahoo : '.$setting_id->ym; ?></li><?php endif ?>
												<?php if($setting_id->linkedin): ?><li><?php echo 'Linkedin : '.$setting_id->linkedin; ?></li><?php endif ?>
												<?php if($setting_id->flikr): ?><li><?php echo 'Flickr : '.$setting_id->flikr; ?></li><?php endif ?>
											</ol>
											<div class="clear"></div>
										</div>
									</div>

								</div>

								<div class="clear"></div>
							</div>

							<div class="clear"></div>
						</div>

					</div>
				</div>