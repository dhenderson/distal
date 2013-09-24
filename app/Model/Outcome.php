<?php

class Outcome extends AppModel {

	public $hasAndBelongsToMany = array(
		'Parent' => array(
			'className' => 'Outcome',
			'joinTable' => 'parent_outcomes',
			'foreignKey' => 'outcome_id',
			'associationForeignKey' => 'parent_outcome_id', 
			'unique' => true
		),
		'Child' => array(
			'className' => 'Outcome',
			'joinTable' => 'parent_outcomes',
			'foreignKey' => 'parent_outcome_id',
			'associationForeignKey' => 'outcome_id', 
			'unique' => true
		),
	);

	var $hasMany = array('Indicator', 'Intervention', 'OutcomeIntervention', 'ProgramOutcome');
	
	/**
	* Links a given outcome to the specified program
	* @params	$outcomeId	The outcome ID for the given outcome
	* @params	$programId	The program the outcome is to be linked to
	**/
	public function linkToProgram($outcomeId, $programId){
		$sql = "INSERT INTO program_outcomes (outcome_id, program_id) 
			VALUES ($outcomeId, $programId)";
			
		$this->query($sql);
	}
	
	/**
	* Links a given outcome to the specified parent outcome
	* @params	$outcomeId	The outcome ID for the given outcome
	* @params	$parentOutcomeId	The parent outcome the specified outcome is being linked to
	**/
	public function linkToParentOutcome($outcomeId, $parentOutcomeId){
		$sql = "INSERT INTO parent_outcomes (outcome_id, parent_outcome_id) 
			VALUES ($outcomeId, $parentOutcomeId)";
			
		$this->query($sql);
	}
}

?>