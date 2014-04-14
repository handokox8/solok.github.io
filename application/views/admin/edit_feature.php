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

						<div id="notif" class="peringatan">
							<?php echo form_error('title'); ?>
							<?php echo form_error('url'); ?>
							<?php echo form_error('deskripsi'); ?>
						</div>

						<div class="editor">
							<div class="title">
								<h3><?php echo $title; ?></h3>
							</div>
							<div class="isis">
								<?php echo form_open_multipart(base_url('feature/edit_feature/'.$feature_id->idFeature.'/'.$feature_id->title)); ?>
									<table>
										<tbody>
											<tr>
												<td class="bella">Ikon</td>
												<td class="isi"><img src="<?php echo base_url('assets/gambar/feature/'.$feature_id->icon); ?>" alt="icon" /></td>
											</tr>
											<tr>
												<td class="bella">Ikon baru</td>
												<td class="isi"><?php echo form_upload(array('name'=>'ikon', 'class'=>'input')); ?></td>
											</tr>
											<tr>
												<td class="bella">URL</td>
												<td class="isi"><?php echo form_input(array('name'=>'url', 'class'=>'input', 'value'=>$feature_id->link, 'placeholder'=>'URL feature')); ?></td>
											</tr>
											<tr>
												<td class="bella">Title</td>
												<td class="isi"><?php echo form_input(array('name'=>'title', 'class'=>'input', 'value'=>$feature_id->title, 'placeholder'=>'Title feature')); ?></td>
											</tr>
											<tr>
												<td class="bella">Deskripsi</td>
												<td class="isi"><?php echo form_textarea(array('name'=>'deskripsi', 'class'=>'textarea', 'value'=>$feature_id->deskripsi, 'placeholder'=>'deskripsi feature')); ?></td>
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