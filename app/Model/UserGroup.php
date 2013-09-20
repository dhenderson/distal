<?php

class UserGroup extends AppModel {
	var $hasMany = array('UserGroup', 'Organization');
}

?>