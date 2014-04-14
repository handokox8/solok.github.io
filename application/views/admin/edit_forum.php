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

						<div class="peringatan">
							<?php echo form_error('title'); ?>
							<?php echo form_error('elm1'); ?>
							<?php echo form_error('deskripsi'); ?>
							<?php echo form_error('keyword'); ?>
							<?php echo form_error('titleSeo'); ?>
						</div>

						<div class="twin-wrapper">
							<div class="twinner">	

								<div class="twin-container twin70 twin-awal">
									<div class="twin">	
										<div class="title">
											<h3><?php echo $title; ?></h3>
										</div>								
										
										<div class="twin-isi">
											<div class="isis">
												<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>
												<script type="text/javascript" src="<?php echo base_url()?>assets/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
												<script type="text/javascript" src="<?php echo base_url()?>assets/js/tiny_mce/tiny_mce.js"></script>
												<script type="text/javascript">
													var site_url = '<?php echo base_url();?>'
												</script>
												<script type="text/javascript" src="<?php echo base_url()?>assets/js/setting.tiny_mce.js"></script>

												<?php echo form_open_multipart(base_url('forum/edit/'.$forum_id->idForum), array('id'=>'formPages')); //news/add_news ?>
													<table style="width: 100%">
														<tr>
															<td><?php echo form_label('Judul Forum :', 'title'); ?></td>
														</tr>
														<tr>
															<td class="isi"><?php echo form_input(array('name'=>'title', 'class'=>'input-medium','value'=>$forum_id->title)); ?></td>
														</tr>
														<tr>
															<td><p>Upload/Insert
																<button id="setImage" class="btn"><i class="icon-picture"></i></button></p></td>
														</tr>
														<tr>
															<td class="isi"><?php echo form_textarea(array('name'=>'elm1', 'class'=>'mceEditor', 'id'=>'elm1','value'=>$forum_id->post)); ?></td>
														</tr>
													</table>			
											</div>
										</div>
									</div>
								</div>
								<div class="twin-container twin30 twin-akhir">
									
									<div class="twin">
									<div class="title">
											<h3>Terbit</h3>
										</div>								
										<div class="twin-isi">
											<div class="isis">
												<table style="width: 100%">
													<tr>
														<td><?php echo form_label('Tanggal Terbit :'.$forum_id->tanggal, 'tanggal terbit'); ?></td>
													</tr>
													<tr>
														<td class="isi">
															<?php
															$pecah = explode("-", $forum_id->tanggal);

															$tanggal = $pecah[2];
															$bulan = $pecah[1];
															$tahun = $pecah[0];

															$thn = date("Y");

															?>
															<select name="tanggal" class="dropdown">
																<?php
																for($a=1;$a<=31;$a++){
																	if($a == $tanggal){
																		?><option value="<?php echo $a; ?>" selected="selected"><?php echo $a; ?></option><?php
																	} else {
																		?><option value="<?php echo $a; ?>"><?php echo $a; ?></option><?php
																	}
																}
																?>
															</select>
															<select name="bulan" class="dropdown">
																<?php
																for($b=1;$b<=12;$b++){
																	switch ($b) {
																		case '01':
																			$bln = 'Januari';
																			break;
																		case '02':
																			$bln = 'Februari';
																			break;
																		case '03':
																			$bln = 'Maret';
																			break;
																		case '04':
																			$bln = 'April';
																			break;
																		case '05':
																			$bln = 'Mei';
																			break;
																		case '06':
																			$bln = 'Juni';
																			break;
																		case '07':
																			$bln = 'Juli';
																			break;
																		case '08':
																			$bln = 'Agustus';
																			break;
																		case '09':
																			$bln = 'September';
																			break;
																		case '10':
																			$bln = 'Oktober';
																			break;
																		case '11':
																			$bln = 'November';
																			break;
																		case '12':
																			$bln = 'Desember';
																			break;
																		
																		default:
																			$bln = 'not set';
																			break;
																	}
																	if($b == $bulan){
																		?><option value="<?php echo $b; ?>" selected="selected"><?php echo $bln; ?></option><?php
																	} else {
																		?><option value="<?php echo $b; ?>"><?php echo $bln; ?></option><?php
																	}
																}
																?>
															</select>
															<select name="tahun" class="dropdown">
																<?php
																for($c=$tahun-2;$c<=$thn;$c++){
																	if($c == $tahun){
																		?><option value="<?php echo $c; ?>" selected="selected"><?php echo $c; ?></option><?php
																	} else {
																		?><option value="<?php echo $c; ?>"><?php echo $c; ?></option><?php
																	}
																}
																?>
															</select>
														</td>
													</tr>	
										<div class="title">
											<h3>SEO Form</h3>
										</div>								
										<div class="twin-isi">
											<div class="isis">
												<table style="width: 100%">
													<tr>
														<td><?php echo form_label('Judul SEO forum :', 'titleSeo'); ?></td>
													</tr>
													<tr>
														<td class="isi"><?php echo form_input(array('name'=>'titleSeo', 'class'=>'input-full', 'placeholder'=>'judul SEO forum','value'=>$forum_id->titleSeo)); ?></td>
													</tr>
													<tr>
														<td><?php echo form_label('Deskripsi forum :', 'deskripsi'); ?></td>
													</tr>
													<tr>
														<td class="isi"><?php echo form_textarea(array('name'=>'deskripsi', 'class'=>'textarea-full', 'placeholder'=>'deskripsi forum','value'=>$forum_id->deskripsi)); ?></td>
													</tr>
													<tr>
														<td><?php echo form_label('Kata kunci forum :', 'keyword'); ?></td>
													</tr>
													<tr>
														<td class="isi"><?php echo form_input(array('name'=>'keyword', 'class'=>'input-full', 'placeholder'=>'kata kunci forum, pisahkan dengan tanda koma','value'=>$forum_id->keyword)); ?></td>
													</tr>
													<tr>
														<td class="isi"><?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-info', 'value'=>'Simpan')); ?></td>
													</tr>
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