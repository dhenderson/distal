<h1><?php echo $survey['Survey']['name'];?></h1>

<?php echo $this->html->link('New section', '/surveySection/add/' . $survey['Survey']['id']) ?>