<!-- File: /app/View/Organization/add.ctp -->	
<?php
	echo $this->form->create('Organization');
	echo $this->form->input('name');
	echo $this->form->input('description');
	echo $this->form->input('active');
	echo $this->form->input('user_group_id', array('type'=>'hidden', 'value'=>$userGroupId));
	
	echo $this->form->end('Save organization');
?>