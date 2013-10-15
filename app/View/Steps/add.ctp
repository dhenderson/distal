<!-- File: /app/View/Steps/add.ctp -->	
<?php
	echo $this->form->create('Step');
	echo $this->form->input('name');
	echo $this->form->input('description');
	echo $this->form->input('position');
	echo $this->form->input('program_id', array('type'=>'hidden', 'value'=>$programId));
	echo $this->form->end('Save');
?>
