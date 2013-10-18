<!-- File: /app/View/Program/targets.ctp -->
<?php foreach ($targets as $target): ?>
	<div>
		<?php echo $target['Target']['name'];?>
	</div>
<?php endforeach; ?>