<!-- File: /app/View/Organization/add.ctp -->	
<?php
	echo $this->form->create('Organization');
	echo $this->form->input('name');
	echo $this->form->input('description');
	echo $this->form->input('active');
	if($advisoryGroupId) {
		echo $this->form->input('advisory_group_id', array('type'=>'hidden', 'value'=>$advisoryGroupId));
	}
	echo $this->form->end('Save organization');
?>