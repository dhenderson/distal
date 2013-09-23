<?php
class ParentOutcome extends AppModel {
	var $belongsTo = array('Outcome');
	var $hasMany = array('Outcome');
}
?>