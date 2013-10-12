<div class="tabbable" style="margin-top: 20px;">
	<ul class="nav nav-tabs">		
		<li class="active"><a href="#outcomes" data-toggle="tab">Outcomes (<?php echo sizeof($outcomes);?>)</a></li>
		<li><a href="#indicators" data-toggle="tab">Indicators (<?php echo sizeof($indicators);?>)</a></li>
		<li><a href="#interventions" data-toggle="tab">Interventions (<?php echo sizeof($interventions);?>)</a></li>
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
	<div id="interventions" class="tab-pane">
		<table class="table">
			<tr>
				<th>Intervention</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php foreach ($interventions as $intervention): ?>
				<tr>
					<td><?php echo $this->html->link($intervention['Intervention']['name'], '/interventions/about/' . $intervention['Intervention']['id']);?></td>
					<td><?php echo $this->html->link('Edit', '/interventions/edit/' . $intervention['Intervention']['id']);?></td>
					<td><?php echo $this->html->link('Delete', array('/interventions/delete/' . $intervention['Intervention']['id']), null, 'Are you sure?' )?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<div id="indicators" class="tab-pane">
		<table class="table">
			<tr>
				<th>Indicator</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php foreach ($indicators as $indicator): ?>
				<tr>
					<td><?php echo $this->html->link($indicator['Indicator']['name'], '/indicators/about/' . $indicator['Indicator']['id']);?></td>
					<td><?php echo $this->html->link('Edit', '/indicators/edit/' . $indicator['Indicator']['id']);?></td>
					<td><?php echo $this->html->link('Delete', array('/indicators/delete/' . $indicator['Indicator']['id']), null, 'Are you sure?' )?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>