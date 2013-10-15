<?php

class Program extends AppModel {

	var $belongsTo = array('Organization');
	var $hasMany = array(
		'ProgramOutcome', 
		'IndicatorOutcome', 
		'InterventionOutcome',
		'IndicatorStep',
		'ProgramTarget',
		'Step'
	);
	
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
	
	function getIndicatorIds($programId){
		
		$indicatorIds = array();
	
		$indicatorOutcomes = $this->IndicatorOutcome->find(
			'all', 
			array(
				'conditions' => array('IndicatorOutcome.program_id' => $programId),
				'fields' => array('DISTINCT IndicatorOutcome.indicator_id')
			)
		);
		
		foreach ($indicatorOutcomes as $indicatorOutcome) {
			$indicatorIds[] = $indicatorOutcome['IndicatorOutcome']['indicator_id'];
		}
		
		return $indicatorIds;
	}
	
	function getInterventionIds($programId){
		
		$interventionIds = array();
	
		$interventionOutcomes = $this->InterventionOutcome->find(
			'all', 
			array(
				'conditions' => array('InterventionOutcome.program_id' => $programId),
				'fields' => array('DISTINCT InterventionOutcome.intervention_id')
			)
		);
		
		foreach ($interventionOutcomes as $interventionOutcome) {
			$interventionIds[] = $interventionOutcome['InterventionOutcome']['intervention_id'];
		}
		
		return $interventionIds;
	}
}

?>