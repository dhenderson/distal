<!-- File: /app/View/Users/add.ctp -->	
<?php
	echo $form->create('User');
	echo $form->input('first_name');
	echo $form->input('last_name');
	echo $form->input('email');
	echo $form->input('password');
	
	echo $form->input('user_group_id', array('type'=>'select', 'options'=>$userGroups, 'default'=>$user['User']['user_group_id']));
	
	echo $form->input('active');
	if($isSystemAdmin){
		echo $form->input('system_admin');
	}	
	
	echo $form->end('Save User');
?>