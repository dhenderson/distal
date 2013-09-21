<h1><?php echo $program['Program']['name'];?></h1>
<div>
	<?php echo $this->html->link('Add a target', '/targets/add/' . $program['Program']['id']);?>
</div>
<div>
	<?php echo $this->html->link('Add an outcome', '/outcomes/add/' . $program['Program']['id']);?>
</div>
<h2>Outcomes</h2>
<ul>
<?php foreach ($outcomes as $outcome): ?>
	<li><?php echo $outcome['Outcome']['name'];?></li>
<?php endforeach; ?>
</ul>