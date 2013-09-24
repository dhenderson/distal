<?php
class ProgramOutcome extends AppModel {
	var $belongsTo = array('Outcome', 'Program');
	var $recursive =2;
}
?>