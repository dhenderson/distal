<!-- File: /app/View/Intervention/index.ctp -->
<table class="table">
	<tr>
		<th>Intervention</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php foreach ($interventions as $intervention): ?>
	<tr>
		<td><?php echo $this->html->link($intervention['Intervention']['name'], 'about/' . $intervention['Intervention']['id']);?></td>
		<td><?php echo $this->html->link('Edit', '/interventions/edit/' . $intervention['Intervention']['id'])?></td>
		<td><?php echo $this->html->link('Delete', '/interventions/delete/' . $intervention['Intervention']['id'], null, 'Are you sure?' )?></td>
	</tr>
	<?php endforeach; ?>
</table>