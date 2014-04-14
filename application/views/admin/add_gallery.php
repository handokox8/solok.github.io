				<div id="content">
					<div class="content">
						<div class="judul">
							<h2>Dashboard</h2>
							<p>Welcome to admin panel version 0.1</p>
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
							<?php echo form_error('deskripsi'); ?>
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

						<div class="twin-wrapper">
							<div class="twinner">
								<div class="twin-container twin50 twin-awal">
									<div class="twin">	
										<div class="title">
											<h3><?php echo $title; ?></h3>
										</div>

										<div class="twin-isi">
											<div class="isis">
												<form id="submitclick" name="formBanyak" action="<?php echo base_url('gallery/add_gallery'); ?>" method="post" enctype="multipart/form-data">
												<table width="90%">
													<tr>
														<td>Nama Album</td>
													</tr>
													<tr>
														<td><?php echo form_input(array('name'=>'title', 'class'=>'input-full')); ?></td>
													</tr>
												</table>
													<p id="dynamicUpload">
													    Gambar 1<br><input type="file" class="input-sparo" name="image0"><input type="text" class="input-sparo" name="alt0" placeholder="Alternatif Teks">
													</p>
													<input class="btn" type="button" value="Tambahkan Gambar Lainnya" onClick="addUpload('dynamicUpload');">											
																											
													<p>
														<?php $anu = "$('#con-load').show();"; echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Simpan' , 'onClick'=>$anu)) ?>
													</p>												
												
												</form>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>