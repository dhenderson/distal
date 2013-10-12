<!-- File: /app/View/Indicator/add.ctp -->	

<div class="tabbable">
	<ul class="nav nav-pills">
		<li class="active">
			<a href="#new-indicator" data-toggle="tab">Create a new indicator</a>
		</li>
		<li>
			<a href="#existing-indicator" data-toggle="tab">Or select an existing indicator</a>
		</li>
	</ul>
</div>
<div class="tab-content">
	<div id="new-indicator" class="tab-pane active">
		<?php
			echo $this->form->create('Indicator');
			echo $this->form->input('name');
			echo $this->form->input('answer_options');
			echo $this->form->input('organization_id', array('type'=>'hidden', 'value'=>$organizationId));
			echo $this->form->end('Save indicator');
		?>
	</div>
	<div id="existing-indicator" class="tab-pane">
		<table class="table">
			<tr>
				<th>Indicator</th>
				<th>Link to this outcome</th>
			</tr>
		<?php foreach($indicators as $indicator):?>
			<tr>
				<td><?php echo $indicator['Indicator']['name'];?></td>
				<td>
					<?php echo $this->html->link('Link "' . $indicator['Indicator']['name'] . '" to this program','/indicators/linkToProgram/' . 
						$indicator['Indicator']['id'] . '/' . $programId . '/' . $parentOutcomeId);?>
				</td>
			</tr>
		<?php endforeach;?>
		</table>
	</div>
</div>