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

						<?php if(form_error('search')): ?>
						<div id="notif" class="peringatan">
							<?php echo form_error('search'); ?>
						</div>
						<?php endif ?>

						<div class="editor">
							<div class="title">
								<h3><?php echo $title; ?></h3>
							</div>

							<div class="table-heading">
								<div class="kiri sort">
									<a href="<?php echo base_url('news/add_news') ?>" class="btn btn-info">Tambah Konten</a>
									<?php echo form_open(base_url('news/sort')); ?>
										<select name="label" class="dropdown">
											<option value="">[ Filter berdasarkan label ]</option>
											<?php
											if($all_label == "NULL"){
												?><option value="">[ tidak ada Label ]</option><?php
											} else {
												foreach ($all_label as $label_news) {
													?><option value="<?php echo $label_news->idLabel; ?>"><?php echo $label_news->label; ?></option><?php
												}
											}
											?>
										</select>
										<input type="submit" class="btn btn-grey" value="Filter">
									<?php echo form_close(); ?>
									<a href="<?php echo base_url('news/trash'); ?>" class="btn btn-danger"><i class="icon-trash"></i></a>
									<a href="<?php echo base_url('news/sort_status/publish'); ?>" class="btn">Publish</a>&nbsp;<a href="<?php echo base_url('news/sort_status/draft'); ?>" class="btn">Draft</a>
								</div>
								<div class="kanan kotak-pagination">
									<?php echo $this->pagination->create_links(); ?>
									<div class="search">
										<?php echo form_open(base_url('news/news_search')); ?>
											<?php echo form_input(array('name'=>'search', 'class'=>'search-input', 'placeholder'=>'pencarian ...')); ?>
											<button class="btn btn-grey"><i class="icon-search"></i></button>
										<?php echo form_close(); ?>
									</div>
								</div>
								<div class="clear"></div>
							</div>

							<div class="tabel">
								<table style="width: 99%">
									<thead>
										<tr>
											<td width="3%">No</td>
											<td width="20%">Judul Konten</td>
											<td width="25%">Tautan</td>
											<td width="20%" style="text-align: center">Label</td>
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
										$nomor=1;
										foreach ($news_all as $news) {
											$url = preg_replace("![^a-z0-9]+!i", "-", $news->title);
											?>
											<tr>
												<td width="3%"><?php echo $nomor; ?></td>
												
												<td width="20%"><?php echo $news->title; ?><br />
													<?php  $status = $news->status;
														if($status == 'publish') { 
														?>
														<span><a href="<?php echo base_url('news/edit_news/'.$news->idNews.'/'.$url); ?>" title="ubah Konten">Edit</a> | <a href="<?php echo base_url('news/trash_news/'.$news->idNews.'/'.$url); ?>" onclick="return confirm('setuju dihapus?')" style="color: #ff0000">Hapus</a> | <a href="<?php echo base_url('news/index/'.$news->idNews.'/'.$url); ?>" title="lihat hasil" target="_blank">Lihat</a> | <a href="<?php echo base_url('news/update/'.$news->idNews.'/'.$url.'/draft'); ?>"style="color: coral">Draft</a></span>
														<?php } else { ?>
														<span><a href="<?php echo base_url('news/edit_news/'.$news->idNews.'/'.$url); ?>" title="ubah Konten">Edit</a> | <a href="<?php echo base_url('news/trash_news/'.$news->idNews.'/'.$url); ?>" onclick="return confirm('setuju dihapus?')" style="color: #ff0000">Hapus</a> | <a href="<?php echo base_url('news/index/'.$news->idNews.'/'.$url); ?>" title="lihat hasil" target="_blank">Lihat</a> | <a href="<?php echo base_url('news/update/'.$news->idNews.'/'.$url.'/publish'); ?>"style="color: green">Publish</a></span>
														<?php } ?>
												</td>
												
												<td width="25%"><?php echo base_url('news/index/'.$news->idNews.'/'.$url); ?></td>
												<td width="20%" style="text-align: center">
												<?php
												foreach (${'label'.$nomor} as $labels) {
													if($labels->idLabel == ""){
														echo 'tidak ada label';
													} else {
														echo $labels->label.',';
													}
												}
												?>
												</td>
												<td width="5%" style="text-align: left"><?php echo $news->tanggal; echo '<br />'; echo $news->status; ?></td>
												<td width="3%" style="text-align: center">0</td>
											</tr>
										<?php
										$nomor++;
										}
									}
									?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>