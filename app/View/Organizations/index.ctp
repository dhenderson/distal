<!-- File: /app/View/UserGroups/index.ctp -->
<table class="table">
	<tr>
		<th>Organization</th>
		<th>Active</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php foreach ($organizations as $organization): ?>
	<tr>
		<td><?php echo $this->html->link($organization['Organization']['name'], 'about/' . $organization['Organization']['id']);?></td>
		<td>
			<?php 
				if($organization['Organization']['active']){
					echo 'Yes';
				}
				else{
					echo 'No';
				}
			?>
		</td>
		<td><?php echo $this->html->link('Edit', array('action'=>'edit', $organization['Organization']['id']));?></td>
		<td><?php echo $this->html->link('Delete', array('action' => 'delete', $organization['Organization']['id']), null, 'Are you sure?' )?></td>
	</tr>
	<?php endforeach; ?>
</table>