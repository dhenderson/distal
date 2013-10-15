<?php

class Step extends AppModel {
	var $belongsTo = array('Program');
	var $hasMany = array('IndicatorStep');
	var $order = 'Step.position ASC';
}

?>