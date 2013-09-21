<?php

class User extends AppModel {
	var $hasMany = array('UserUserGroup');
	
	
	/**
	* Returns an array of UserGroup IDs a user is assigned to
	* @params	$userId		User ID for a given user
	* @returns	array of UserGroup IDs
	**/
	function getUserGroupIds($userId){
		
		$userGroupIds = array();
	
		$userUserGroups = $this->UserUserGroup->find(
			'all', 
			array('conditions' => array('UserUserGroup.user_id' => $userId))
		);
		
		foreach ($userUserGroups as $userUserGroup) {
			$userGroupIds[] = $userUserGroup['UserUserGroup']['user_group_id'];
		}
		
		return $userGroupIds;
	}
}

?>