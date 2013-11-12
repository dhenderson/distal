<!-- File: /app/View/Steps/edit.ctp -->
<?php
	echo $this->form->create('Step');
	echo $this->form->input('name');
	echo $this->form->input('position');
	echo $this->form->input('program_id', array('type'=>'hidden'));
	echo $this->form->end('Save');
?>
<div class="delete">
<?php echo $this->html->link('Delete this step', array('action' => 'delete', $step['Step']['id']), null, 'Are you sure?' )?>
</div>