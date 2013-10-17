<?php $stepNum = 1;?>
<?php $numOfSteps = sizeOf($steps);?>


<?php if(sizeOf($steps) == 0):?>
	<div class="get-started">
		<?php echo $this->html->link('Nothing here yet, go ahead and add the first step', '/steps/add/' . $programId);?>
	</div>
<?php endif; ?>
<?php if(sizeOf($steps) > 0):?>
	<div id="step-edit-box">
		<h1>Edit stuff here</h1>
		<div>There is a bunch of stuff there</div>
	</div>
	<?php foreach ($steps as $step): ?>
		<div class="step">
			<div class="step-box">
				<!--<h1>-->
					<?php echo $this->html->link($step['Step']['name'], '/steps/about/' . $step['Step']['id']);?>
				<!--</h1>-->
				<!--
				<h2>Description</h2>
				<div><?php echo $step['Step']['description'];?></div>
				<h2>Indicators</h2>
				<div>Indicators here</div>
				-->
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