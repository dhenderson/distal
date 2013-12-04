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

<?php if(sizeOf($outcomes > 0)):?>
	<h2>Organization wide impact model</h2>

	<script type="text/javascript">
		var graph = new Springy.Graph();
		
		<?php foreach ($outcomes as $outcome): ?>
			var outcome<?php echo $outcome['Outcome']['id'];?> = graph.newNode({outcomeId: <?php echo $outcome['Outcome']['id'];?>, 
				label: "<?php echo $outcome['Outcome']['name'];?> (<?php echo sizeOf($outcome['Outcome']['Indicator']);?>-<?php echo sizeOf($outcome['Outcome']['Intervention']);?>)"
				<?php if(sizeof($outcome['Outcome']['Parent']) == 0 || sizeOf($outcomes) == 1):?>
					, color: "#DD0000"
				<?php endif;?>
				<?php if(sizeof($outcome['Outcome']['Child']) == 0 AND sizeOf($outcomes) > 1):?>
					, color: "#0000DD"
				<?php endif;?>
				});
		<?php endforeach; ?>
		<?php foreach ($outcomes as $outcome): ?>	
			<?php foreach ($outcome['Outcome']['Parent'] as $parent): ?>	
				graph.newEdge(outcome<?php echo $outcome['Outcome']['id'];?>, outcome<?php echo $parent['id'];?>);
			<?php endforeach;?>
		<?php endforeach; ?>
	</script>
	<!-- impact theory chart -->
	<div id="di-graph-container">
		<?php if(sizeOf($outcomes) > 0):?>
			<canvas id="outcomesChart" width="815" height="450" style=""/>
		<?php endif;?>
	</div>
	<div style="clear:both"></div>
	<div class="graph-key">
		<div style="float: left; margin-right: 20px;">
			<div class="graph-square" style="background-color: #aaccff; width: 15px; height: 15px; float: left; margin-right: 5px; border: 1px solid #0000DD;">&nbsp;</div> <span style="color: #0000DD">Most proximal outcome</span>
		</div>
		<div style="float: left; margin-right: 20px;">
			<div class="graph-square" style="background-color: #999; width: 15px; height: 15px; float: left; margin-right: 5px; border: 1px solid #111;">&nbsp;</div> Intermediate outcome
		</div>
		<div style="float: left;">
			<div class="graph-square" style="background-color: #ff8080; width: 15px; height: 15px; float: left; margin-right: 5px; border: 1px solid #DD0000;">&nbsp;</div> <span style="color: #DD0000">Most distal outcome</span>
		</div>
		<div style="float: right">
			<strong>
				(#Indicators-#Interventions)
			</strong>
		</div>
		<div style="clear:both"></div>
	</div>
<?php endif;?>