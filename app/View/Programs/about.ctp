<a href="<?php echo $this->webroot;?>programs/targets/<?php echo $program['Program']['id'];?>">
	<div class="left-box <?php if(sizeOf($program['ProgramTarget']) == 0) {echo "grey";} ?>">
		<?php $targetImage = "target.png"?>
		<?php if(sizeOf($program['ProgramTarget']) == 0):?>
			<?php $targetImage = "target_grey.png"?>
		<?php endif;?>
		<img src="<?php echo $this->webroot; ?>img/<?php echo $targetImage;?>"/>
		<div>Program targets</div>
	</div>
</a>

<a href="<?php echo $this->webroot;?>programs/serviceutilization/<?php echo $program['Program']['id'];?>">
	<div class="left-box <?php if(sizeOf($steps) == 0) {echo "grey";} ?>">
		<?php $serviceUtilizationImage = "serviceutilization.png"?>
		<?php if(sizeOf($steps) == 0):?>
			<?php $serviceUtilizationImage = "serviceutilization_grey.png"?>
		<?php endif?>
		<img src="<?php echo $this->webroot; ?>img/<?php echo $serviceUtilizationImage;?>"/>
		<div>Service utilization</div>
	</div>
</a>

<a href="<?php echo $this->webroot;?>programs/impactmodel/<?php echo $program['Program']['id'];?>">
	<div class="left-box <?php if(sizeOf($outcomes) == 0) {echo "grey";} ?>">
		<?php $impactModelImage = "impactmodel.png"?>
		<?php if(sizeOf($outcomes) == 0):?>
			<?php $impactModelImage = "impactmodel_grey.png"?>
		<?php endif?>
		<img src="<?php echo $this->webroot; ?>img/<?php echo $impactModelImage;?>"/>
		<div>Impact model</div>
	</div>
</a>

<a href="<?php echo $this->webroot;?>programs/surveys/<?php echo $program['Program']['id'];?>">
	<div class="left-box <?php if(sizeOf($surveys) == 0) {echo "grey";} ?>">
		<?php $surveyImage = "survey.png"?>
		<?php if(sizeOf($surveys) == 0):?>
			<?php $surveyImage = "survey_grey.png"?>
		<?php endif?>
		<img src="<?php echo $this->webroot; ?>img/<?php echo $surveyImage;?>"/>
		<div>Surveys</div>
	</div>
</a>

<div style="clear:both;"><div>
<div class="tabbable" style="margin-top: 20px;">
	<ul class="nav nav-tabs">		
		<li class="active"><a href="#outcomes" data-toggle="tab">Outcomes (<?php echo sizeof($outcomes);?>)</a></li>
		<li><a href="#indicators" data-toggle="tab">Indicators (<?php echo sizeof($indicatorOutcomes);?>)</a></li>
		<li><a href="#interventions" data-toggle="tab">Interventions (<?php echo sizeof($interventions);?>)</a></li>
		<li><a href="#steps" data-toggle="tab">Service utilization steps (<?php echo sizeof($steps);?>)</a></li>
	</ul>
</div>
<div class="tab-content">
	<div id="outcomes" class="tab-pane active">
		<table class="table">
			<thead>
				<tr>
					<th>Outcome</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<?php foreach ($outcomes as $outcome): ?>
				<tr>
					<td><?php echo $this->html->link($outcome['Outcome']['name'], '/outcomes/about/' . $outcome['Outcome']['id']);?></td>
					<td><?php echo $this->html->link('Edit', '/outcomes/edit/' . $outcome['Outcome']['id']);?></td>
					<td><?php echo $this->html->link('Delete', array('/outcomes/delete/' . $outcome['Outcome']['id']), null, 'Are you sure?' )?></td>
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
		<div class="tabbable" style="margin-top: 20px;">
			<ul class="nav nav-tabs">		
				<li class="active"><a href="#indicatorTargets" data-toggle="tab">Target demographic indicators (<?php echo sizeof($indicatorTargets);?>)</a></li>
				<li><a href="#indicatorOutcomes" data-toggle="tab">Outcomes indicators (<?php echo sizeof($indicatorOutcomes);?>)</a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div id="indicatorTargets" class="tab-pane active">
				<table class="table">
					<thead>
						<tr>
							<th>Target demographic indicator</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<?php foreach ($indicatorTargets as $indicator): ?>
						<tr>
							<td><?php echo $this->html->link($indicator['Indicator']['name'], '/indicators/about/' . $indicator['Indicator']['id']);?></td>
							<td><?php echo $this->html->link('Edit', '/indicators/edit/' . $indicator['Indicator']['id']);?></td>
							<td><?php echo $this->html->link('Delete', array('/indicators/delete/' . $indicator['Indicator']['id']), null, 'Are you sure?' )?></td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
			<div id="indicatorOutcomes" class="tab-pane">
				<table class="table">
					<thead>
						<tr>
							<th>Outcomes indicator</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<?php foreach ($indicatorOutcomes as $indicator): ?>
						<tr>
							<td><?php echo $this->html->link($indicator['Indicator']['name'], '/indicators/about/' . $indicator['Indicator']['id']);?></td>
							<td><?php echo $this->html->link('Edit', '/indicators/edit/' . $indicator['Indicator']['id']);?></td>
							<td><?php echo $this->html->link('Delete', array('/indicators/delete/' . $indicator['Indicator']['id']), null, 'Are you sure?' )?></td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
	<div id="steps" class="tab-pane">
		<table class="table">
			<thead>
				<tr>
					<th>Service utilization step</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<?php foreach ($steps as $step): ?>
				<tr>
					<td><?php echo $this->html->link($step['Step']['name'], '/steps/about/' . $step['Step']['id']);?></td>
					<td><?php echo $this->html->link('Edit', '/steps/edit/' . $step['Step']['id']);?></td>
					<td><?php echo $this->html->link('Delete', array('/steps/delete/' . $step['Step']['id']), null, 'Are you sure?' )?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>