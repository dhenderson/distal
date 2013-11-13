<?php

class Outcome extends AppModel {

	public $hasAndBelongsToMany = array(
		'Parent' => array(
			'className' => 'Outcome',
			'joinTable' => 'program_outcomes',
			'foreignKey' => 'outcome_id',
			'associationForeignKey' => 'parent_outcome_id', 
			'unique' => true
		),
		'Child' => array(
			'className' => 'Outcome',
			'joinTable' => 'program_outcomes',
			'foreignKey' => 'parent_outcome_id',
			'associationForeignKey' => 'outcome_id', 
			'unique' => true
		), 
		'Indicator' => array(
			'className' => 'Indicator',
			'joinTable' => 'indicator_outcomes',
			'foreignKey' => 'outcome_id',
			'associationForeignKey' => 'indicator_id', 
			'unique' => true
		),
		'Intervention' => array(
			'className' => 'Intervention',
			'joinTable' => 'intervention_outcomes',
			'foreignKey' => 'outcome_id',
			'associationForeignKey' => 'intervention_id', 
			'unique' => true
		)
	);
	
	var $belongsTo = array('Organization');
	var $hasMany = array('ProgramOutcome');
	
	/**
	* Links a given outcome to the specified program and optionally a parent outcome
	* @param	$outcomeId			The outcome ID for the given outcome
	* @param	$programId			The program the outcome is to be linked to
	* @param	$parentOutcomeId	The parent outcome ID for the specified outcome
	**/
	public function linkToProgram($outcomeId, $programId, $parentOutcomeId = null){
		if($parentOutcomeId) {
			$sql = "INSERT INTO program_outcomes (outcome_id, program_id, parent_outcome_id) 
				VALUES ($outcomeId, $programId, $parentOutcomeId)";
		}
		else {
			$sql = "INSERT INTO program_outcomes (outcome_id, program_id) 
				VALUES ($outcomeId, $programId)";
		}
			
		$this->query($sql);
	}
	
	public function removeFromParentOutcome($outcomeId, $programId, $parentOutcomeId){
		$sql = "UPDATE program_outcomes 
			SET parent_outcome_id = NULL
			WHERE outcome_id = $outcomeId AND 
			program_id = $programId AND 
			parent_outcome_id = $parentOutcomeId";
			
		$this->query($sql);
	}
	
	public function removeFromProgram($outcomeId, $programId, $parentOutcomeId = null){
		if($parentOutcomeId) {
			$sql = "DELETE FROM program_outcomes 
				WHERE outcome_id = $outcomeId AND 
				program_id = $programId AND 
				parent_outcome_id = $parentOutcomeId";
		}
		else {
			$sql = "DELETE FROM program_outcomes 
				WHERE outcome_id = $outcomeId AND 
				program_id = $programId";
		}
			
		$this->query($sql);
	}
}

?>