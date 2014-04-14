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
							<?php echo $this->session->flashdata('flashNO'); ?>
						</div>
						<?php endif ?>

						<div class="peringatan">
							<?php echo form_error('username'); ?>
							<?php echo form_error('fullname'); ?>
							<?php echo form_error('address'); ?>
							<?php echo form_error('email'); ?>
							<?php echo form_error('question'); ?>
							<?php echo form_error('answer'); ?>
							<?php echo form_error('newPass'); ?>
							<?php echo form_error('confPass'); ?>
							<?php echo form_error('oldPass'); ?>
						</div>

						<div class="editor">
							<div class="title">
								<h3><?php echo $title; ?></h3>
							</div>
							<div class="isis">
								<?php echo form_open_multipart(base_url('ngadmin/setting_user/'.$user_id->idUser.'/'.$user_id->nama)); ?>
									<?php echo form_hidden('kdUser', $user_id->idUser); ?>
									<table>
										<tbody>
											<?php
											if($user_id->photo == ""){

											} else {
												?>
												<tr>
													<td class="bella">Photo</td>
													<td class="isi"><img src="<?php echo base_url('assets/gambar/profile/'.$user_id->photo); ?>"></td>
												</tr>
												<?php
											}
											?>
											<tr>
												<td class="bella">Pilih berkas photo</td>
												<td class="isi"><?php echo form_upload(array('name'=>'userfile', 'class'=>'input')); ?></td>
											</tr>
											<tr>
												<td class="bella">Nama Pengguna</td>
												<td class="isi"><?php echo form_input(array('name'=>'username', 'class'=>'readonly', 'placeholder'=>'Nama pengguna', 'value'=>$user_id->userName, 'readonly'=>'readonly')); ?></td>
											</tr>
											<tr>
												<td class="bella">Nama Lengkap</td>
												<td class="isi"><?php echo form_input(array('name'=>'fullname', 'class'=>'input', 'placeholder'=>'Nama lengkap', 'value'=>$user_id->nama)); ?></td>
											</tr>
											<tr>
												<td class="bella">Alamat</td>
												<td class="isi"><?php echo form_input(array('name'=>'address', 'class'=>'input', 'placeholder'=>'Alamat', 'value'=>$user_id->address)); ?></td>
											</tr>
											<tr>
												<td class="bella">E-mail</td>
												<td class="isi"><?php echo form_input(array('name'=>'email', 'class'=>'input', 'placeholder'=>'E-mail', 'value'=>$user_id->email)); ?></td>
											</tr>
											<?php
											if($this->session->userdata('akses') == 'administrator'): ?>
											<tr>
												<td class="bella">Hak Akses</td>
												<td class="isi">
													<select name="akses" class="dropdown">
													<?php
													if($user_id->akses == 'administrator'){ ?>
														<option value="administrator" selected="selected">Administrator</option>
													<?php
													} else { ?>
														<option value="administrator">Administrator</option>
													<?php
													}
													?>
													<?php
													if($user_id->akses == 'author'){ ?>
														<option value="author" selected="selected">Author</option>
													<?php
													} else { ?>
														<option value="author">Author</option>
													<?php
													}
													?>
													<?php
													if($user_id->akses == 'subcribe'){ ?>
														<option value="subcribe" selected="selected">Subcribe</option>
													<?php
													} else { ?>
														<option value="subcribe">Subcribe</option>
													<?php
													}
													?>
													</select>
												</td>
											</tr>
											<?php endif ?>
											<tr>
												<td class="bella">Pertanyaan Rahasia</td>
												<td class="isi"><?php echo form_input(array('name'=>'question', 'class'=>'input', 'placeholder'=>'Pertanyaan rahasia', 'value'=>$user_id->question)); ?></td>
											</tr>
											<tr>
												<td class="bella">Jawaban Rahasia</td>
												<td class="isi"><?php echo form_input(array('name'=>'answer', 'class'=>'input', 'placeholder'=>'Jawaban rahasia', 'value'=>$user_id->answer)); ?></td>
											</tr>
											<tr>
												<td class="bella">Password Baru</td>
												<td class="isi"><?php echo form_password(array('name'=>'newPass', 'class'=>'input', 'placeholder'=>'Password baru')); ?></td>
											</tr>
											<tr>
												<td class="bella">Ulangi Password Baru</td>
												<td class="isi"><?php echo form_password(array('name'=>'confPass', 'class'=>'input', 'placeholder'=>'Ulangi password baru anda')); ?></td>
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