<?php

class UserUserGroup extends AppModel {
	var $hasMany = array('User', 'UserGroup');
}

?>