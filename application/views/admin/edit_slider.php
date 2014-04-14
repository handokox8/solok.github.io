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
						</div>

						<div class="editor">
							<div class="title">
								<h3><?php echo $title; ?></h3>
							</div>
							<div class="isis">
								<?php echo form_open_multipart(base_url('slider/simpan_ubah')); ?>
									<?php echo form_hidden(array('name'=>'idSlider', 'value'=>$slider_id->idSlider)); ?>
									<table>
										<tbody>
											<tr>
												<td class="bella">&nbsp;</td>
												<td class="isi"><img style="width: 61%" src="<?php echo base_url('assets/gambar/slider/'.$slider_id->filename); ?>"></td>
											</tr>
											<tr>
												<td class="bella">Gambar Slider</td>
												<td class="isi"><?php echo form_upload(array('name'=>'userfile', 'class'=>'input')); ?></td>
											</tr>
											<tr>
												<td class="bella">Title</td>
												<td class="isi"><?php echo form_input(array('name'=>'title', 'class'=>'input', 'value'=>$slider_id->alt, 'placeholder'=>'Title slider')); ?></td>
											</tr>
											<tr>
												<td class="bella">URL</td>
												<td class="isi"><?php echo form_input(array('name'=>'url', 'class'=>'input-full', 'value'=>$slider_id->url, 'placeholder'=>'Url slider, gunakan http://...')); ?></td>
											</tr>
											<tr>
												<td colspan="2"><?php $anu = "$('#con-load').show();"; echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Simpan', 'onclick'=>$anu)); ?></td>
											</tr>
										</tbody>
									</table>
								<?php echo form_close(); ?>					
							</div>
						</div>
					</div>
				</div>