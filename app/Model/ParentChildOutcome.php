<?php

class ParentChildOutcome extends AppModel {
	var $belongsTo = array('Outcome');
	var $hasMany = array('Outcome');
}

?>