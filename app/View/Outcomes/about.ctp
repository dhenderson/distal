<h1><?php echo $outcome['Outcome']['name'];?></h1>

<h2>Parent outcomes</h2>
<ul>
	<?php foreach($outcome['Parent'] as $parent):?>
		<li><?php echo $parent['name'];?></li>
	<?php endforeach;?>
</ul>


<h2>Child outcomes</h2>
<ul>
	<?php foreach($outcome['Child'] as $child):?>
		<li><?php echo $child['name'];?></li>
	<?php endforeach;?>
</ul>