<!-- File: /app/View/UserGroups/edit.ctp -->
<?php
	echo $this->form->create('UserGroup');
	echo $this->form->input('name');
	echo $this->form->input('active');
	echo $this->form->input('id', array('type'=>'hidden'));
	echo $this->form->end('Save group');
?>