<!-- File: /app/View/Outcome/index.ctp -->

<div class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#outcomes" data-toggle="tab">
				All outcomes
			</a>
		</li>
		<li>
			<a href="#outcomes-by-program" data-toggle="tab">
				Outcomes by program
			</a>
		</li>
	</ul>
</div>
<div class="tab-content">
	<div id="outcomes" class="tab-pane active">
		<table class="table">
			<tr>
				<th>Outcome</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php foreach ($outcomes as $outcome): ?>
				<tr>
					<td><?php echo $this->html->link($outcome['Outcome']['name'], 'about/' . $outcome['Outcome']['id']);?></td>
					<td><?php echo $this->html->link('Edit', array('action'=>'edit', $outcome['Outcome']['id']));?></td>
					<td><?php echo $this->html->link('Delete', array('action' => 'delete', $outcome['Outcome']['id']), null, 'Are you sure?' )?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<div id="outcomes-by-program" class="tab-pane">
		<table class="table">
			<tr>
				<th>Outcome</th>
				<th>Programs</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php foreach ($outcomesByProgram as $outcomeByProgram): ?>
				<tr>
					<td><?php echo $this->html->link($outcomeByProgram['Outcome']['name'], 'about/' . $outcomeByProgram['Outcome']['id']);?></td>
					<td>
						<?php echo $outcomeByProgram['Program']['name'];?>
					</td>
					<td><?php echo $this->html->link('Edit', array('action'=>'edit', $outcomeByProgram['Outcome']['id']));?></td>
					<td><?php echo $this->html->link('Delete', array('action' => 'delete', $outcomeByProgram['Outcome']['id']), null, 'Are you sure?' )?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>