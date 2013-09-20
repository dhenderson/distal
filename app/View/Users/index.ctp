<!-- File: /app/View/Users/index.ctp -->
<table cellpadding="0" cellspacing="0">
	<tr>
		<th>Group</th>
		<th>Name</th>
		<th>Email</th>
		<th>Active</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo  $this->html->link($user['UserGroup']['name'], '/usergroups/about/' . $user['UserGroup']['id']);?></td>
		<td>
			<?php echo $this->html->link(
				$user['User']['first_name'] . ' ' . $user['User']['last_name'],
				'about/' . $user['User']['id']);
			?>
		</td>
		<td><?php echo $user['User']['email']; ?></td>

		<td>
			<?php 
				if($user['User']['active']){
					echo 'Yes';
				}
				else{
					echo 'No';
				}
			?>
		</td>
		<td><?php echo $this->html->link('Edit', array('action'=>'edit', $user['User']['id']));?></td>
		<td><?php echo $this->html->link('Delete', array('action' => 'delete', $user['User']['id']), null, 'Are you sure?' )?></td>
	</tr>
	<?php endforeach; ?>
</table>