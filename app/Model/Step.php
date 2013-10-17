<?php

class Step extends AppModel {
	var $belongsTo = array('Program');
	var $hasMany = array('IndicatorStep');
	var $order = 'Step.position ASC';

	/**
	* Returns the maximum position value for a given program plus one.
	**/
	public function getNextStepPosition($programId){
		$sql = "SELECT MAX(position) as 'next_position' from steps WHERE program_id = $programId";
		
		$results = $this->query($sql);
		
		foreach($results as $row){
			return $nextPosition = $row[0]['next_position'] + 1;
		}
	}
	
}

?>