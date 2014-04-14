<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/image/style.css'); ?>" />
		<link rel="shortcut icon" href="<?php echo base_url('assets/image/logo-jogjahost.png'); ?>" />
	</head>
	<body>
		<div id="form-login" style="margin-top: 150px;">
			<div id="title">
				<h1>Reset Password</h1>
			</div>
			<div id="isi">
				<?php if($this->session->flashdata('flashNO')): ?>
				<div class="error">
					<p>
						<?php echo $this->session->flashdata('flashNO'); ?>
					</p>
				</div>
				<?php endif ?>
				<?php if($this->session->flashdata('flashOK')): ?>
				<p>
					<?php echo $this->session->flashdata('flashOK'); ?>
				</p>
				<?php endif ?>

				<div class="error">
					<?php echo form_error('username'); ?>
				</div>

				<?php echo form_open(base_url('ngadmin/lupa'), array('id'=>'form_lupa')); ?>
					<?php echo form_label('Username kamu :', 'username'); ?>
					<?php echo form_input(array('name'=>'username', 'class'=>'input', 'autocomplete'=>'off', 'placeholder'=>'username')); ?><br />
					
					<?php echo anchor('ngadmin/', 'Batal', 'title="batalkan" class="btn-forgot"'); ?>
					<?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey kanan', 'value'=>'Lanjut')); ?>
				<?php echo form_close(); ?>
			</div>
		</div>
		
	</body>
</html>