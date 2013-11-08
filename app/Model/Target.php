<?php

class Target extends AppModel {

	var $hasMany = array('ProgramTarget', 'IndicatorTarget');
	var $belongsTo = array('Organization');
	var $recursive = 2;
	
	public function linkToProgram($targetId, $programId){
		$sql = "INSERT INTO program_targets (target_id, program_id) VALUES($targetId, $programId)";
		$this->query($sql);
	}
}

?>