<?php

class DataType extends AppModel {
	var $hasMany = array('Indicator');
	var $order = 'DataType.name ASC';
	
}

?>