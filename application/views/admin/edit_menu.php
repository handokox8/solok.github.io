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
								<div class="twin-container twin30 twin-awal">
									<div class="twin">	
										<div class="title">
											<h3><?php echo $title; ?></h3>
										</div>								
										
										<div class="twin-isi">
											<div class="isis">
												<?php echo form_open(base_url('menu/edit_menu/'.$menu_id->idMenus)); ?>
												<?php echo form_hidden(array('name'=>'IdMenu', 'value'=>$menu_id->idMenus)); ?>
													<table style="width: 100%">
														<tbody>
															<tr>
																<td class="bella">URL</td>
																<td class="isi"><?php echo form_input(array('name'=>'url', 'class'=>'input-full', 'value'=>$menu_id->url, 'placeholder'=>'http://')); ?></td>
															</tr>
															<tr>
																<td class="bella">Label</td>
																<td class="isi"><?php echo form_input(array('name'=>'label', 'class'=>'input-full', 'value'=>$menu_id->label)); ?></td>
															</tr>
															<tr>
																<td class="bella">Parent to</td>
																<td class="isi">
																	<select name="parent" class="dropdown">
																		<option value="parent">[ parent to ]</option>
																		<optgroup  label="Menu Header">
																			<?php
																			if($parent_head == "NULL"){
																				?><option value="">-</option><?php
																			} else {
																				foreach ($parent_head as $ph) {
																					if($ph->idMenus == $menu_id->structure){
																						?><option value="<?php echo $ph->idMenus; ?>" selected="selected"><?php echo $ph->label; ?></option><?php
																					} else {
																						?><option value="<?php echo $ph->idMenus; ?>"><?php echo $ph->label; ?></option><?php
																					}
																				}
																			}
																			?>
																		</optgroup>
																		<optgroup  label="Menu Sidebar">
																			<?php
																			if($parent_side == "NULL"){
																				?><option value="">-</option><?php
																			} else {
																				foreach ($parent_side as $ps) {
																					if($ps->idMenus == $menu_id->structure){
																						?><option value="<?php echo $ps->idMenus; ?>" selected="selected"><?php echo $ps->label; ?></option><?php
																					} else {
																						?><option value="<?php echo $ps->idMenus; ?>"><?php echo $ps->label; ?></option><?php
																					}
																				}
																			}
																			?>
																		</optgroup>
																		<optgroup  label="Menu Footer">
																			<?php
																			if($parent_foot == "NULL"){
																				?><option value="">-</option><?php
																			} else {
																				foreach ($parent_foot as $pf) {
																					if($menu_id->structure == $pf->idMenus){
																						?><option value="<?php echo $pf->idMenus; ?>" selected="selected"><?php echo $pf->label; ?></option><?php
																					} else {
																						?><option value="<?php echo $pf->idMenus; ?>"><?php echo $pf->label; ?></option><?php
																					}
																				}
																			}
																			?>
																		</optgroup>
																	</select>
																</td>
															</tr>
															<tr>
																<td class="bella">Urutan</td>
																<td class="isi"><?php echo form_input(array('name'=>'urut', 'class'=>'input-full', 'value'=>$menu_id->sort, 'placeholder'=>'urutan tata letak menu')); ?></td>
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
											<h3>Struktur Menu</h3>
										</div>								
										<div class="twin-isi">
											<div class="isis">
												<div id="tabContainer">
												    <div id="tabs">
												    	<ul>
												        	<li id="tabHeader_1">Menu Header</li>
												        	<li id="tabHeader_2">Menu sidebar</li>
												        	<li id="tabHeader_3">Menu Footer</li>
												      	</ul>
												    </div>
												    <div id="tabscontent">
												      	<section class="tabpage" id="tabpage_1">
												        	<?php
												        	if($parent_head == "NULL") { 
												        		echo "tidak ada menu";
												        	} else { ?>
											        			<?php $i=1; $a=1; foreach($parent_head as $row1)  { ?>
																	<div id="menu-parent" style="width: 95%; padding: 10px 20px; margin-bottom: 5px; background: grey; color: #000; overflow: hidden; border-radius: 5px">
																		<span class="kanan" style="float: left"><?php echo $row1->label; ?></span>
																		<span class="kiri" style="float: right"><a href="<?php echo base_url('menu/edit_menu/'.$row1->idMenus); ?>" style="color: #fff"><i class="icon-edit icon-large"></i></a>&nbsp;&nbsp;<a href="<?php echo base_url('menu/del_menu/'.$row1->idMenus.'/'.$row1->label); ?>" onclick="return confirm('setuju dihapus?')" style="color: #ff0000"><i class="icon-trash icon-large"></i></a></span>
																	</div>
																		<?php foreach(${'child_head'.$i} as $rw1) { ?>
																			<div id="menu-child" style="width: 92%; padding: 10px 20px; background: grey; color: #000; margin: 5px 0px 5px 20px; overflow: hidden; border-radius: 5px">
																				<span class="kanan" style="float: left"><?php echo $rw1->label; ?></span>
																				<span class="kiri" style="float: right"><a href="<?php echo base_url('menu/edit_menu/'.$rw1->idMenus); ?>" style="color: #fff"><i class="icon-edit icon-large"></i></a>&nbsp;&nbsp;<a href="<?php echo base_url('menu/del_menu/'.$rw1->idMenus.'/'.$rw1->label); ?>" onclick="return confirm('setuju dihapus?')" style="color: #ff0000"><i class="icon-trash icon-large"></i></a></span>
																			</div>
																		<?php } ?>
																<?php $i++; $a++; } ?>
												        	<?php
												        	} ?>
												      	</section>
												      	<section class="tabpage" id="tabpage_2">       			
												      		<?php
												        	if($parent_side == "NULL") { 
												        		echo "tidak ada menu";
												        	} else { ?>
											        			<?php $i=1; $a=1; foreach($parent_side as $row2)  { ?>
																	<div id="menu-parent" style="width: 95%; padding: 10px 20px; margin-bottom: 5px; background: grey; color: #000; overflow: hidden; border-radius: 5px">
																		<span class="kanan" style="float: left"><?php echo $row2->label; ?></span>
																		<span class="kiri" style="float: right"><a href="<?php echo base_url('menu/edit_menu/'.$row2->idMenus); ?>" style="color: #fff"><i class="icon-edit icon-large"></i></a>&nbsp;&nbsp;<a href="<?php echo base_url('menu/del_menu/'.$row2->idMenus.'/'.$row2->label); ?>" onclick="return confirm('setuju dihapus?')" style="color: #ff0000"><i class="icon-trash icon-large"></i></a></span>
																	</div>
																		<?php foreach(${'child_side'.$i} as $rw2) { ?>
																			<div id="menu-child" style="width: 92%; padding: 10px 20px; background: grey; color: #000; margin: 5px 0px 5px 20px; overflow: hidden; border-radius: 5px">
																				<span class="kanan" style="float: left"><?php echo $rw2->label; ?></span>
																				<span class="kiri" style="float: right"><a href="<?php echo base_url('menu/edit_menu/'.$rw2->idMenus); ?>" style="color: #fff"><i class="icon-edit icon-large"></i></a>&nbsp;&nbsp;<a href="<?php echo base_url('menu/del_menu/'.$rw2->idMenus.'/'.$rw2->label); ?>" onclick="return confirm('setuju dihapus?')" style="color: #ff0000"><i class="icon-trash icon-large"></i></a></span>
																			</div>
																		<?php } ?>
																<?php $i++; $a++; } ?>
												        	<?php
												        	} ?>
												      	</section>
												      	<section class="tabpage" id="tabpage_3">
												       		<?php
												        	if($parent_foot == "NULL") { 
												        		echo "tidak ada menu";
												        	} else { ?>
											        			<?php $i=1; $a=1; foreach($parent_foot as $row3)  { ?>
																	<div id="menu-parent" style="width: 95%; padding: 10px 20px; margin-bottom: 5px; background: grey; color: #000; overflow: hidden; border-radius: 5px">
																		<span class="kanan" style="float: left"><?php echo $row->label; ?></span>
																		<span class="kiri" style="float: right"><a href="<?php echo base_url('menu/edit_menu/'.$row3->idMenus); ?>" style="color: #fff"><i class="icon-edit icon-large"></i></a>&nbsp;&nbsp;<a href="<?php echo base_url('menu/del_menu/'.$row3->idMenus.'/'.$row3->label); ?>" onclick="return confirm('setuju dihapus?')" style="color: #ff0000"><i class="icon-trash icon-large"></i></a></span>
																	</div>
																		<?php foreach(${'child_foot'.$i} as $rw3) { ?>
																			<div id="menu-child" style="width: 92%; padding: 10px 20px; background: grey; color: #000; margin: 5px 0px 5px 20px; overflow: hidden; border-radius: 5px">
																				<span class="kanan" style="float: left"><?php echo $rw->label; ?></span>
																				<span class="kiri" style="float: right"><a href="<?php echo base_url('menu/edit_menu/'.$rw3->idMenus); ?>" style="color: #fff"><i class="icon-edit icon-large"></i></a>&nbsp;&nbsp;<a href="<?php echo base_url('menu/del_menu/'.$rw3->idMenus.'/'.$rw3->label); ?>" onclick="return confirm('setuju dihapus?')" style="color: #ff0000"><i class="icon-trash icon-large"></i></a></span>
																			</div>
																		<?php } ?>
																<?php $i++; $a++; } ?>
												        	<?php
												        	} ?>
												      	</section>
												    </div>
												</div>
												<script src="<?php echo base_url('assets/js/tabs_old.js') ?>"></script>

											</div>
										</div>
									</div>
								</div>

							</div>

							<div class="clear"></div>
						</div>

					</div>
				</div>