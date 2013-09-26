<?php if($organization['Organization']['description']):?>
	<h1>Description</h2>
	<?php echo $organization['Organization']['description'];?>
<?php endif;?>

<h1>Programs</h1>
<?php echo $this->html->link('Add a new program', '/programs/add/' . $organization['Organization']['id']);?>
<?php if(sizeOf($organization['Program']) > 0):?>
	<table class="table">
		<tr>
			<th>Program</th>
			<th>Edit</th>
		</tr>
		<?php foreach($organization['Program'] as $program):?>
			<tr>
				<td><?php echo $this->html->link($program['name'], '/programs/about/' . $program['id']);?></td>
				<td><?php echo $this->html->link('Edit', '/programs/edit/' . $program['id']);?></td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php endif;?>