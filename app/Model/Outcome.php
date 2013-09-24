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
	);

	var $hasMany = array('Indicator', 'Intervention', 'OutcomeIntervention', 'ProgramOutcome');
	
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
}

?>