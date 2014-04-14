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

												<?php echo form_open_multipart(base_url('news/edit_news'), array('id'=>'formPages')); ?>
													<?php echo form_hidden('kdNews',$news_id->idNews); ?>
													<?php echo form_hidden('kdTitle', $this->uri->segment(4)); ?>
													<table style="width: 100%">
														<tr>
															<td><?php echo form_label('Judul Konten :', 'title'); ?></td>
														</tr>
														<tr>
															<td class="isi"><?php echo form_input(array('name'=>'title', 'class'=>'input-medium', 'value'=>$news_id->title)); ?></td>
														</tr>
														<tr>
															<td><p>Upload/Insert
																<button id="setImage" class="btn"><i class="icon-picture"></i></button></p></td>
														</tr>
														<tr>
															<td class="isi"><?php echo form_textarea(array('name'=>'elm1', 'class'=>'mceEditor', 'id'=>'elm1', 'value'=>$news_id->news)); ?></td>
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
														<td><?php echo form_label('Tanggal Terbit :'.$news_id->tanggal, 'tanggal terbit'); ?></td>
													</tr>
													<tr>
														<td class="isi">
															<?php
															$pecah = explode("-", $news_id->tanggal);

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
													<tr>
														<td><?php echo form_label('Status :', 'status'); ?></td>
													</tr>
													<tr>
														<td class="isi">
															<?php if($news_id->status == "publish"): ?>
																<?php echo form_radio(array('name'=>'status', 'class'=>'radio', 'value'=>'publish', 'checked'=>TRUE,)); ?>Publish&nbsp;
															<?php echo form_radio(array('name'=>'status', 'class'=>'radio', 'value'=>'draft')); ?>Draft
															<?php else: ?>
																<?php echo form_radio(array('name'=>'status', 'class'=>'radio', 'value'=>'publish')); ?>Publish&nbsp;
																<?php echo form_radio(array('name'=>'status', 'class'=>'radio', 'value'=>'draft', 'checked'=>TRUE,)); ?>Draft
															<?php endif ?>
														</td>
													</tr>
													<tr>
														<td><?php echo form_label('Jenis Halaman :', 'status'); ?></td>
													</tr>
													<tr>
														<td class="isi">
															<?php if($news_id->jenis == "publik"): ?>
																<?php echo form_radio(array('name'=>'jenis', 'class'=>'radio', 'value'=>'publik', 'checked'=>TRUE,)); ?>Publik&nbsp;
															<?php echo form_radio(array('name'=>'jenis', 'class'=>'radio', 'value'=>'privat')); ?>Pivat
															<?php else: ?>
																<?php echo form_radio(array('name'=>'jenis', 'class'=>'radio', 'value'=>'publik')); ?>Publish&nbsp;
																<?php echo form_radio(array('name'=>'jenis', 'class'=>'radio', 'value'=>'privat', 'checked'=>TRUE,)); ?>Privat
															<?php endif ?>
														</td>
													<tr>
														<td><?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-info', 'value'=>'Simpan')); ?></td>
													</tr>
												</table>
											</div>
										</div>
									</div>


									<div class="twin">	
										<div class="title">
											<h3>Pilih Label</h3>
										</div>								
										<div class="twin-isi">
											<div class="isis">
													<table style="width: 100%">
														<tr>
															<td><?php echo form_label('label Konten :', 'label'); ?></td>
														</tr>
														<tr>
															<td>
																<div id="data" class="label">
																	<ul class="labela" style="width:60%">
																	<?php
																	if($label_id == "NULL"){
																		echo 'Tidak ada label yang dipilih';
																	} else {
																		foreach ($label_id as $value) {
																			if(empty($value->label)){ ?>
																				<p>Anda Belum Memppunyai Label <a href="<?php echo base_url('label/get_label') ?>">Buat Label</a></p>
																		<?php } else {
																				//echo '<li>'.$value->label.'<i style="color:red" class="icon-trash icon-large"></i></li>';
																				?><li class="record"><?php echo $value->label; ?><a href="<?php echo base_url('label/del_label_rel/'.$value->idLabel.'/'.$news_id->idNews.'/'.$this->uri->segment(4)); ?>" title="hapus label"><i style="color:red" class="icon-trash icon-large"></i></a></li><?php
																			}
																		}
																	}
																	?>
																	</ul>
																</div>
															</td>
														</tr>
														<tr>
															<td>
																<div class="label">
																	 
																	 <p>Pilih Label : </p>

																	<?php
																	if($label_all == "NULL"){
																		echo 'Anda telah memilih semua label';
																	} else {
																		?><ul class="labela" style="width:60%"><?php
																			$nom=1;
																			foreach ($label_all as $label1) {
																				echo '<li>'.form_checkbox(array('name'=>'label'.$nom,'value'=>$label1->idLabel,'id'=>'label'.$nom)).'  '.form_label($label1->label , 'label'.$nom).'</li>';
																			$nom++;
																			}
																		?></ul><?php
																		$jumlah = $nom-1;
																		echo form_hidden('jumlah', $jumlah);
																	}
																	?>
																</div>
															</td>
														</tr>
													</table>
												
											</div>
										</div>
									</div>

									<div class="twin">	
										<div class="title">
											<h3>SEO Form</h3>
										</div>								
										<div class="twin-isi">
											<div class="isis">
												<table style="width: 100%">
													<tr>
														<td><?php echo form_label('Description Konten :', 'deskripsi'); ?></td>
													</tr>
													<tr>
														<td class="isi"><?php echo form_textarea(array('name'=>'deskripsi', 'class'=>'textarea-full', 'value'=>$news_id->deskripsi)); ?></td>
													</tr>
													<tr>
														<td><?php echo form_label('Kata kunci Konten :', 'keyword'); ?></td>
													</tr>
													<tr>
														<td class="isi"><?php echo form_input(array('name'=>'keyword', 'class'=>'input-full', 'value'=>$news_id->keyword)); ?></td>
													</tr>
												</table>
											</div>
										</div>
									</div>

									<div class="twin">	
										<div class="title">
											<h3>Featured Image</h3>
										</div>								
										<div class="twin-isi">
											<div class="isis">
												
													<?php echo form_hidden('kdNews',$news_id->idNews); ?>
													<?php echo form_hidden('tmbOld', $news_id->image); ?>
													<?php echo form_hidden('kdTitle', $this->uri->segment(4)); ?>
													<table style="width: 100%">
														<tr>
															<td><?php if($news_id->image == ""){ echo 'tidak ada thumnail'; } else { ?><img style="max-width: 100%" src="<?php echo base_url('assets/uploads/'.$news_id->image) ?>" alt="<?php echo $news_id->image; ?>"><?php } ?></td>
														</tr>

														<tr>
															<td class="isi"><?php echo form_upload(array('name'=>'tmb', 'class'=>'input-full')); ?></td>
														</tr>
														<tr>
															<td><?php echo form_submit(array('name'=>'image', 'class'=>'btn btn-grey', 'value'=>'Simpan')); ?></td>
														</tr>
													</table>
													
											</div>
										</div>
									</div>

									<?php echo form_close(); ?>	
								</div>

							</div>

							<div class="clear"></div>
						</div>
						
					</div>
				</div>