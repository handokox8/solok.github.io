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

							
							<div class="tabel">
								<table style="width: 99%">
									<thead>
										<tr>
											<td width="3%">No</td>
											<td >Nama Member</td>
											<td >E-mail</td>
											<td >Username</td>
											<td style="text-align: center">Status</td>
											<td  style="text-align: center">Aksi</td>
										</tr>
									</thead>
									<tbody>
									<?php
									if($folower == "NULL"){ ?>
										<tr>
											<td colspan="4" style="text-align: center">Data Tidak Ada</td>
										</tr>
									<?php
									} else {
										$nomor=1;
										foreach ($folower as  $folower) { ?>
											<tr>
												<td width="3%"><?php echo $nomor; ?></td>
												<td><?php echo $folower->namaFolower; ?></td>
												<td ><?php echo $folower->emailFolower; ?></td>
												<td ><?php echo $folower->usernameFolower; ?></td>
												<td ><?php echo $folower->status; ?></td>
												<td style="text-align: center">
													<span>
														<?php if($folower->status == "pending" || $folower->status == "reject") { ?>
														<a style="visibility: visible;"href="<?php echo base_url('member/terima/'.$folower->idFolower.'/'.$folower->usernameFolower); ?>" title="ubah status">Terima | </a>
														
														<a style="visibility: visible;color:#ff0000"href="<?php echo base_url('member/tolak/'.$folower->idFolower.'/'.$folower->usernameFolower); ?>"onclick="return confirm('setuju dihapus?')" title="ubah status">Tolak</a> 
														<?php } else {?>
														
														<a style="visibility: visible;color:#ff0000"href="<?php echo base_url('member/tolak/'.$folower->idFolower.'/'.$folower->usernameFolower); ?>"onclick="return confirm('setuju dihapus?')" title="ubah status">Tolak</a> 
														<?php }?>
													</span>
																
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