<!-- File: /app/View/Program/targets.ctp -->

<h1>Targets for this program</h1>
<ul>
<?php foreach ($targets as $target): ?>
	<li><?php echo $this->html->link($target['Target']['name'], '/targets/about/' . $target['Target']['id'] . '/' . $program['Program']['id']);?></li>
<?php endforeach; ?>
</ul>