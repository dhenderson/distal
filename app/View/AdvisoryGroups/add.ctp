<!-- File: /app/View/AdvisoryGroup/add.ctp -->	
<?php
	echo $form->create('AdvisoryGroup');
	echo $form->input('name');
	echo $form->input('active');	
	echo $form->end('Save advisory group');
?>