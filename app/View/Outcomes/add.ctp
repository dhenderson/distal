<!-- File: /app/View/Outcome/add.ctp -->	
<?php
	echo $this->form->create('Outcome');
	echo $this->form->input('name');
	echo $this->form->input('description');
	echo $this->form->input('program_id', array('type'=>'hidden', 'value'=>$programId));
	
	echo $this->form->end('Save outcome');
?>