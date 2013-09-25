<?php

class Indicator extends AppModel {
	var $hasMany = array('IndicatorOutcome');
	var $belongsTo = array('Organization');
	
	public function linkToOutcome($indicatorId, $outcomeId, $programId){
		$sql = "INSERT INTO indicator_outcomes (indicator_id, outcome_id, program_id) 
			VALUES ($indicatorId, $outcomeId, $programId)";
			
		$this->query($sql);
	}
}

?>