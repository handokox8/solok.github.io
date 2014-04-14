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

						<div class="peringatan">
							<?php echo form_error('username'); ?>
							<?php echo form_error('fullname'); ?>
							<?php echo form_error('address'); ?>
							<?php echo form_error('email'); ?>
							<?php echo form_error('question'); ?>
							<?php echo form_error('answer'); ?>
						</div>

						<div class="editor">
							<div class="title">
								<h3><?php echo $title; ?></h3>
							</div>
							<div class="isis">
								<?php echo form_open_multipart(base_url('ngadmin/add_user')); ?>
									<table>
										<tbody>
											<tr>
												<td class="bella">Photo Profile</td>
												<td class="isi"><?php echo form_upload(array('name'=>'userfile', 'class'=>'input')); ?></td>
											</tr>
											<tr>
												<td class="bella">Nama Pengguna</td>
												<td class="isi"><?php echo form_input(array('name'=>'username', 'class'=>'input', 'placeholder'=>'Nama pengguna')); ?></td>
											</tr>
											<tr>
												<td class="bella">Nama Lengkap</td>
												<td class="isi"><?php echo form_input(array('name'=>'fullname', 'class'=>'input', 'placeholder'=>'Nama lengkap')); ?></td>
											</tr>
											<tr>
												<td class="bella">Alamat</td>
												<td class="isi"><?php echo form_input(array('name'=>'address', 'class'=>'input', 'placeholder'=>'Alamat')); ?></td>
											</tr>
											<tr>
												<td class="bella">E-mail</td>
												<td class="isi"><?php echo form_input(array('name'=>'email', 'class'=>'input', 'placeholder'=>'E-mail')); ?></td>
											</tr>
											<tr>
												<td class="bella">Pertanyaan Rahasia</td>
												<td class="isi"><?php echo form_input(array('name'=>'question', 'class'=>'input', 'placeholder'=>'Pertanyaan rahasia')); ?></td>
											</tr>
											<tr>
												<td class="bella">Jawaban Rahasia</td>
												<td class="isi"><?php echo form_input(array('name'=>'answer', 'class'=>'input', 'placeholder'=>'Jawaban rahasia')); ?></td>
											</tr>
											<tr>
												<td class="bella">Hak Akses</td>
												<td class="isi">
													<select name="akses" class="dropdown">
														<option value="author">Author</option>
														<option value="subcribe">Subcribe</option>
														<option value="administrator">Administrator</option>
													</select>
												</td>
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