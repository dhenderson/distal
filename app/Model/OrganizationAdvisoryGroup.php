<?php

class OrganizationAdvisoryGroup extends AppModel {
	var $belongsTo = array('Organization', 'AdvisoryGroup');
	
	/**
	* Removes a user group from an organization
	* @param	$organizationId	the ID of the specified organization
	* @param	$advisoryGroupId	the ID of the specified advisory group
	**/
	public function removeAdvisoryGroupFromOrganization($organizationId, $advisoryGroupId){
		$sql = "DELETE FROM organization_advisory_groups 
			WHERE organizations.id = $organizationId 
			AND advisory_groups.id = $advisoryGroupId";
			
		$this->query($sql);
	}
	
	public function addAdvisoryGroupToOrganization($organizationId, $advisoryGroupId, $canEdit = True){
		$sql = "INSERT INTO organization_advisory_groups 
			(organization_advisory_groups.organization_id, organization_advisory_groups.advisory_group_id) 
			VALUES ($organizationId, $advisoryGroupId)";
			
		$this->query($sql);
	}
}

?>