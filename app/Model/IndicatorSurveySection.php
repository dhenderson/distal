<?php

class IndicatorSurveySection extends AppModel {
	var $belongsTo = array('SurveySection', 'Indicator');
	var $recursive = 2;
}

?>