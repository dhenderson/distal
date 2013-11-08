<?php $stepNum = 1;?>
<?php $numOfSteps = sizeOf($steps);?>

<script type="text/javascript">
	/**
	* Detailed information about the selected step
	**/
	
	function showStepDetails(selectedStepId){
		// set all the step detail containers to hidden
		<?php foreach ($steps as $step): ?>
			this.document.getElementById("step<?php echo $step['Step']['id'];?>").style.display="none";
			this.document.getElementById("stepBox<?php echo $step['Step']['id'];?>").style.backgroundColor="#FFF";
		<?php endforeach; ?>
		
		// display the step details of the selected step
		var stepDetails = this.document.getElementById("step" + selectedStepId);
		this.document.getElementById('stepBox' + selectedStepId).style.backgroundColor="#e8f9ff";
		stepDetails.style.display="inline";
		
		this.document.getElementById('chat-box').style.display="inline";
	}
</script>

<?php if(sizeOf($steps) == 0):?>
	<div class="get-started">
		<?php echo $this->html->link('Nothing here yet, go ahead and add the first step', '/steps/add/' . $programId);?>
	</div>
<?php endif; ?>
<?php if(sizeOf($steps) > 0):?>
	<?php foreach ($steps as $step): ?>
		<div class="step" onclick="showStepDetails(<?php echo $step['Step']['id']?>)">
			<div class="step-box" id="stepBox<?php echo $step['Step']['id'];?>">	
				<?php echo $step['Step']['name'];?>
			</div>
			<?php if($stepNum < $numOfSteps): ?>
				<div class="step-arrow">
					<img src="<?php echo $this->webroot; ?>img/service_util_arrow.png"/>
				</div>
			<?php endif;?>
		</div>
		<?php $stepNum = $stepNum + 1;?>
	<?php endforeach; ?>
	<div id="chat-box" style="display: none">
		<?php foreach ($steps as $step): ?>
			<div id="step<?php echo $step['Step']['id'];?>" style="display: none">
				<h1><?php echo $step['Step']['name'];?></h1>
				<nav>
					<ul>
						<li><?php echo $this->html->link("Edit", "/steps/edit/" . $step['Step']['id']);?></li>
					</ul>
				</nav>		
				<div>
					<h2>Description</h2>
					<?php echo $step['Step']['description'];?>
				</div>
				<div>
					<h2>Indicators</h2>
					<div class="button" style="float: left; width: 46%;">
						<?php echo $this->html->link("New indicator", "/indicators/add/" . $step['Program']['organization_id'] . "/" . $step['Program']['id'] . '?stepId=' . $step['Step']['id']);?>
					</div>
					<div class="button" style="float: right; width: 46%;">
						<?php echo $this->html->link('Existing indicator', "/steps/indicatorOptions/" . $step['Step']['id'] . '/' . $step['Program']['id']);?>
					</div>
					<table class="table">
						<tr>
							<th>Indicator</th>
							<th>Delete</th>
						</tr>
						<?php foreach($step['IndicatorStep'] as $indicator):?>
							<?php $indicatorName = $indicator['Indicator']['name'];?>
							<?php $indicatorId = $indicator['Indicator']['id'];?>
							<tr>
								<td>
									<?php echo $this->html->link($indicatorName, "/indicators/about/$indicatorId");?>
								</td>
								<td valign="top">
									<?php echo $this->html->link("Delete", "/indicators/delete/$indicatorId/$programId");?>
								</td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>