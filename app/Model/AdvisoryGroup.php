<?php

class AdvisoryGroup extends AppModel {
	var $hasMany = array('UserAdvisoryGroup', 'OrganizationAdvisoryGroup');
}

?>