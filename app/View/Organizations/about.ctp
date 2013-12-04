<div class="tabbable" style="margin-top: 20px;">
	<ul class="nav nav-tabs">		
		<li class="active"><a href="#programs" data-toggle="tab">Programs</a></li>
		<?php if(sizeOf($outcomes > 0)):?>
			<li><a href="#impactmodel" data-toggle="tab">Organization wide impact model</a></li>
		<?php endif;?>
	</ul>
</div>
<div class="tab-content">
	<div id="programs" class="tab-pane active">
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
	</div>
	<?php if(sizeOf($outcomes > 0)):?>
		<div id="impactmodel" class="tab-pane">
			<?php echo $this->html->link('Export dot (outcomes only)', '/organizations/downloadImpactModelAsDot/' . $organization['Organization']['id']);?> &nbsp; &nbsp;
			<?php echo $this->html->link('Export dot (everything)', '/organizations/downloadImpactModelAsDot/' . $organization['Organization']['id'] . '/true');?>
			
			<script type="text/javascript">
				var graph = new Springy.Graph();
				
				<?php foreach ($outcomes as $outcome): ?>
					var outcome<?php echo $outcome['Outcome']['id'];?> = graph.newNode({outcomeId: <?php echo $outcome['Outcome']['id'];?>, 
						label: "<?php echo $outcome['Outcome']['name'];?>"
						});
				<?php endforeach; ?>
				<?php foreach ($outcomes as $outcome): ?>	
					<?php foreach ($outcome['Outcome']['Parent'] as $parent): ?>	
						graph.newEdge(outcome<?php echo $outcome['Outcome']['id'];?>, outcome<?php echo $parent['id'];?>);
					<?php endforeach;?>
				<?php endforeach; ?>
				
				jQuery(function(){
				  var springy = window.springy = jQuery('#outcomesChart').springy({
					graph: graph,
				  });
				});
				
			</script>
			<!-- impact theory chart -->
			<div id="di-graph-container" style="width: 1230px;">
				<?php if(sizeOf($outcomes) > 0):?>
					<canvas id="outcomesChart" width="1200" height="450" style=""/>
				<?php endif;?>
			</div>
			<div style="clear:both"></div>
		</div>
	<?php endif;?>
</div>
