<?php

class Intervention extends AppModel {
	var $hasMany = array('OutcomeIntervention');
	var $belongsTo = array('Organization');
}

?>