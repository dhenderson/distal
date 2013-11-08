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
				<div class="button" style="float: left; width: 46%;">
					<?php echo $this->html->link("New indicator", "/");?>
				</div>
				<div class="button" style="float: right; width: 46%;">
					<?php echo $this->html->link('Existing indicator', "/");?>
				</div>			
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>