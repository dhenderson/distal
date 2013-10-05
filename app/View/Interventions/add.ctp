<!-- File: /app/View/Intervention/add.ctp -->	

<div class="tabbable">
	<ul class="nav nav-pills">
		<li class="active">
			<a href="#new-intervention" data-toggle="tab">Create a new intervention</a>
		</li>
		<li>
			<a href="#existing-intervention" data-toggle="tab">Or select an existing intervention</a>
		</li>
	</ul>
</div>
<div class="tab-content">
	<div id="new-intervention" class="tab-pane active">
		<?php
			echo $this->form->create('Intervention');
			echo $this->form->input('name');
			echo $this->form->input('description');
			echo $this->form->input('program_id', array('type'=>'hidden', 'value'=>$programId));
			
			echo $this->form->end('Save intervention');
		?>
	</div>
	<div id="existing-intervention" class="tab-pane">
		<table class="table">
			<tr>
				<th>Intervention</th>
				<th>Link to this program</th>
			</tr>
		<?php foreach($interventions as $intervention):?>
			<tr>
				<td><?php echo $intervention['Intervention']['name'];?></td>
				<td>
					<?php echo $this->html->link('Link "' . $intervention['Intervention']['name'] . '" to this program','/interventions/linkToProgram/' . 
<<<<<<< HEAD
						$intervention['Intervention']['id'] . '/' . $programId . '/' . $parentInterventionId);?>
=======
						$intervention['Intervention']['id'] . '/' . $programId . '/' . $parentOutcomeId);?>
>>>>>>> 6bbddb3079cbc162eea69b61cca56076da5c0b7e
				</td>
			</tr>
		<?php endforeach;?>
		</table>
	</div>
</div>