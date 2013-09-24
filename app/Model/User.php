<?php

class User extends AppModel {
	var $hasMany = array('UserAdvisoryGroup');
	
	
	/**
	* Returns an array of AdvisoryGroup IDs a user is assigned to
	* @params	$userId		User ID for a given user
	* @returns	array of AdvisoryGroup IDs
	**/
	function getAdvisoryGroupIds($userId){
		
		$advisoryGroupIds = array();
	
		$userAdvisoryGroups = $this->UserAdvisoryGroup->find(
			'all', 
			array('conditions' => array('UserAdvisoryGroup.user_id' => $userId))
		);
		
		foreach ($userAdvisoryGroups as $userAdvisoryGroup) {
			$advisoryGroupIds[] = $userAdvisoryGroup['UserAdvisoryGroup']['advisory_group_id'];
		}
		
		return $advisoryGroupIds;
	}
}

?>