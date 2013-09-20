<!-- File: /app/View/Users/edit.ctp -->
<?php
	echo $this->form->create('User');
	echo $this->form->input('first_name');
	echo $this->form->input('last_name');
	echo $this->form->input('email');
	echo $this->form->input('password');
	echo $this->form->input('active');
	if($isSystemAdmin) {
		echo $this->form->input('system_admin');
	}		
	echo $this->form->input('user_id', array('type'=>'hidden'));
	
	echo $this->form->end('Save User');
?>