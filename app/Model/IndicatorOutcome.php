<?php

class IndicatorOutcome extends AppModel {
	var $belongsTo = array('Outcome', 'Indicator', 'Program');
	var $recursive =2;
}

?>