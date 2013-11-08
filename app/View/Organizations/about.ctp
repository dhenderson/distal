<h2>Programs</h2>
<table class="table">
	<tr>
		<th>Program</th>
		<th style="text-align: center;">Targets</th>
		<th style="text-align: center;">Service utilization</th>
		<th style="text-align: center;">Impact model</th>
		<th style="text-align: center;">Surveys</th>
	</tr>
	<?php foreach($organization['Program'] as $program):?>
		<tr>
			<td><?php echo $this->html->link($program['name'], '/programs/about/' . $program['id']);?> </td>
			<td style="text-align: center;">
				<a href="<?php echo $this->webroot;?>programs/targets/<?php echo $program['id'];?>">
					<?php $targetImage = "target_30.png"?>
					<?php if(sizeOf($program['ProgramTarget']) == 0):?>
						<?php $targetImage = "target_grey_30.png"?>
					<?php endif;?>
					<img src="<?php echo $this->webroot; ?>img/<?php echo $targetImage;?>"/>
				</a>
			</td>
			<td style="text-align: center;">
				<a href="<?php echo $this->webroot;?>programs/serviceutilization/<?php echo $program['id'];?>">
					<?php $serviceUtilizationImage = "serviceutilization_30.png"?>
					<?php if(sizeOf($program['Step']) == 0):?>
						<?php $serviceUtilizationImage = "serviceutilization_grey_30.png"?>
					<?php endif?>
					<img src="<?php echo $this->webroot; ?>img/<?php echo $serviceUtilizationImage;?>"/>
				</a>
			</td>
			<td style="text-align: center;">
				<a href="<?php echo $this->webroot;?>programs/impactmodel/<?php echo $program['id'];?>">
					<?php $impactModelImage = "impactmodel_30.png"?>
					<?php if(sizeOf($program['ProgramOutcome']) == 0):?>
						<?php $impactModelImage = "impactmodel_grey_30.png"?>
					<?php endif?>
					<img src="<?php echo $this->webroot; ?>img/<?php echo $impactModelImage;?>"/>
				</a>
			</td>
			<td style="text-align: center;">
				<a href="<?php echo $this->webroot;?>programs/surveys/<?php echo $program['id'];?>">
					<?php $surveyImage = "survey_30.png"?>
					<?php if(sizeOf($program['Survey']) == 0):?>
						<?php $surveyImage = "survey_grey_30.png"?>
					<?php endif?>
					<img src="<?php echo $this->webroot; ?>img/<?php echo $surveyImage;?>"/>
				</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>