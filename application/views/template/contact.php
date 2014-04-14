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
			 		<?php echo $paragraf; ?>
			 	</div>
			 	
			 	<style type="text/css">
			 	#form {
			 		padding-bottom : 15px;
			 	}
			 	#form label {
			 		font-size: 12px;
			 		color: #333;
			 	}
			 	#form .input {
			 		border: 1px solid #ccc;
			 		height: 30px;
			 		padding-left: 5px;
			 		width: 70%;
			 	}
			 	#form .textarea {
			 		border: 1px solid #ccc;
			 		height: 150px;
			 		padding-left: 5px;
			 		width: 70%;
			 		resize: vertical;
			 	}
			 	#form .tombol {
			 		display: inline-block;
				  *display: inline;
				  padding: 4px 10px 4px;
				  margin-bottom: 0;
				  *margin-left: .3em;
				  font-size: 13px;
				  line-height: 18px;
				  *line-height: 20px;
				  color: #333333;
				  text-align: center;
				  text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
				  vertical-align: middle;
				  cursor: pointer;
				  background-color: #E6E6E6;
				  *background-color: #bd362f;
				  background-image: -ms-linear-gradient(top, #eaeaea, #999999);
				  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#eaeaea), to(#999999));
				  background-image: -webkit-linear-gradient(top, #eaeaea, #999999);
				  background-image: -o-linear-gradient(top, #eaeaea, #999999);
				  background-image: -moz-linear-gradient(top, #eaeaea, #999999);
				  background-image: linear-gradient(top, #eaeaea, #999999);
				  background-repeat: repeat-x;
				  border-color: #bd362f #bd362f #802420;
				  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
				  filter: progid:dximagetransform.microsoft.gradient(startColorstr='#ee5f5b', endColorstr='#bd362f', GradientType=0);
				  filter: progid:dximagetransform.microsoft.gradient(enabled=false);
				  
				  -webkit-border-radius: 4px;
				     -moz-border-radius: 4px;
				          border-radius: 4px;
			 	}
			 	</style>
			 	<div id="form">
			 		<?php
			 		if($this->session->flashdata('flashOK')){
			 			echo "<span style='color:#4F8746'>".$this->session->flashdata('flashOK')."</span>";
			 		}
			 		if($this->session->flashdata('flashNO')){
			 			echo "<span style='color:#ff0000'>".$this->session->flashdata('flashNO')."</span>";
			 		}
			 		?>
			 		<?php echo form_open(base_url('mail/send_mail')); ?>
			 			<?php echo form_label('Nama Lengkap :', 'name'); ?><br>
			 			<?php echo form_input(array('name'=>'name', 'class'=>'input', 'placeholder'=>'Nama Lengkap')); ?><br>
			 			<?php if(form_error('name')){ echo '<span style="color:#ff0000">'.form_error('name').'</span><br>'; } ?>
			 			<?php echo form_label('Email :', 'email'); ?><br>
			 			<?php echo form_input(array('name'=>'email', 'class'=>'input', 'placeholder'=>'email anda')); ?><br>
			 			<?php if(form_error('name')){ echo '<span style="color:#ff0000">'.form_error('name').'</span><br>'; } ?>
			 			<?php echo form_label('Judul Pesan :', 'subject'); ?><br>
			 			<?php echo form_input(array('name'=>'subject', 'class'=>'input', 'placeholder'=>'judul pesan')); ?><br>
			 			<?php if(form_error('name')){ echo '<span style="color:#ff0000">'.form_error('name').'</span><br>'; } ?>
			 			<?php echo form_label('Pesan :', 'message'); ?><br>
			 			<?php echo form_textarea(array('name'=>'message', 'class'=>'textarea', 'placeholder'=>'pesan untuk kami')); ?><br>
			 			<?php if(form_error('name')){ echo '<span style="color:#ff0000">'.form_error('name').'</span><br>'; } ?>
			 			<?php echo form_submit(array('name'=>'submit', 'class'=>'tombol', 'value'=>'Kirim')); ?>
			 		<?php echo form_close(); ?>
			 	</div>
			 </div>
			 <div class="clear"></div>
		</div>
	<div class="clear">

		<!--KONTEN UTAMA SELESAI-->
		<div class="clear"></div>