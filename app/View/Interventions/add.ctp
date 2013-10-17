<!-- File: /app/View/Intervention/add.ctp -->	

<?php
	echo $this->form->create('Intervention');
	echo $this->form->input('name');
	echo $this->form->input('program_id', array('type'=>'hidden', 'value'=>$programId));
	
	echo $this->form->end('Save intervention');
?>