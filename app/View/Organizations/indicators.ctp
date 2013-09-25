<!-- File: /app/View/Indicator/index.ctp -->
<table class="table">
	<tr>
		<th>Indicator</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php foreach ($indicators as $indicator): ?>
	<tr>
		<td><?php echo $this->html->link($indicator['Indicator']['name'], 'about/' . $indicator['Indicator']['id']);?></td>
		<td><?php echo $this->html->link('Edit', '/indicators/edit/' . $indicator['Indicator']['id'])?></td>
		<td><?php echo $this->html->link('Delete', '/indicators/delete/' . $indicator['Indicator']['id'], null, 'Are you sure?' )?></td>
	</tr>
	<?php endforeach; ?>
</table>