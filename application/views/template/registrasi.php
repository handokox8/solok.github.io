<!DOCTYPE html>
<html>
	<head>
		<title>Form REgistrasi</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/image/style.css'); ?>" />
		<link rel="shortcut icon" href="<?php echo base_url('assets/image/logo-jogjahost.png'); ?>" />
	</head>
	<body OnLoad="document.<?php echo $form_load; ?>.nama.focus();">
		<div id="form-login">
			<div id="form-login-logo">
				
			</div>
			<div id="title">
				<h1>Registrasi</h1>
			</div>
			<div id="isi">
					<?php if($this->session->flashdata('flashOK')): ?>
					<div class="berhasil">
						<p><i class="icon-ok icon-large"> </i><?php echo $this->session->flashdata('flashOK'); ?></p>
					</div>
					<?php endif ?>
					<?php if($this->session->flashdata('flashNO')): ?>
					<div class="error">
						<p><i class="icon-exclamation-sign icon-large"> </i><?php echo $this->session->flashdata('flashNO'); ?></p>
					</div>
					<?php endif ?>

					<?php echo form_error('nama'); ?>
					<?php echo form_error('username'); ?>
					<?php echo form_error('email'); ?>
					<?php echo form_error('password'); ?>
					<?php echo form_error('password2'); ?>

				<?php echo form_open(base_url('member/daftar'),array('name'=>'myform')); ?>
					<?php echo form_label('Nama Pengguna :', 'nama'); ?>
					<?php echo form_input(array('name'=>'nama', 'id'=>'nama', 'class'=>'input-login', 'autocomplete'=>'off', 'placeholder'=>'Nama pengguna')); ?>
					<?php echo form_label('Username :', 'user'); ?>
					<?php echo form_input(array('name'=>'username', 'id'=>'user', 'class'=>'input-login', 'autocomplete'=>'off', 'placeholder'=>'Username')); ?>
					<?php echo form_label('Email :', 'em'); ?>
					<?php echo form_input(array('name'=>'email', 'id'=>'em', 'class'=>'input-login', 'autocomplete'=>'off', 'placeholder'=>'Alamat Email')); ?>
					<?php echo form_label('Kata Kunci', 'kunci'); ?>
					<?php echo form_password(array('name'=>'password','id'=>'kunci', 'class'=>'input-login', 'autocomplete'=>'off', 'placeholder'=>'Kata Kunci Kamu')); ?>

					<?php echo form_label('Ulangi Kata Kunci', 'kunci2'); ?>
					<?php echo form_password(array('name'=>'password2', 'class'=>'input-login', 'autocomplete'=>'off', 'placeholder'=>'Kata Kunci Kamu')); ?>
					<?php echo form_submit(array('name'=>'submit', 'id'=>'kunci2', 'class'=>'btn btn-grey kanan', 'value'=>'Daftar')); ?>
				<?php echo form_close(); ?>

				<div style="clear:both;"></div>
				<div style="font-size: 12px;">
					<a href="<?php echo base_url('member/login'); ?>" style="color: #005E8A;">Login</a> | <a href="<?php echo base_url(); ?>" style="color: #005E8A;">Kembali Ke Situs</a>
				</div>
			</div>
		</div>
		
	</body>
</html>