<!-- File: /app/View/Program/index.ctp -->
<table class="table">
	<tr>
		<th>Organization</th>
		<th>Program</th>
		<th>Active</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php foreach ($programs as $program): ?>
	<tr>
		<td><?php echo $this->html->link($program['Organization']['name'], 'about/' . $program['Organization']['id']);?></td>
		<td><?php echo $this->html->link($program['Program']['name'], 'about/' . $program['Program']['id']);?></td>
		<td>
			<?php 
				if($program['Program']['active']){
					echo 'Yes';
				}
				else{
					echo 'No';
				}
			?>
		</td>
		<td><?php echo $this->html->link('Edit', array('action'=>'edit', $program['Program']['id']));?></td>
		<td><?php echo $this->html->link('Delete', array('action' => 'delete', $program['Program']['id']), null, 'Are you sure?' )?></td>
	</tr>
	<?php endforeach; ?>
</table>