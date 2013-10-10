<?php

class InterventionOutcome extends AppModel {
	var $belongsTo = array(
		'Outcome' => array('order' => 'Outcome.name ASC'), 
		'Intervention' => array('order' => 'Intervention.name ASC'), 
		'Program'  => array('order' => 'Program.name ASC')
	);
	var $recursive =2;
}

?>