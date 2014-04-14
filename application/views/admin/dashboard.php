				<div id="content">
					<div class="content">						

						<div class="judul">
							<h2>Dashboard</h2>
							<p>Selamat Datang di ngAdmin panel versi 1.0</p>
						</div>

						<?php if($this->session->flashdata('flashNO')): ?>
						<div class="peringatan">
							<p><i class="icon-exclamation-sign icon-large"></i><?php echo $this->session->flashdata('flashNO'); ?></p>
						</div>
						<?php endif ?>

						<div class="twin-wrapper">
							<div class="twinner">
								<div class="twin-container twin50 twin-awal">
									<div class="twin">	
										<div class="title">
											<h3>Welcome Message</h3>
										</div>
										<div class="twin-isi">								
											<div class="isis list">
												<p>
													Selamat datang di ngAdmin panel JOGJAHOST version 1.0. 
													Jika mengalami atau kesulitan dalam menggunakan ngAdmin panel ini, 
													silahkan untuk menghubungi support jogjahost bagian developer : dev@ jogjahost.com atau bisa melalui tiket member.<br>
													copyright &copy; jogjahost
												</p>

												<div class="clear"></div>
											</div>										
										</div>
									</div>

									<div class="twin">	
										<div class="title">
											<h3>10 Konten Terakhir</h3>
										</div>
										<div class="twin-isi">								
											<div class="isis tabel">
												<table style="width: 99%">
													<thead>
														<tr>
															<td width="20%">Judul Konten</td>
															<td width="5%" style="text-align: left">Tanggal</td>
															<td width="3%" style="text-align: center"><i class="icon-bullhorn"></i></td>
														</tr>
													</thead>
													<tbody>
													<?php
													if($news_all == "NULL"){ ?>
														<tr>
															<td colspan="7" style="text-align: center">Data Tidak Ada</td>
														</tr>
													<?php
													} else {
														foreach ($news_all as $news) {
															$url = preg_replace("![^a-z0-9]+!i", "-", $news->title);
															?>
															<tr>
																
																<td width="20%"><?php echo $news->title; ?><br />
																	<span><a href="<?php echo base_url('news/edit_news/'.$news->idNews.'/'.$url); ?>" title="ubah Konten">Edit</a> | <a href="<?php echo base_url('news/trash_news/'.$news->idNews.'/'.$url); ?>" onclick="return confirm('setuju dihapus?')" style="color: #ff0000">Hapus</a> | <a href="<?php echo base_url('news/index/'.$news->idNews.'/'.$url); ?>" title="lihat hasil" target="_blank">Lihat</a></span>
																</td>
																
																<td width="5%" style="text-align: left"><?php echo $news->tanggal; echo '<br />'; echo $news->status; ?></td>
																<td width="3%" style="text-align: center">0</td>
															</tr>
														<?php
														}
													}
													?>
													</tbody>
												</table>
											</div>										
										</div>
									</div>
								</div>
								<div class="twin-container twin50 twin-akhir">
									<div class="twin">	
										<div class="title">
											<h3>10 Member Pending</h3>
										</div>
										<div class="twin-isi">								
											<div class="isis tabel">
												<table style="width: 99%">
													<thead>
														<tr>
															<td>username</td>
															<td>Email</td>
															<td>Status</td>
														</tr>
													</thead>
													<tbody>
													<?php
													if($folower == "NULL"){ ?>
														<tr>
															<td colspan="7" style="text-align: center">Data Tidak Ada</td>
														</tr>
													<?php
													} else {
														foreach ($folower as $folower) {
															?>
															<tr>
																
																<td><?php echo $folower->usernameFolower; ?><br />
																	<span><a href="<?php echo base_url('member/terima/'.$folower->idFolower.'/'.$folower->usernameFolower); ?>" title="ubah status">Terima | </a><a style="color:#ff0000"href="<?php echo base_url('member/tolak/'.$folower->idFolower.'/'.$folower->usernameFolower); ?>" onclick="return confirm('setuju dihapus?')" title="ubah status">Tolak</a> </span>
																</td>
																
																<td width="5%" style="text-align: left"><?php echo $folower->emailFolower; ?></td>
																<td width="3%" style="text-align: center"><?php echo $folower->status; ?></td>
															</tr>
															
														<?php
														}
													}
													?>

													</tbody>
												</table>
												<?php if($this->session->userdata('akses') == 'administrator'): ?>
												<a style="margin-left:10px;"href="<?php echo base_url('member/folower'); ?>" class="btn btn-info">Semua</a>
												<?php endif ?>
											</div>	
										</div>
									</div>

									

								</div>
								<div style="margin-bottom:0px;" class="twin-container twin50 twin-akhir">
									<div class="twin">	
										<div class="title">
											<h3>Infomasi SEO</h3>
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
														<tr>
														<?php if($this->session->userdata('akses') == 'administrator'): ?>
															<td><a href="<?php echo base_url('admin_info/'); ?>" class="btn btn-info">Ubah</a></td>
														<?php endif ?>
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