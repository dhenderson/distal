<!-- File: /app/View/Organization/add.ctp -->	
<?php
	echo $this->form->create('Organization');
	echo $this->form->input('name');
	echo $this->form->end('Save organization');
?>