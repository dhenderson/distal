<?php

class UserGroup extends AppModel {
	var $hasMany = array('UserUserGroup', 'OrganizationUserGroup');
}

?>