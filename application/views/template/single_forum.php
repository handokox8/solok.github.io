		<!--KONTEN UTAMA MULAI-->


		
		<!--KONTEN UTAMA MULAI-->

	<div id="bodi-background">
		<div class="content-left" style="margin-top:10px;">
			 <?php $this->load->view('template/sidebar'); ?>
			</div>
			 <div id="content">
			 	<div class="content-title">
			 		<h2><?php echo $title; ?></h2>
			 	</div>
			 	<div class="content-isi">
			 		<?php if(isset($tanggal)) { ?><div class="tanggal"><?php echo $tanggal; ?></div><?php } else {  } ?>
					<?php echo $paragraf; ?>
			 	</div>
				 	<?php
						if($komen_all == "NULL"){
							echo 'Belum Ada komentar';
						} else {
	                         foreach ($komen_all as $komen) {
	                         ?>	
			 						<ul class="content-list">
                                        <li>
                                			<h3><?php echo $komen->namaFolower; ?></h3>
                                			
                                			<div class="tanggal"><?php echo $komen->tanggal; ?></div>
                                       		<div class="content-line"></div>
                                			<p>
                                        	<?php echo strip_tags($komen->komentar); ?>
                                       		</p>
                                       		
                                        </li>
                                    </ul>

                                    <div class="clear"></div>
                         <?php }} ?>
			 	<?php
			 	if($this->session->userdata('idFolower')){
			 		?>
			 		<div id="komen">
					 	<?php echo form_open(base_url('forum/komentar')); ?>
					 		<?php echo form_hidden('kdForum', $forum_id->idForum); ?>
					 		<?php echo form_hidden('kdUrl', current_url()); ?>
					 		<?php echo form_label('Komentar Anda :', 'komen'); ?><br>
					 		<?php echo form_textarea(array('name'=>'komen', 'class'=>'textarea')); ?><br>
					 		<?php echo form_submit(array('name'=>'submit', 'class'=>'tombol', 'value'=>'Komentar')); ?>
					 	<?php echo form_close(); ?>
					 </div>
			 		<?php
			 	} else {

			 	}
			 	?>
			 </div>
			 <div class="clear"></div>
		</div>
	<div class="clear">

		<!--KONTEN UTAMA SELESAI-->
		<div class="clear"></div>