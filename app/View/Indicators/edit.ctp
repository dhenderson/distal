<!-- File: /app/View/Indicators/edit.ctp -->
<?php
	echo $this->form->create('Indicator');
	echo $this->form->input('name');
	echo $this->form->input('id', array('type'=>'hidden'));
	echo $this->form->end('Save');
?>

</div>