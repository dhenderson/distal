<?php

class Organization extends AppModel {

	var $hasMany = array('Program', 'OrganizationAdvisoryGroup', 'Outcome', 'Indicator', 'Intervention', 'Target');
}

?>