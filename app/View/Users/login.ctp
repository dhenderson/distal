<!-- File: /app/View/Users/login.ctp -->
<div>
	<?php echo $this->form->create('User'); ?>
	<div>Sign in to your account</div>
	<div>
		<strong>Email</strong><br />
		<?php echo $this->form->text('email', array('size' => 35));?>
	</div>
	<div style="margin-top: 10px;">
		<strong>Password</strong><br />
		<?php echo $this->form->password('password', array('size' => 35));?>
	</div>
	<?php if ($error): ?>
		<div style="margin-top: 5px; color: #CC0000;">
			The login credentials you supplied could not be recognized. Please try again.
		</div>
	<?php endif; ?>
	<div style="margin-top: 10px;">
		<?php echo $this->form->end('Login'); ?>
	</div>
</div>

