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

						<div class="editor">
							<div class="title">
								<h3><?php echo $title; ?></h3>
							</div>

							<div class="table-heading">
								<div class="kiri sort">
									<a href="<?php echo base_url('admin_pages/add_pages') ?>" class="btn btn-info">Tambah Halaman</a>
								</div>
								
								<div class="kanan kotak-pagination">
									<?php //echo $this->pagination->create_links(); ?>
									<div class="search">
										<?php echo form_open(base_url('admin_pages/pages_search')); ?>
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
											<td width="25%">Title Pages</td>
											<td width="40%">Tautan</td>
											<td width="25%">Deskripsi</td>
										</tr>
									</thead>
									<tbody>
									<?php
									if($pages_all == "NULL"){ ?>
										<tr>
											<td colspan="4" style="text-align: center">Data Tidak Ada</td>
										</tr>
									<?php
									} else {
										$nomor=1;
										foreach ($pages_all as $pages) {
											$url = preg_replace("![^a-z0-9]+!i", "-", $pages->title);
											?>
											<tr>
												<td width="3%"><?php echo $nomor; ?></td>
												<td width="20%"><?php echo $pages->title; ?><br />
													<span><a href="<?php echo base_url('admin_pages/edit_pages/'.$pages->idPages); ?>" title="ubah halaman">Edit</a>
													<?php
													if($pages->idPages == '1' || $pages->idPages == '3'){

													} else { ?>
														&nbsp;|&nbsp;<a style="color: #ff0000" href="<?php echo base_url('admin_pages/del_pages/'.$pages->idPages.'/'.$url); ?>" onclick="return confirm('setuju dihapus?')" title="hapus halaman">Hapus</a>
													<?php
													}
													?>
													&nbsp;|&nbsp;<a href="<?php echo base_url('pages/index/'.$pages->idPages.'/'.$url); ?>" title="lihat halaman" target="_blank">Lihat</a></span>
												</td>
												<td width="20%"><?php echo base_url('pages/index/'.$pages->idPages.'/'.$url); ?></td>
												<td width="20%"><?php echo $pages->deskripsi; ?></td>
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