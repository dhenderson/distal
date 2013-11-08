<!-- File: /app/View/Indicators/edit.ctp -->
<?php
	echo $this->form->create('Indicator');
	echo $this->form->input('name');
	echo $this->form->input('id', array('type'=>'hidden'));
	echo $this->form->input('data_type_id');
	echo $this->form->input('answer_option_type_id');
	echo $this->form->input('answer_options');
	echo $this->form->input('organization_id', array('type'=>'hidden'));
	echo $this->form->end('Save');
?>