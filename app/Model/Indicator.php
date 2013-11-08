<?php

class Indicator extends AppModel {
	var $hasMany = array('IndicatorOutcome', 'IndicatorStep');
	var $belongsTo = array('Organization', 'DataType', 'AnswerOptionType');
	
	public function linkToOutcome($indicatorId, $outcomeId, $programId){
		$sql = "INSERT INTO indicator_outcomes (indicator_id, outcome_id, program_id) 
			VALUES ($indicatorId, $outcomeId, $programId)";
			
		$this->query($sql);
	}
	
	public function linkToTarget($indicatorId, $targetId, $programId){
		$sql = "INSERT INTO indicator_targets (indicator_id, target_id, program_id) 
			VALUES ($indicatorId, $targetId, $programId)";
			
		$this->query($sql);
	}
	
	public function linkToStep($indicatorId, $stepId, $programId){
		$sql = "INSERT INTO indicator_steps (indicator_id, step_id, program_id) 
			VALUES ($indicatorId, $stepId, $programId)";
			
		$this->query($sql);
	}
	
}

?>