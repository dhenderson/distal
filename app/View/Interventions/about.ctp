<h1><?php echo $intervention['Intervention']['name'];?></h1>

<table class="table">
	<tr>
		<th>Outcomes affected by this intervention</th>
		<th>Indicators used to measure this outcome</th>
	</tr>
	<?php foreach($outcomes as $outcome):?>
		<tr>
			<td><?php echo $this->html->link($outcome['Outcome']['name'],'/outcomes/about/' . $outcome['Outcome']['id']);?></td>
			<td>
				<ul>
				<?php foreach($outcome['Outcome']['Indicator'] as $indicator):?>
					<li><?php echo $this->html->link($indicator['name'],'/indicators/about/' . $indicator['id']);?></li>
				<?php endforeach;?>
				</ul>
			</td>
		</tr>
<?php endforeach;?>
</table>