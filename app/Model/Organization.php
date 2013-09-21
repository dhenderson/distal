<?php

class Organization extends AppModel {

	var $belongsTo = array('UserGroup');
	var $hasMany = array('Program');
}

?>