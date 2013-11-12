<h1><?php echo $survey['Survey']['name'];?></h1>

<script type="text/javascript">
	/**
	* Detailed information about the selected survey section
	**/
	
	function showSurveySectionDetails(surveySectionId){
		// set all the survey section detail containers to hidden
		<?php foreach ($survey['SurveySection'] as $surveySection): ?>
			this.document.getElementById("section<?php echo $surveySection['id'];?>").style.display="none";
			this.document.getElementById('sectiondisplay<?php echo $surveySection['id'];?>').style.borderColor="#FFFFFF";
		<?php endforeach; ?>
		
		// display the survey section details of the selected step
		var sectionDetails = this.document.getElementById("section" + surveySectionId);
		this.document.getElementById('sectiondisplay' + surveySectionId).style.borderColor="#0088aa";
		sectionDetails.style.display="inline";
		
		this.document.getElementById('chat-box').style.display="inline";
	}
</script>

<div class="survey">
	<?php foreach($survey['SurveySection'] as $surveySection):?>
		<div class="survey-section" id="sectiondisplay<?php echo $surveySection['id']?>" onclick="showSurveySectionDetails(<?php echo $surveySection['id']?>)">
			<h1><?php echo $surveySection['name']?></h1>
		</div>
	<?php endforeach;?>
</div>

<div id="chat-box" style="display: none">
	<?php foreach($survey['SurveySection'] as $surveySection):?>
		<div id="section<?php echo $surveySection['id']?>" style="display: none">
			<h1><?php echo $surveySection['name']?></h1>
			<div class="button" style="float: left; width: 28%; margin-right: 5px;">
				<?php echo $this->html->link('Demographic', "/surveySections/indicatorOptions/" . $surveySection['id'] . '?target=true');?>
			</div>
			<div class="button" style="float: left; width: 30%; margin-right: 5px;">
				<?php echo $this->html->link('Service utilization', "/surveySections/indicatorOptions/" . $surveySection['id'] . '?step=true');?>
			</div>
			<div class="button" style="float: left; width: 28%;">
				<?php echo $this->html->link('Outcome', "/surveySections/indicatorOptions/" . $surveySection['id'] . '?outcome=true');?>
			</div>
			<div style="clear:both"></div>
			<div>There is a bunch of stuff there</div>
		</div>
	<?php endforeach;?>
</div>