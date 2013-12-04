<!-- File: /app/View/Users/setup.ctp -->	

<h1>Welcome to Distal, create a user account to get started</h1>
<?php
	echo $this->form->create('User');
	echo $this->form->input('first_name');
	echo $this->form->input('last_name');
	echo $this->form->input('email');
	echo $this->form->input('password');
	
	echo $this->form->input('active', array('type'=>'hidden', 'value'=>true));
	echo $this->form->input('system_admin', array('type'=>'hidden', 'value'=>true));
	
	echo $this->form->end("Let's get started");
?>