<?php $stepNum = 1;?>
<?php $numOfSteps = sizeOf($steps);?>

<script type="text/javascript">
	/**
	* Detailed information about the selected step
	**/
	
	function showSteDetails(selectedStepId){
		// set all the step detail containers to hidden
		<?php foreach ($steps as $step): ?>
			this.document.getElementById("step<?php echo $step['Step']['id'];?>").style.display="none";
		<?php endforeach; ?>
		
		// display the step details of the selected step
		var stepDetails = this.document.getElementById("step" + selectedStepId);
		stepDetails.style.display="inline";
	}
</script>

<?php if(sizeOf($steps) == 0):?>
	<div class="get-started">
		<?php echo $this->html->link('Nothing here yet, go ahead and add the first step', '/steps/add/' . $programId);?>
	</div>
<?php endif; ?>
<?php if(sizeOf($steps) > 0):?>
	<div id="chat-box">
		<h1>Edit stuff here</h1>
		<div>There is a bunch of stuff there</div>
	</div>
	<?php foreach ($steps as $step): ?>
		<div class="step">
			<div class="step-box">	
				<?php echo $this->html->link($step['Step']['name'], '/steps/about/' . $step['Step']['id']);?>
			</div>
			<?php if($stepNum < $numOfSteps): ?>
				<div class="step-arrow">
					<img src="<?php echo $this->webroot; ?>img/service_util_arrow.png"/>
				</div>
			<?php endif;?>
		</div>
		<?php $stepNum = $stepNum + 1;?>
	<?php endforeach; ?>
<?php endif; ?>