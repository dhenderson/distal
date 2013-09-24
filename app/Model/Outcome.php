<?php

class Outcome extends AppModel {

	public $hasAndBelongsToMany = array(
		'Parent' => array(
			'className' => 'Outcome',
			'joinTable' => 'parent_outcomes',
			'foreignKey' => 'outcome_id',
			'associationForeignKey' => 'parent_outcome_id', 
			'unique' => true
		)
	);

	var $belongsTo = array('Program');
	var $hasMany = array('Indicator', 'Intervention');
	
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