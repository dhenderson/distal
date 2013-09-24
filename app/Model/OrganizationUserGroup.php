<?php

class OrganizationUserGroup extends AppModel {
	var $belongsTo = array('Organization', 'UserGroup');
	
	/**
	* Removes a user group from an organization
	* @param	$organizationId	the ID of the specified organization
	* @param	$userGroupId	the ID of the specified user group
	**/
	public function removeUserGroupFromOrganization($organizationId, $userGroupId){
		$sql = "DELETE FROM organization_user_groups 
			WHERE organizations.id = $organizationId 
			AND user_groups.id = $userGroupId";
			
		$this->query($sql);
	}
	
	public function addUserGroupToOrganization($organizationId, $userGroupId, $canEdit = True){
		$sql = "INSERT INTO organization_user_groups 
			(organization_user_groups.organization_id, organization_user_groups.user_group_id) 
			VALUES ($organizationId, $userGroupId)";
			
		$this->query($sql);
	}
}

?>