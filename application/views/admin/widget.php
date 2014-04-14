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
							<?php echo form_error('widget'); ?>
							<?php echo form_error('sort'); ?>
							<?php echo form_error('position'); ?>
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
												<?php echo form_open(base_url('widget/save_widget')); ?>
												<table style="width: 100%">
													<tbody>
														<tr>
															<td class="bella">Title Widget</td>
															<td class="isi"><?php echo form_input(array('name'=>'title', 'class'=>'input-full', 'placeholder'=>'judul widget')) ?></td>
														</tr>
														<tr>
															<td class="bella">Widget</td>
															<td class="isi"><?php echo form_textarea(array('name'=>'widget', 'class'=>'textarea-full', 'placeholder'=>'script widget')); ?></td>
														</tr>
														<tr>
															<td class="bella">Urutan</td>
															<td class="isi"><?php echo form_input(array('name'=>'sort', 'class'=>'input-full', 'value'=>'0', 'placeholder'=>'Nomor urut')); ?></td>
														</tr>
														<tr>
															<td class="bella">Posisi</td>
															<td class="isi">
																<select name="position" class="dropdown">
																	<option value="">[ pilih posisi ]</option>
																	<option value="sidebar1">Widget Kiri</option>
																	<option value="sidebar2">Widget Kanan</option>
																</select>
															</td>
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
											<div class="isis">
												<div id="tabContainer">
												    <div id="tabs">
												    	<ul>
												        	<li id="tabHeader_1">Widget Kiri</li>
												        	<li id="tabHeader_2">Widget Kanan</li>
												      	</ul>
												    </div>
												    <div id="tabscontent">
												      	<section class="tabpage" id="tabpage_1">
												        	<?php
															if($widget_satu == "NULL"){
																echo 'data widget tidak ada';
															} else {
																echo form_open(base_url('widget/sorting'));
																	echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Simpan'));
																$no=1;
																foreach ($widget_satu as $widget1) { ?>
																	<div style="width: 95%;margin-bottom:5px;margin-top:5px;padding: 10px 20px;background: grey;color: black;overflow: hidden;border-radius: 5px;">
																		<span style="float:left;">
																			<?php echo form_hidden('kode'.$no, $widget1->idWidget); ?>
																			<input type="text" name="sort<?php echo $no; ?>" value="<?php echo $widget1->sort; ?>" style="border: 1px solid #ccc; width:50px; border-radius: 3px;text-align:center;" />
																			<?php echo $widget1->title; ?>
																		</span>
																		<span style="float:right;">
																			<?php
																			if($widget1->status == "active"){
																				if($widget1->idWidget == "1" || $widget1->idWidget == "2"){ ?>
																					<a href="<?php echo base_url('widget/setting/'.$widget1->idWidget.'/'.$widget1->title.'/deactive'); ?>" >Deactive</a>
																					&nbsp;|&nbsp;
																					<a href="#" onclick="return confirm('widget ini tidak dapat diubah')">Edit</a>
																					&nbsp;|&nbsp;
																					<a href="#" onclick="return confirm('widget ini tidak dapat dihapus')">Hapus</a>
																				<?php
																				} else { ?>
																					<a href="<?php echo base_url('widget/setting/'.$widget1->idWidget.'/'.$widget1->title.'/deactive'); ?>">Deactive</a>
																					&nbsp;|&nbsp;
																					<a href="<?php echo base_url('widget/edit_widget/'.$widget1->idWidget.'/'.$widget1->title); ?>">Edit</a>
																					&nbsp;|&nbsp;
																					<a href="<?php echo base_url('widget/del_widget/'.$widget1->idWidget.'/'.preg_replace("![^a-z0-9]+!i", "-", $widget1->title)); ?>" onclick="return confirm('setuju dihapus?')">Hapus</a>
																				<?php
																				}
																				?>
																			<?php
																			} else {
																				if($widget1->idWidget == "1" || $widget1->idWidget == "2"){ ?>
																					<a href="<?php echo base_url('widget/setting/'.$widget1->idWidget.'/'.$widget1->title.'/active'); ?>">Active</a>
																					&nbsp;|&nbsp;
																					<a href="#" onclick="return confirm('widget ini tidak dapat diubah')">Edit</a>
																					&nbsp;|&nbsp;
																					<a href="#" onclick="return confirm('widget ini tidak dapat dihapus')">Hapus</a>
																				<?php
																				} else { ?>
																					<a href="<?php echo base_url('widget/setting/'.$widget1->idWidget.'/'.$widget1->title.'/active'); ?>">Active</a>
																					&nbsp;|&nbsp;
																					<a href="<?php echo base_url('widget/edit_widget/'.$widget1->idWidget.'/'.$widget1->title); ?>">Edit</a>
																					&nbsp;|&nbsp;
																					<a href="<?php echo base_url('widget/del_widget/'.$widget1->idWidget.'/'.preg_replace("![^a-z0-9]+!i", "-", $widget1->title)); ?>" onclick="return confirm('setuju dihapus?')">Hapus</a>
																				<?php
																				}
																				?>
																			<?php
																			}
																			?>
																		</span>
																	</div>
																<?php
																$no++;
																}
																	$juml = $no-1;
																	echo form_hidden('juml', $juml);
																	echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Simpan'));
																echo form_close();
															}
															?>
												      	</section>
												      	<section class="tabpage" id="tabpage_2">       			
												      		<?php
															if($widget_dua == "NULL"){
																echo 'data widget tidak ada';
															} else {
																echo form_open(base_url('widget/sorting'));
																	echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Simpan'));
																$no=1;
																foreach ($widget_dua as $widget2) { ?>
																	<div style="width: 95%;margin-bottom:5px;margin-top:5px;padding: 10px 20px;background: grey;color: black;overflow: hidden;border-radius: 5px;">
																		<span style="float:left;">
																			<?php echo form_hidden('kode'.$no, $widget2->idWidget); ?>
																			<input type="text" name="sort<?php echo $no; ?>" value="<?php echo $widget2->sort; ?>" style="border: 1px solid #ccc; width:50px; border-radius: 3px;text-align:center;" />
																			<?php echo $widget2->title; ?>
																		</span>
																		<span style="float:right;">
																			<?php
																			if($widget2->status == "active"){
																				if($widget2->idWidget == "1" || $widget2->idWidget == "2"){ ?>
																					<a href="<?php echo base_url('widget/setting/'.$widget2->idWidget.'/'.$widget2->title.'/deactive'); ?>" >Deactive</a>
																					&nbsp;|&nbsp;
																					<a href="#" onclick="return confirm('widget ini tidak dapat diubah')">Edit</a>
																					&nbsp;|&nbsp;
																					<a href="#" onclick="return confirm('widget ini tidak dapat dihapus')">Hapus</a>
																				<?php
																				} else { ?>
																					<a href="<?php echo base_url('widget/setting/'.$widget2->idWidget.'/'.$widget2->title.'/deactive'); ?>">Deactive</a>
																					&nbsp;|&nbsp;
																					<a href="<?php echo base_url('widget/edit_widget/'.$widget2->idWidget.'/'.$widget2->title); ?>">Edit</a>
																					&nbsp;|&nbsp;
																					<a href="<?php echo base_url('widget/del_widget/'.$widget2->idWidget.'/'.preg_replace("![^a-z0-9]+!i", "-", $widget2->title)); ?>" onclick="return confirm('setuju dihapus?')">Hapus</a>
																				<?php
																				}
																				?>
																			<?php
																			} else {
																				if($widget2->idWidget == "1" || $widget2->idWidget == "2"){ ?>
																					<a href="<?php echo base_url('widget/setting/'.$widget2->idWidget.'/'.$widget2->title.'/active'); ?>">Active</a>
																					&nbsp;|&nbsp;
																					<a href="#" onclick="return confirm('widget ini tidak dapat diubah')">Edit</a>
																					&nbsp;|&nbsp;
																					<a href="#" onclick="return confirm('widget ini tidak dapat dihapus')">Hapus</a>
																				<?php
																				} else { ?>
																					<a href="<?php echo base_url('widget/setting/'.$widget2->idWidget.'/'.$widget2->title.'/active'); ?>">Active</a>
																					&nbsp;|&nbsp;
																					<a href="<?php echo base_url('widget/edit_widget/'.$widget2->idWidget.'/'.$widget2->title); ?>">Edit</a>
																					&nbsp;|&nbsp;
																					<a href="<?php echo base_url('widget/del_widget/'.$widget2->idWidget.'/'.preg_replace("![^a-z0-9]+!i", "-", $widget2->title)); ?>" onclick="return confirm('setuju dihapus?')">Hapus</a>
																				<?php
																				}
																				?>
																			<?php
																			}
																			?>
																		</span>
																	</div>
																<?php
																$no++;
																}
																	$juml = $no-1;
																	echo form_hidden('juml', $juml);
																	echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Simpan'));
																echo form_close();
															}
															?>
												      	</section>
												    </div>
												</div>
												<script src="<?php echo base_url('assets/js/tabs_old.js') ?>"></script>

												
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