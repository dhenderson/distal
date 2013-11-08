<!-- File: /app/View/Program/edit.ctp -->
<?php
	echo $this->form->create('Target');
	echo $this->form->input('name');
	echo $this->form->input('id', array('type'=>'hidden'));
	echo $this->form->end('Save');
?>