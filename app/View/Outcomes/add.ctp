<!-- File: /app/View/Outcome/add.ctp -->	
<?php
	echo $this->form->create('Outcome');
	echo $this->form->input('name');
	echo $this->form->input('organization_id', array('type'=>'hidden', 'value'=>$organizationId));
	
	echo $this->form->end('Save outcome');
?>
	