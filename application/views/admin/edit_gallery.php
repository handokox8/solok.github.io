				<div id="content">
					<div class="content">
						<div class="judul">
							<h2>Dashboard</h2>
							<p>Welcome to ngAdmin panel version 0.1</p>
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

						<div class="editor1">
							<div class="sticky">
								<div class="close-btn"><a id="btnShowHide" href="javascript:toggle2('stickyShow','btnShowHide');" ><i class='icon-remove-sign icon-large'></i></a></div>
								<div class="clear"></div>
								<div id="stickyShow" style="display: block;" class="saksake">
									Untuk menampilkan isi album ini, silahkan copy URL berikut ke dalam Tautan atau Menu :<br> ( <a href="<?php echo base_url('gallery/photos/'.$this->uri->segment(3).'/'.$this->uri->segment(4)); ?>"><?php echo base_url('gallery/photos/'.$this->uri->segment(3).'/'.$this->uri->segment(4)); ?></a> ).
								</div>
							</div>
						</div>

						<div class="editor">
							<div class="title">
								<h3><?php echo $title; ?></h3>
							</div>

							<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>
							<script language="Javascript" type="text/javascript">
					    		// source = http://www.randomsnippets.com/2008/02/21/how-to-dynamically-add-form-elements-via-javascript/
								var counter = 1;
								var i=0;
								var s=0;
								var limit = 10;

								var counters = 1;

								function addUpload(divName){
									if(counters == limit){
										alert("Maksimal " + counters + " Gambar");
									} else {
										var newdiv = document.createElement('p');
										newdiv.innerHTML = "<input type='file' class='input-sparo' name='image"+counters+"'>&nbsp;<input type='text'  class='input-sparo' placeholder='Alternatif Teks' name='alt"+counters+"'><a class='deldel' href='#'><i class='icon-trash icon-large'></i></a></p>";
										document.getElementById(divName).appendChild(newdiv);
										counters++;
									}
								}
							</script>
							<script>

								$(function () {

								var counter = 1;

								$('.deldel').live('click',function () {
								$(this).parent().remove();
								});

								$('#submitclick').submit(function(){

									for (i=0;i<=limit;i++){
										var c = i+1;
										
										var gambar=document.forms["formBanyak"]["image"+i].value;
										if (gambar==null || gambar=="")
										{
										alert("Semua gambar harus di isi");
										return false;
										}

										var altv=document.forms["formBanyak"]["alt"+i].value;
										if (altv==null || altv=="")
										{
										alert("Semua Alternatif text gambar  harus di isi");
										return false;
										}							
									}
								
								});
							});
							</script>

							<div class="table-heading">
								<div class="kiri sort">
									<?php echo form_open(base_url('gallery/add_gallery')); ?>
										<button class="btn btn-info">Tambah Album</button>
									<?php echo form_close(); ?>
								</div>
								<div class="clear"></div>
							</div>

							<div class="isis">
								<div class="gambar">
									<?php 
									foreach ($image_all as $image) { ?>
										<div class="loops">
											<img style="height:200px" src="<?php echo base_url('assets/gambar/galery/'.$image->file); ?>" alt="<?php echo 'a'; ?>"><br>
											<?php echo form_open('gallery/edit_image'); ?>
												<?php echo form_hidden('kdImage', $image->idImage); ?>
												<?php echo form_hidden('kdUrl', current_url()); ?>
												<?php echo form_input(array('name'=>'alt','class'=>'box-input','value'=>strip_tags($image->deskripsi))); ?>
												<?php echo form_submit(array('name'=>'submit', 'class'=>'hapus btn btn-success', 'value'=>'Simpan')); ?>
											<?php echo form_close(); ?>

											<?php echo form_open('gallery/del_image'); ?>
												<?php echo form_hidden('kdImage', $image->idImage); ?>
												<?php echo form_hidden('kdUrl', current_url()); ?>
												<?php echo form_submit(array('name'=>'submit', 'class'=>'hapus btn btn-danger', 'value'=>'Hapus', 'onClick'=>'return confirm(\'setuju dihapus?\')')); ?>
											<?php echo form_close(); ?>
										</div>
									<?php
									}
									?>

									<div class="clear"></div>

								</div>

								<div class="clear"></div>

								<?php echo form_open_multipart('gallery/add_image',array('id'=>'submitclick', 'name'=>'formBanyak')); ?>
									<?php echo form_hidden('kdAlbum',$album_id->idAlbum); ?>
									<?php echo form_hidden('kdUrl', current_url()); ?>
									<div>
										<p id="dynamicUpload">
										    Gambar 1<br><input type="file" class="input-sparo" name="image0"><input type="text" class="input-sparo" name="alt0" placeholder="Alternatif Teks">
										</p>
										<input class="btn" type="button" value="Tambahkan Gambar Lainnya" onClick="addUpload('dynamicUpload');">
									</div>
									<div>
										<?php $anu = "$('#con-load').show();"; echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Simpan' ,'onClick'=>$anu)); ?>
									</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>+