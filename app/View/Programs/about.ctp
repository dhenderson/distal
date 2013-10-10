<div class="tabbable" style="margin-top: 20px;">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#impact-model" data-toggle="tab">Impact model</a></li>
		
		<li><a href="#outcomes" data-toggle="tab">Outcomes (<?php echo sizeof($outcomes);?>)</a></li>
		<li><a href="#indicators" data-toggle="tab">Indicators (<?php echo sizeof($indicators);?>)</a></li>
		<li><a href="#interventions" data-toggle="tab">Interventions (<?php echo sizeof($interventions);?>)</a></li>
		<li><a href="#description" data-toggle="tab">Description</a></li>
	</ul>
</div>
<div class="tab-content">
	<div id="impact-model" class="tab-pane active">
	
		<h1>Impact model</h1>
		
		<?php $programId = $program['Program']['id'];?>
		<?php $organizationId = $program['Program']['organization_id'];?>
				
		<?php if(sizeOf($outcomes) > 0):?>
			<script type="text/javascript">
				var graph = new Springy.Graph();
				
				<?php foreach ($outcomes as $outcome): ?>
					var outcome<?php echo $outcome['Outcome']['id'];?> = graph.newNode({outcomeId: <?php echo $outcome['Outcome']['id'];?>, 
						label: "<?php echo $outcome['Outcome']['name'];?>"
						<?php if(sizeof($outcome['Outcome']['Parent']) == 0):?>
							, color: "#FF2222"
						<?php endif;?>
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
				
				function showOutcomeDetails(selectedoutcomeId){
					// set all the outcome detail containers to hidden
					<?php foreach ($outcomes as $outcome): ?>
						this.document.getElementById("outcome<?php echo $outcome['Outcome']['id'];?>").style.display="none";
					<?php endforeach; ?>
					
					// display the outcome details of the selected outcome
					
					var outcomeDetails = this.document.getElementById("outcome" + selectedoutcomeId);
					outcomeDetails.style.display="inline";
					outcomeDetails.style.height="auto";
				}
				
				// boolean variable that reports if the 
				// outcome details container is minimized
				var outcomeDetailsMinimized = false;
				
				/**
				* Resizes the outcome detail container
				**/
				function minMaxOutcomeDetails(){
					// the container is minimized, so let's maximize it
					if(this.outcomeDetailsMinimized){
						this.document.getElementById("outcomeDetailsContainer").style.height = "";
						this.document.getElementById("outcomeDetailsContainer").style.backgroundColor = "#FFFFFF";
						// set the outcomesDetailMinmized boolean to false, as we maximized
						this.outcomeDetailsMinimized = false;
						
					}
					// otherwise, let's minimize
					else{
						this.document.getElementById("outcomeDetailsContainer").style.height = "15px";
						this.document.getElementById("outcomeDetailsContainer").style.backgroundColor = "#CCC";
						// set the outcomesDetailMinmized boolean to true, as we minmimized
						this.outcomeDetailsMinimized = true;
					}
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
		<div style="margin-left: auto; margin-right: auto; border: 1px dashed #AAA; text-align: center;">
			<?php if(sizeOf($outcomes) > 0):?>
				<canvas id="outcomesChart" width="1250" height="400" style=""/>
			<?php endif;?>
			<?php if(sizeOf($outcomes) == 0):?>
				<div style="text-align: center; font-size: 1.3em; width: 300px; margin: auto; line-height: 1.5em; padding: 20px;">
					<?php echo $this->html->link('Get started by adding an outcome that is the ultimate goal for this program', "/outcomes/add/$organizationId/" . $program['Program']['id']);?>
				</div>
			<?php endif;?>
		</div>
		<div style="clear:both"></div>

		<?php if(sizeOf($outcomes) > 0):?>
			<!-- outcome detail -->
			<div id="outcomeDetailsContainer" style="width: 500px; max-height: 500px; position: fixed; bottom: 0px; right: 30px; background-color: #FFF; padding: 10px; border: 1px solid #AAA; 
				box-shadow: 1px 5px 5px #888888; overflow:auto;">
				<?php foreach ($outcomes as $outcome): ?>
					<?php $outcomeId = $outcome['Outcome']['id'];?>
					<?php $outcomeName = $outcome['Outcome']['name'];?>
					<div style="display: none" id="outcome<?php echo $outcomeId;?>">
						<h1 style="margin-bottom: 0px; margin-top: 0px; cursor: pointer;" onclick="minMaxOutcomeDetails();">
							<?php echo $outcomeName;?>
						</h1>
						<div style="font-size: 8pt; font-weight: normal; margin-bottom: 10px;">
							<?php echo $this->html->link('Edit', "/outcomes/edit/$outcomeId");?>	| 
							<?php echo $this->html->link('Delete', "/outcomes/delete/$outcomeId", null, 'Are you sure?' );?>
						</div>
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
									<div class="button">
										<?php echo $this->html->link('Add child outcome', "/outcomes/add/$organizationId/$programId/$outcomeId");?>
									</div>
									<?php if(sizeOf($outcome['Outcome']['Child']) > 0):?>
										<table class="table">
											<tr>
												<th>Child outcome</th>
												<th>Edit</th>
												<th>Delink child</th>
											</tr>
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
									<div class="button">
										<?php echo $this->html->link("Add indicator", "/indicators/add/$organizationId/$outcomeId/$programId");?>
									</div>
									<?php if(sizeOf($outcome['Outcome']['Indicator']) > 0):?>
										<table class="table">
											<tr>
												<th>Indicator</th>
												<th>Edit</th>
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
									<div class="button">
										<?php echo $this->html->link("Add intervention", "/interventions/add/$organizationId/$outcomeId/$programId");?>
									</div>
									<?php if(sizeOf($outcome['Outcome']['Intervention']) > 0):?>
										<table class="table">
											<tr>
												<th>Intervention</th>
												<th>Edit</th>
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
														<?php echo $this->html->link('Edit', "/interventions/edit/$interventionId");?>
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
	<div id="description" class="tab-pane">
		<h1>Description</h2>
		
		<?php if($program['Program']['description']):?>
			<?php echo nl2br($program['Program']['description']);?>
		<?php endif;?>
		<?php if(!$program['Program']['description']):?>
			<?php echo $this->html->link("Add a description for this program", "/programs/edit/" . $program['Program']['id']);?>
		<?php endif;?>
	</div>
</div>