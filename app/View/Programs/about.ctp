<div class="tabbable" style="margin-top: 20px;">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#description" data-toggle="tab">Description</a></li>
		<li><a href="#outcomes" data-toggle="tab">Outcomes (<?php echo sizeof($outcomes);?>)</a></li>
		<li><a href="#indicators" data-toggle="tab">Indicators (<?php echo sizeof($indicators);?>)</a></li>
		<li><a href="#interventions" data-toggle="tab">Interventions (<?php echo sizeof($interventions);?>)</a></li>
	</ul>
</div>
<div class="tab-content">
	<div id="description" class="tab-pane active">
		<h1>Description</h2>
		
		<a href="<?php echo $this->webroot;?>programs/impactmodel/<?php echo $program['Program']['id'];?>">
		<div class="left-box">
			<img src="<?php echo $this->webroot; ?>img/impactmodel.png" />
			<div>Go to impact model</div>
		</div>
		</a>
		
		<?php if($program['Program']['description']):?>
			<?php echo nl2br($program['Program']['description']);?>
		<?php endif;?>
		<?php if(!$program['Program']['description']):?>
			<?php echo $this->html->link("Add a description for this program", "/programs/edit/" . $program['Program']['id']);?>
		<?php endif;?>
	</div>
	<div id="outcomes" class="tab-pane">
		<h1>Outcomes</h1>
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
		<h1>Interventions</h1>
		<table class="table">
			<tr>
				<th>Intervention</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php foreach ($interventions as $intervention): ?>
				<tr>
					<td><?php echo $this->html->link($intervention['Intervention']['name'], 'about/' . $intervention['Intervention']['id']);?></td>
					<td><?php echo $this->html->link('Edit', '/interventions/edit/' . $intervention['Intervention']['id']);?></td>
					<td><?php echo $this->html->link('Delete', array('/interventions/delete/' . $intervention['Intervention']['id']), null, 'Are you sure?' )?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<div id="indicators" class="tab-pane">
		<h1>Indicators</h1>
		<table class="table">
			<tr>
				<th>Indicator</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php foreach ($indicators as $indicator): ?>
				<tr>
					<td><?php echo $this->html->link($indicator['Indicator']['name'], 'about/' . $indicator['Indicator']['id']);?></td>
					<td><?php echo $this->html->link('Edit', '/indicators/edit/' . $indicator['Indicator']['id']);?></td>
					<td><?php echo $this->html->link('Delete', array('/indicators/delete/' . $indicator['Indicator']['id']), null, 'Are you sure?' )?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>