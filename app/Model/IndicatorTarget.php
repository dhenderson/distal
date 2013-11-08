<?php

class IndicatorTarget extends AppModel {
	var $belongsTo = array('Target', 'Indicator', 'Program');
	var $recursive = 2;
}

?>