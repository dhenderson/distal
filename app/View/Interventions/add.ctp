<!-- File: /app/View/Intervention/add.ctp -->	

<?php
	echo $this->form->create('Intervention');
	echo $this->form->input('name');
	echo $this->form->input('organization_id', array('type'=>'hidden', 'value'=>$organizationId));
	
	echo $this->form->end('Save intervention');
?>