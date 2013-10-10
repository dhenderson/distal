<div class="tabbable" style="margin-top: 20px;">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#programs" data-toggle="tab">Programs (<?php echo sizeof($organization['Program']);?>)</a></li>
		<li><a href="#description" data-toggle="tab">Description</a></li>
	</ul>
</div>
<div class="tab-content">
	<div id="programs" class="tab-pane active">
		<h1>Programs</h1>
		<?php if(sizeOf($organization['Program']) > 0):?>
			<table class="table">
				<tr>
					<th>Program</th>
					<th>Edit</th>
				</tr>
				<?php foreach($organization['Program'] as $program):?>
					<tr>
						<td><?php echo $this->html->link($program['name'], '/programs/about/' . $program['id']);?></td>
						<td><?php echo $this->html->link('Edit', '/programs/edit/' . $program['id']);?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php endif;?>
	</div>
	<div id="description" class="tab-pane">
		<h1>Description</h2>
		<?php if($organization['Organization']['description']):?>
			<?php echo $organization['Organization']['description'];?>
		<?php endif;?>
	</div>
</div>