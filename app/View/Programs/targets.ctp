<!-- File: /app/View/Program/targets.ctp -->
<?php foreach ($targets as $target): ?>
	<div>
		<?php echo $this->html->link($target['Target']['name'], '/targets/about/' . $target['Target']['id'] . '/' . $program['Program']['id']);?>
	</div>
<?php endforeach; ?>