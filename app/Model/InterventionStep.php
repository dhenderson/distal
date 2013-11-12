<?php

class InterventionStep extends AppModel {
	var $belongsTo = array(
		'Step' => array('order' => 'Step.name ASC'), 
		'Intervention' => array('order' => 'Intervention.name ASC'), 
		'Program'  => array('order' => 'Program.name ASC')
	);
	var $recursive =2;
}

?>