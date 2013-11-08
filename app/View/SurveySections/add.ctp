<!-- File: /app/View/SurveySections/add.ctp -->	
<?php
	echo $this->form->create('SurveySection');
	echo $this->form->input('name');
	echo $this->form->input('survey_id', array('type'=>'hidden', 'value'=>$surveyId));
	echo $this->form->end('Save');
?>