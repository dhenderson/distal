<!-- File: /app/View/Program/add.ctp -->	
<?php
	echo $this->form->create('Program');
	echo $this->form->input('name');
	echo $this->form->input('organization_id', array('type'=>'hidden', 'value'=>$organizationId));
	echo $this->form->end('Save program');
?>