<?php

class Target extends AppModel {

	var $hasMany = array('ProgramTarget');
	
	public function linkToProgram($targetId, $programId){
		$sql = "INSERT INTO program_targets (target_id, program_id) VALUES($targetId, $programId)";
		$this->query($sql);
	}
}

?>