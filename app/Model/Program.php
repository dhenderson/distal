<?php

class Program extends AppModel {

	var $belongsTo = array('Organization');
	var $hasMany = array('Outcome', 'Target');
}

?>