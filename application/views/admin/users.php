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

							<a href="<?php echo base_url('ngadmin/add_user') ?>" class="btn add-page btn-info">Tambah Pengguna</a>
							<div class="tabel">
								<table style="width: 99%">
									<thead>
										<tr>
											<td width="3%">No</td>
											<td width="20%">Nama Pengguna</td>
											<td width="20%">E-mail</td>
											<td width="20%">Hak Akses</td>
											<td width="5%" style="text-align: center">Aksi</td>
										</tr>
									</thead>
									<tbody>
									<?php
									if($user_all == "NULL"){ ?>
										<tr>
											<td colspan="4" style="text-align: center">Data Tidak Ada</td>
										</tr>
									<?php
									} else {
										$nomor=1;
										foreach ($user_all as $user) { ?>
											<tr>
												<td width="3%"><?php echo $nomor; ?></td>
												<td width="20%"><?php echo $user->nama; ?></td>
												<td width="20%"><?php echo $user->email; ?></td>
												<td width="20%"><?php echo $user->akses; ?></td>
												<td width="5%" style="text-align: center">
													<a style="color:#000" href="<?php echo base_url('ngadmin/setting_user/'.$user->idUser.'/'.$user->nama); ?>" title="ubah pengguna <?php echo $user->nama; ?>">
														<i class="icon-edit icon-large"></i>
													</a>&nbsp;
													<a style="color:#ff0000" href="<?php echo base_url('ngadmin/del_user/'.$user->idUser.'/'.$user->nama); ?>" onClick="return confirm('setuju akan dihapus?')" title="hapus pengguna <?php echo $user->nama; ?>">
														<i class="icon-trash icon-large"></i>
													</a>
												</td>
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