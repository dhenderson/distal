<!-- File: /app/View/Outcome/index.ctp -->
<table class="table">
	<tr>
		<th>Outcome</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php foreach ($outcomes as $outcome): ?>
	<tr>
		<td><?php echo $this->html->link($outcome['Outcome']['name'], '/outcomes/about/' . $outcome['Outcome']['id']);?></td>
		<td><?php echo $this->html->link('Edit', '/outcomes/edit/' . $outcome['Outcome']['id'])?></td>
		<td><?php echo $this->html->link('Delete', '/outcomes/delete/' . $outcome['Outcome']['id'], null, 'Are you sure?' )?></td>
	</tr>
	<?php endforeach; ?>
</table>