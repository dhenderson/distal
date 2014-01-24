<!-- File: /app/View/Organization/edit.ctp -->
<?php
	echo $this->form->create('Organization');
	echo $this->form->input('name');
	echo $this->form->input('id', array('type'=>'hidden'));
	echo $this->form->input('is_active');
	echo $this->form->end('Save organization');
?>
<div class="delete">
	<?php echo $this->html->link('Delete this organization', array('action' => 'delete', $organization['Organization']['id']), null, 'Are you sure?' )?>
</div>
