<!-- File: /app/View/Outcome/add.ctp -->	

<div class="tabbable">
	<ul class="nav nav-pills">
		<li class="active">
			<a href="#new-outcome" data-toggle="tab">Create a new outcome</a>
		</li>
		<li>
			<a href="#existing-outcome" data-toggle="tab">Or select an existing outcome</a>
		</li>
	</ul>
</div>
<div class="tab-content">
	<div id="new-outcome" class="tab-pane active">
		<?php
			echo $this->form->create('Outcome');
			echo $this->form->input('name');
			echo $this->form->input('description');
			echo $this->form->input('organization_id', array('type'=>'hidden', 'value'=>$organizationId));
			
			echo $this->form->end('Save outcome');
		?>
	</div>
	<div id="existing-outcome" class="tab-pane">
		<table class="table">
			<tr>
				<th>Outcome</th>
				<th>Link to this program</th>
			</tr>
		<?php foreach($outcomes as $outcome):?>
			<tr>
				<td><?php echo $outcome['Outcome']['name'];?></td>
				<td>
					<?php echo $this->html->link('Link "' . $outcome['Outcome']['name'] . '" to this program','/outcomes/linkToProgram/' . 
						$outcome['Outcome']['id'] . '/' . $programId . '/' . $parentOutcomeId);?>
				</td>
			</tr>
		<?php endforeach;?>
		</table>
	</div>
</div>