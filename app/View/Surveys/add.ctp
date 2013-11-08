<!-- File: /app/View/Survey/add.ctp -->	
<?php
	echo $this->form->create('Survey');
	echo $this->form->input('name');
	echo $this->form->input('program_id', array('type'=>'hidden', 'value'=>$programId));
	echo $this->form->end('Save');
?>