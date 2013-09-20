<!-- File: /app/View/UserGroups/index.ctp -->
<table cellpadding="0" cellspacing="0">
	<tr>
		<th>Group</th>
		<th>Active</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php foreach ($userGroups as $userGroup): ?>
	<tr>
		<td><?php echo $userGroup['UserGroup']['name']?></td>
		<td>
			<?php 
				if($userGroup['UserGroup']['active']){
					echo 'Yes';
				}
				else{
					echo 'No';
				}
			?>
		</td>
		<td><?php echo $this->html->link('Edit', array('action'=>'edit', $userGroup['UserGroup']['id']));?></td>
		<td><?php echo $this->html->link('Delete', array('action' => 'delete', $userGroup['UserGroup']['id']), null, 'Are you sure?' )?></td>
	</tr>
	<?php endforeach; ?>
</table>