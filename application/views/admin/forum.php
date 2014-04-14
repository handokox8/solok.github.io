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
									<a href="<?php echo base_url('forum/add_forum') ?>" class="btn btn-info">Buat Forum</a>
									
									<!-- <a href="<?php echo base_url('news/trash'); ?>" class="btn btn-danger"><i class="icon-trash"></i></a>
									<a href="<?php echo base_url('news/sort_status/publish'); ?>" class="btn">Publish</a>&nbsp;<a href="<?php echo base_url('news/sort_status/draft'); ?>" class="btn">Draft</a> -->
								</div>
								<div class="kanan kotak-pagination">
									<?php //echo $this->pagination->create_links(); ?>
									<div class="search">
										<?php echo form_open(); ?>
											<?php echo form_input(array('name'=>'search', 'class'=>'search-input', 'placeholder'=>'pencarian ...')); ?>
											<button class="btn btn-grey"><i class="icon-search"></i></button>
										<?php echo form_close(); ?>
									</div>
								</div>
								<div class="clear"></div>
							</div>

							<div class="tabel">
								<table style="">
									<thead>
										<tr>
											<td width="3%">No</td>
											<td width="35%">Nama Forum</td>
											<td width="15%">Author</td>
											<td width="44%">deskripsi</td>
											<td width="3%" style="text-align: center"><i class="icon-bullhorn"></i></td>
										</tr>
									</thead>
									<tbody>
										<?php
										if($forum_all == "NULL"){
											?>
											<tr>
												<td colspan="5" style="text-align:center">Tidak ada data</td>
											</tr>
											<?php
										} else {
											$i=1;
											foreach ($forum_all as $forum) {
												$url = preg_replace("![^a-z0-9]+!i", "-", $forum->title);
												?>

												<tr>
													<td width="3%"><?php echo $i; ?></td>
													<td width="35%"><?php echo $forum->title; ?>
													<span><br><a href="<?php echo base_url('forum/edit/'.$forum->idForum.'/'.$url); ?>" title="ubah Konten" >Edit | </a><a href="<?php echo base_url('forum/detil/'.$forum->idForum.'/'.$url); ?>" title="ubah Konten" target="_blank" style="color: green">Lihat | </a><a href="<?php echo base_url('forum/trash/'.$forum->idForum.'/'.$url); ?>" onclick="return confirm('setuju dihapus?')" style="color: #ff0000">Hapus</a></span>
													
													
													</td>
													<td width="15%"><?php echo $forum->tanggal; ?></td>
													<td width="44%"><?php echo word_limiter(strip_tags($forum->post), 20) ?></td>
													<td width="3%" style="text-align: center"><i class="icon-bullhorn"></i></td>
												</tr>
												<?php
											$i++;
											}
										}
										?>
									</tbody>
								</table>
							</div>

						</div>
					</div>
				</div>