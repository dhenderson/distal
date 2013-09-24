<?php

class Organization extends AppModel {

	var $hasMany = array('Program', 'OrganizationUserGroup');
}

?>