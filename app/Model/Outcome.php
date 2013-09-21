<?php

class Outcome extends AppModel {

	var $belongsTo = array(
		'ParentChildOutcome' => array(
			'className' => 'ParentChildOutcome',
			'foreignKey' => 'parent_outcome_id'),
		'Program'
	);
	var $hasMany = array(
		'ParentChildOutcome' => array(
			'className' => 'ParentChildOutcome',
			'foreignKey' => 'child_outcome_id'),
		'Indicator', 'Intervention'
	);
}

?>