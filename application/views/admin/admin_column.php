			<script type="text/javascript">
			$(function() {

					$("#content").ready(function(){
							$("#tampiljenis1").change();
							$("#tampiljenis2").change();
							$("#tampiljenis3").change();

							$.ajax({
							url:"<?php echo site_url() ?>tema/ambil_checked",
							type:"post",
							dataType:"json",
							success:function(data){
							$('#tampilisi1').val(data.isi1);
							$('#tampilisi2').val(data.isi2);
							$('#tampilisi3').val(data.isi3);
						
							}
							
							});
							return false;			
						});


				$("#tampiljenis1").change(function(){
						var ambilValueJenis1 = $("#ambilValueJenis1:checked").val();
						$.ajax({
							url:"<?php echo site_url() ?>tema/ambil_kolom",
							type:"post",
							data:"ambilValueJenis1="+ambilValueJenis1,
							success:function(data){
								
							$('#tampilisi1').html(data);
							}
							
							});
							return false;						
						});

				$("#tampiljenis2").change(function(){
						var ambilValueJenis2 = $("#ambilValueJenis2:checked").val();
						$.ajax({
							url:"<?php echo site_url() ?>tema/ambil_kolom",
							type:"post",
							data:"ambilValueJenis2="+ambilValueJenis2,
							success:function(data){
								
							$('#tampilisi2').html(data);
							
							}
							
							});
							return false;						
						});
				$("#tampiljenis3").change(function(){
						var ambilValueJenis3 = $("#ambilValueJenis3:checked").val();
						$.ajax({
							url:"<?php echo site_url() ?>tema/ambil_kolom",
							type:"post",
							data:"ambilValueJenis3="+ambilValueJenis3,
							success:function(data){
								
							$('#tampilisi3').html(data);
							
							}
							
							});
							return false;						
						});

				
			});
			</script>
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

						<?php for($i=1;$i<3;$i++){ ?>
						<?php if($this->session->flashdata('flashNO'.$i)): ?>
						<div id="notif" class="peringatan">
							<p><i class="icon-exclamation-sign icon-large"></i><?php echo $this->session->flashdata('flashNO'.$i); ?></p>
						</div>
						<?php endif; } ?>

						<?php if($this->session->flashdata('flashNOP')): ?>
						<div id="notif" class="peringatan">
							<?php echo $this->session->flashdata('flashNOP'); ?>
						</div>
						<?php endif ?>


						<div id="notif" class="peringatan">
							<?php 
							$jum = 3;
							for($i=1;$i<=$jum;$i++)
								{ ?>
							<?php echo form_error('judul'.$i); ?>
							<?php echo form_error('limit'.$i); ?>
							<?php } ?>
						</div>
								<div class="twin-wrapper">
									<div class="twinner">
										<form method="post" action="<?php echo base_url('tema/save'); ?>">
										<?php $jum =3; for($i=1;$i<=$jum;$i++) { ?>
										<div class="twin-container twin30 twin-akhir" style="margin-bottom:0px;px;">
											<div class="twin">
											<div class="title" style="text-align:center"> Pengaturan Kolom <?php echo $i?> </div>
												<table class="table-column">
													<tr>
														<td>Judul Kolom</td>
														<td><input style="text-align:center" type="text" name="judul<?php echo $i?>" value="<?php echo ${'judul'.$i}; ?>" placeholder="Judul Kolom"></td>
													</tr>
													<tr>
														<td>Jumlah Row</td>
														<td id="inputCheck"><input style="text-align:center" type="text" name="limit<?php echo $i?>" value="<?php echo ${'limit'.$i}; ?>" placeholder="Jumlah yang di tampilkan"></td>
													</tr>
													<tr>
														<td>Jenis Isi Kolom</td>
														<td class="isi">
														<select id="tampiljenis<?php echo $i?>" name="jenis<?php echo $i?>" class="dropdown" style="width:100%">
															<option id="ambilValueJenis<?php echo $i?>" value="model_news" <?php echo (${'jenis'.$i} == 'model_news') ? 'selected' :'' ?>>Semua Konten</option>
															<option id="ambilValueJenis<?php echo $i?>" value="model_label_relation" <?php echo (${'jenis'.$i} == 'model_label_relation') ? 'selected' :'' ?>>Konten</option>
															<option id="ambilValueJenis<?php echo $i?>" value="model_widget" <?php echo (${'jenis'.$i} == 'model_widget') ? 'selected' :'' ?>>Widget</option>
															<option id="ambilValueJenis<?php echo $i?>" value="model_feature" <?php echo (${'jenis'.$i} == 'model_feature') ? 'selected' :'' ?>>Fitur</option>
														</select>
														</td>
													</tr> 
													<tr>
														<td>Isi Kolom</td>
														<td class="isi">
														<select id="tampilisi<?php echo $i?>" name="isi<?php echo $i?>" class="dropdown" style="width:100%">
															<option value="0"  <?php echo ($isi1 == '0') ? 'selected' :''; ?>>[ Isi Kolom <?php echo $i?> ]</option>
														</select>
														</td>
													</tr> 
													<!-- <tr> 
														<td class="isi">		
															<select id="tampilbentuk<?php echo $i?>" name="bentuk<?php echo $i?>" class="dropdown">
																<option id="" >[ Bentuk Kolom <?php echo $i?>]</option>
															</select>
														</td>
													</tr> -->
													
												</table>
											</div>
										</div>
										<?php } ?>
										<div class="clear"></div>
										<div style="margin-left:20px;">
										<input type="submit" name="submit" value="Simpan" class="btn btn-grey">
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
