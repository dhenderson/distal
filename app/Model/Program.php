<?php

class Program extends AppModel {

	var $belongsTo = array('Organization');
	var $hasMany = array('ProgramOutcome', 'Target');
	
	/**
	* Returns an array of outcome IDs attached to this program
	* @params	$programId		Program ID for a given program
	* @returns	array of outcome IDs
	**/
	function getOutcomeIds($programId){
		
		$outcomeIds = array();
	
		$programOutcomes = $this->ProgramOutcome->find(
			'all', 
			array(
				'conditions' => array('ProgramOutcome.program_id' => $programId),
				'fields' => array('DISTINCT ProgramOutcome.outcome_id')
				
			)
		);
		
		foreach ($programOutcomes as $programOutcome) {
			$outcomeIds[] = $programOutcome['ProgramOutcome']['outcome_id'];
		}
		
		return $outcomeIds;
	}
}

?>