<?php

class InterventionOutcome extends AppModel {
	var $belongsTo = array('Outcome', 'Intervention', 'Program');
}

?>