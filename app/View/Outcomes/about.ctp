<h1><?php echo $organization['Organization']['name'];?></h1>
<div>
	<?php echo $this->html->link('Add a program', '/programs/add/' . $organization['Organization']['id']);?>
</div>
<ul>
	<?php foreach($organization['Program'] as $program):?>
		<li>
			<?php echo $this->html->link($program['name'], '/programs/about/' . $program['id']);?>
		</li>
	<?php endforeach; ?>
</ul>