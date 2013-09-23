<?php

class Outcome extends AppModel {

	var $belongsTo = array(
		'ParentOutcome' => array(
			'className' => 'ParentOutcome',
			'foreignKey' => 'id'),
		'Program'
	);
	var $hasMany = array(
		'ParentOutcome' => array(
			'className' => 'ParentOutcome',
			'foreignKey' => 'outcome_id'),
		'Indicator', 'Intervention'
	);
	
	/**
	* Gets the parent outcomes for the specified outcome ID
	* @params	$outcomeId	The outcome ID for the given outcome
	* @returns	An array of Outcome objects
	**/
	public function getParentOutcomes($outcomeId) {
		$sql = "SELECT * FROM Outcome 
			JOIN ParentChildOutcome 
			ON ParentChildOutcome.child_outcome_id = Outcome.id 
			WHERE ParentChildOutcome.child_outcome_id = $outcomeId";
			
		$parentOutcomes = $this->query($sql);
		return $parentOutcomes;
	}
}

?>