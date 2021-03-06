<div id="impact-model" class="tab-pane active">
	
	<?php $programId = $program['Program']['id'];?>
	<?php $organizationId = $program['Program']['organization_id'];?>
			
	<?php if(sizeOf($outcomes) > 0):?>
		<script type="text/javascript">
			var graph = new Springy.Graph();
			
			<?php foreach ($outcomes as $outcome): ?>
				var outcome<?php echo $outcome['Outcome']['id'];?> = graph.newNode({outcomeId: <?php echo $outcome['Outcome']['id'];?>, 
					label: "<?php echo $outcome['Outcome']['name'];?> (<?php echo sizeOf($outcome['Outcome']['Indicator']);?>-<?php echo sizeOf($outcome['Outcome']['Intervention']);?>)"
					});
			<?php endforeach; ?>
			<?php foreach ($outcomes as $outcome): ?>	
				<?php foreach ($outcome['Outcome']['Parent'] as $parent): ?>	
					<?php if($parent['ProgramOutcome']['program_id'] == $program['Program']['id']):?>
						graph.newEdge(outcome<?php echo $outcome['Outcome']['id'];?>, outcome<?php echo $parent['id'];?>);
					<?php endif;?>
				<?php endforeach;?>
			<?php endforeach; ?>
			
			jQuery(function(){
			  var springy = window.springy = jQuery('#outcomesChart').springy({
				graph: graph,
				nodeSelected: function(node){
				  console.log('selected outcome ID: ' + JSON.stringify(node.data.outcomeId));
				  showOutcomeDetails(JSON.stringify(node.data.outcomeId));
				}
			  });
			});
			
			/**
			* Detailed information about the selected outcome, including 
			* a list of related indicators
			**/
			
			function showOutcomeDetails(selectedOutcomeId){
				// set all the outcome detail containers to hidden
				<?php foreach ($outcomes as $outcome): ?>
					this.document.getElementById("outcome<?php echo $outcome['Outcome']['id'];?>").style.display="none";
				<?php endforeach; ?>
				
				// display the outcome details of the selected outcome
				var outcomeDetails = this.document.getElementById("outcome" + selectedOutcomeId);
				outcomeDetails.style.display="inline";
				
				this.document.getElementById('chat-box').style.display="inline";
			}
			
			/**
			* Save a canvas diagram to image
			**/
			function savecanvasfile(){
				var canvas = document.getElementById('outcomesChart');
				var context = canvas.getContext('2d');
				var strDataURI = canvas.toDataURL();
				Canvas2Image.saveAsPNG(canvas);
			}
			
		</script>
	<?php endif;?>
	<!-- impact theory chart -->
	<div id="di-graph-container">
		<?php if(sizeOf($outcomes) > 0):?>
			<canvas id="outcomesChart" width="815" height="450" style=""/>
		<?php endif;?>
		<?php if(sizeOf($outcomes) == 0):?>
			<div class="get-started">
				<h1>Begin by setting the ultimate outcome</h1>
				<div><?php echo $this->html->link('Create a new outcome', "/outcomes/add/$organizationId/" . $program['Program']['id']);?></div>
				<?php if(sizeOf($organization['Outcome']) > 0):?>
					<div>or</div>
					<div><?php echo $this->html->link('Use an existing outcome', "/outcomes/addMostDistalOutcome/" . $program['Program']['id']);?></div>
				<?php endif;?>
			</div>
		<?php endif;?>
	</div>
	<div style="clear:both"></div>
	<div class="graph-key">
		<strong>
			(#Indicators-#Interventions)
		</strong>
	</div>

	<?php if(sizeOf($outcomes) > 0):?>
		<!-- outcome detail -->
		<div id="chat-box" style="display: none">
			<?php foreach ($outcomes as $outcome): ?>
				<?php $outcomeId = $outcome['Outcome']['id'];?>
				<?php $outcomeName = $outcome['Outcome']['name'];?>
				<div style="display: none" id="outcome<?php echo $outcomeId;?>">
					<h1>
						<?php echo $outcomeName;?>
					</h1>
					<nav>
						<ul>
						<li><?php echo $this->html->link('Edit', "/outcomes/edit/$outcomeId");?></li>
						<li><?php echo $this->html->link('Delete', "/outcomes/delete/$outcomeId", null, 'Are you sure?' );?></li>
						</ul>
					</nav>
					<div id="outcome-options-<?php echo $outcomeId;?>" class="tabbable">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#outcome-options-<?php echo $outcomeId; ?>-children" data-toggle="tab">
									Child outcomes (<?php echo sizeof($outcome['Outcome']['Child']);?>)
								</a>
							</li>
							<li>
								<a href="#outcome-options-<?php echo $outcomeId; ?>-indicators" data-toggle="tab">
									Indicators (<?php echo sizeof($outcome['Outcome']['Indicator']);?>)
								</a>
							</li>
							<li>
								<a href="#outcome-options-<?php echo $outcomeId; ?>-interventions" data-toggle="tab">
									Interventions (<?php echo sizeof($outcome['Outcome']['Intervention']);?>)
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div id="outcome-options-<?php echo $outcomeId;?>-children" class="tab-pane active">
								<div class="button" style="float: left; width: 46%;">
									<?php echo $this->html->link('New child outcome', "/outcomes/add/$organizationId/$programId/$outcomeId");?>
								</div>
								<div class="button" style="float: right; width: 46%;">
									<?php echo $this->html->link('Existing outcome', "/outcomes/childOutcomeOptions/$outcomeId/$programId");?>
								</div>
								<div style="clear:both"></div>
								<?php if(sizeOf($outcome['Outcome']['Child']) > 0):?>
									<table class="table">
										<thead>
											<tr>
												<th>Child outcome</th>
												<th>Edit</th>
												<th>Delink child</th>
											</tr>
										</thead>
										<?php foreach($outcome['Outcome']['Child'] as $childOutcome):?>
											<tr>
												<td><?php echo $this->html->link($childOutcome['name'], "/outcomes/about/" . $childOutcome['id']);?></td>
												<td><?php echo $this->html->link('Edit', "/outcomes/edit/" . $childOutcome['id']);?></td>
												<td><?php echo $this->html->link('Delink child', "/outcomes/removeFromParentOutcome/" . $childOutcome['id'] . '/' .  $programId . '/' . $outcomeId);?></td>
											</tr>
										<?php endforeach;?>
									</table>
								<?php endif;?>
							</div>
							<div id="outcome-options-<?php echo $outcomeId;?>-indicators" class="tab-pane">
								<div class="button" style="float: left; width: 46%;">
									<?php echo $this->html->link("New indicator", "/indicators/add/$organizationId/$programId?outcomeId=$outcomeId");?>
								</div>
								<div class="button" style="float: right; width: 46%;">
									<?php echo $this->html->link('Existing indicator', "/outcomes/indicatorOptions/$outcomeId/$programId");?>
								</div>
								<div style="clear:both"></div>
								<?php if(sizeOf($outcome['Outcome']['Indicator']) > 0):?>
									<table class="table">
										<tr>
											<th>Indicator</th>
											<th>Delete</th>
										</tr>
										<?php foreach($outcome['Outcome']['Indicator'] as $indicator):?>
											<?php $indicatorName = $indicator['name'];?>
											<?php $indicatorId = $indicator['id'];?>
											<tr>
												<td valign="top">
													<?php echo $this->html->link($indicatorName, "/indicators/about/$indicatorId");?>
												</td> 
												<td valign="top">
													<?php echo $this->html->link("Delete", "/indicators/delete/$indicatorId/$programId");?>
												</td>
											</tr>
										<?php endforeach; ?>
									</table>
								<?php endif;?>
							</div>
							<div id="outcome-options-<?php echo $outcomeId;?>-interventions" class="tab-pane">
								<div class="button" style="float: left; width: 46%;">
									<?php echo $this->html->link("New intervention", "/interventions/add/$organizationId/$programId?outcomeId=$outcomeId");?>
								</div>
								<div class="button" style="float: right; width: 46%;">
									<?php echo $this->html->link('Existing intervention', "/outcomes/interventionOptions/$outcomeId/$programId");?>
								</div>
								<div style="clear:both"></div>
								<?php if(sizeOf($outcome['Outcome']['Intervention']) > 0):?>
									<table class="table">
										<tr>
											<th>Intervention</th>
											<th>Delete</th>
										</tr>
										<?php foreach($outcome['Outcome']['Intervention'] as $intervention):?>
											<?php $interventionName = $intervention['name'];?>
											<?php $interventionId = $intervention['id'];?>
											<tr>
												<td>
													<?php echo $this->html->link($interventionName, "/interventions/about/$interventionId");?>
												</td>
												<td valign="top">
													<?php echo $this->html->link("Delete", "/interventions/delete/$interventionId/$programId");?>
												</td>
											</tr>
										<?php endforeach; ?>
									</table>
								<?php endif;?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach;?>
		</div>
	<?php endif;?>
</div>