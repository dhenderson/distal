<!-- File: /app/View/Users/home.ctp -->

<table class="table">
	<tr>
		<th>Organization</th>
		<th>Programs</th>
	</tr>
	<?php foreach($organizations as $organization):?>
		<tr>
			<td>
				<?php echo $this->html->link($organization['Organization']['name'], '/organizations/about/' . $organization['Organization']['id']);?></li>
			</td>
			<td>
				<?php foreach($organization['Program'] as $program):?>
					<div>
						<?php echo $this->html->link($program['name'], '/programs/about/' . $program['id']);?></li>
					</div>
				<?php endforeach;?>
			</td>
		</tr>
	<?php endforeach;?>
</table>