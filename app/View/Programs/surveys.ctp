<!-- File: /app/View/Program/surveys.ctp -->
<?php foreach ($surveys as $survey): ?>
	<div>
		<?php echo $this->html->link($survey['Survey']['name'], '/surveys/about/' . $survey['Survey']['id']);?>
	</div>
<?php endforeach; ?>