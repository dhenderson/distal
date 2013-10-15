<?php

class IndicatorStep extends AppModel {
	var $belongsTo = array('Step', 'Indicator', 'Program');
	var $recursive =1;
}

?>