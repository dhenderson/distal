<?php

class Organization extends AppModel {

	var $hasMany = array(
		'Program' => array('order' => 'Program.name ASC'), 
		'Outcome' => array('order' => 'Outcome.name ASC'), 
		'Indicator' => array('order' => 'Indicator.name ASC'), 
		'Intervention' => array('order' => 'Intervention.name ASC'), 
		'Target' => array('order' => 'Target.name ASC')
		);
	var $recursive = 2;
}

?>