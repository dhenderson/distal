<?php

class AnswerOptionType extends AppModel {
	var $hasMany = array('Indicator');
	var $order = 'AnswerOptionType.name ASC';
	
}

?>