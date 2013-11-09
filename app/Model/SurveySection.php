<?php

class SurveySection extends AppModel {
	var $hasMany = array('IndicatorSurveySection');
	var $belongsTo = array('Survey');
}

?>