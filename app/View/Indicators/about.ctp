<h1><?php echo $indicator['Indicator']['name'];?></h1>

<table class="table">
	<tr>
		<th>Outcome</th>
		<th>Interventions</th>
	</tr>
	<?php foreach($outcomes as $outcome):?>
		<tr>
			<td><?php echo $this->html->link($outcome['Outcome']['name'],'/outcomes/about/' . $outcome['Outcome']['id']);?></td>
			<td>
				<ul>
				<?php foreach($outcome['Outcome']['Intervention'] as $intervention):?>
					<li><?php echo $intervention['name'];?></li>
				<?php endforeach;?>
				</ul>
			</td>
		</tr>
<?php endforeach;?>
</table>