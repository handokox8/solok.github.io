<!DOCTYPE html>
<html>
	<head>
		<title>Form LOgin</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/image/style.css'); ?>" />
		<link rel="shortcut icon" href="<?php echo base_url('assets/image/logo-jogjahost.png'); ?>" />
	</head>
	<body OnLoad="document.<?php echo $form_load; ?>.username.focus();">
		<div id="form-login"><div id="form-login-logo">
				
			</div>
			<div id="title">
				<h1>Member</h1>
			</div>
			<div id="isi">
					<?php if($this->session->flashdata('flashOK')): ?>
					<div class="berhasil" >
						<p><i class="icon-ok icon-large"> </i><?php echo $this->session->flashdata('flashOK'); ?></p>
					</div>
					<?php endif ?>
					<?php if($this->session->flashdata('flashNO')): ?>
					<div class="error">
						<p><i class="icon-exclamation-sign icon-large"> </i><?php echo $this->session->flashdata('flashNO'); ?></p>
					</div>
					<?php endif ?>

				<div class="error">
					<?php echo form_error('username'); ?>
					<?php echo form_error('password'); ?>
				</div>

				<?php echo form_open(base_url('member/login'),array('name'=>'myform')); ?>
					<?php echo form_label('Nama Pengguna :', 'username'); ?>
					<?php echo form_input(array('name'=>'username', 'class'=>'input-login', 'autocomplete'=>'off', 'placeholder'=>'Nama pengguna')); ?>
					<?php echo form_label('Kata Kunci', 'password'); ?>
					<?php echo form_password(array('name'=>'password', 'class'=>'input-login', 'autocomplete'=>'off', 'placeholder'=>'Kata Kunci Kamu')); ?>
					<?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey kanan', 'value'=>'Masuk')); ?>
				<?php echo form_close(); ?>

				<div style="clear:both;"></div>
				<div style="font-size: 12px;">
					<a href="<?php echo base_url('member/registrasi'); ?>" style="color: #005E8A;">Daftar</a> | <a href="<?php echo base_url(); ?>" style="color: #005E8A;">Kembali Ke-halaman situs</a>
				</div>
			</div>
		</div>
		
	</body>
</html>