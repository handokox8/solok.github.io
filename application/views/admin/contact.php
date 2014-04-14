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
							<div class="definisi">
								<table style="width: 80%">
									<tbody>
										<tr>
											<td class="bella">Title Kontak</td>
											<td class="isi"><?php echo $pages_id->title; ?></td>
										</tr>
										<tr>
											<td class="bella">Maps</td>
											<td class="isi">
												<div class="image" style="width: 90%; height: 150px; background: url(<?php echo base_url('assets/gambar/maps/'.$info->maps); ?>) no-repeat"></div>
											</td>
										</tr>
										<tr>
											<td class="bella">E-mail</td>
											<td class="isi"><?php echo $info->email; ?></td>
										</tr>
										<tr>
											<td class="bella">Alamat</td>
											<td class="isi"><?php echo $info->address; ?></td>
										</tr>
										<tr>
											<td class="bella">No. Telp/No. Hp</td>
											<td class="isi"><?php echo $info->contact; ?></td>
										</tr>
										<tr>
											<td class="bella">Deskripsi Kontak</td>
											<td class="isi"><?php echo $pages_id->deskripsi; ?></td>
										</tr>
										<tr>
											<td class="bella">Kata Kunci Kontak</td>
											<td class="isi"><?php echo $pages_id->keyword; ?></td>
										</tr>
										<tr>
											<td colspan="2"><a href="<?php echo base_url('contact/edit_contact'); ?>" class="btn btn-grey">Ubah Kontak</a></td>
										</tr>
									</tbody>
								</table>			
							</div>
						</div>
					</div>
				</div>