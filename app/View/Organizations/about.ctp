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