<?php

class User extends AppModel {
	var $hasMany = array('UserUserGroup');
}

?>