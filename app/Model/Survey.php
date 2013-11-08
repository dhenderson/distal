<?php

class Survey extends AppModel {
	var $hasMany = array('SurveySection');
	var $belongsTo = array('Program');
	var $order = 'Survey.name ASC';
}

?>