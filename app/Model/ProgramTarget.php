<?php

class ProgramTarget extends AppModel {
	var $belongsTo = array('Target', 'Program');
	var $recursive = 2;
}

?>