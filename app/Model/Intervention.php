<?php

class Intervention extends AppModel {
	var $hasMany = array('InterventionOutcome');
	var $belongsTo = array('Organization');
	
	public function linkToOutcome($interventionId, $outcomeId, $programId){
		$sql = "INSERT INTO intervention_outcomes (intervention_id, outcome_id, program_id) 
			VALUES ($interventionId, $outcomeId, $programId)";
			
		$this->query($sql);
	}
}

?>