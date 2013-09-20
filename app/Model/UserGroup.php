<?php

class UserGroup extends AppModel {
	var $hasMany = array('User', 'Organization');
}

?>