<!-- File: /app/View/Indicator/add.ctp -->	
<?php
	echo $this->form->create('Indicator');
	echo $this->form->input('name');
	echo $this->form->input('answer_options');
	echo $this->form->input('organization_id', array('type'=>'hidden', 'value'=>$organizationId));
	echo $this->form->end('Save indicator');
?>
	