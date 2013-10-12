<h2>Programs</h2>
<table class="table">
	<tr>
		<th>Program</th>
	</tr>
	<?php foreach($organization['Program'] as $program):?>
		<tr>
			<td><?php echo $this->html->link($program['name'], '/programs/about/' . $program['id']);?></td>
		</tr>
	<?php endforeach; ?>
</table>