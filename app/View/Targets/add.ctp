<!-- File: /app/View/Target/add.ctp -->	
<?php
	echo $this->form->create('Target');
	echo $this->form->input('name');
	echo $this->form->input('description');
	echo $this->form->input('organization_id', array('type'=>'hidden', 'value'=>$organizationId));
	echo $this->form->end('Save program');
?>