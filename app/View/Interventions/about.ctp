<h1><?php echo $intervention['Intervention']['name'];?></h1>

<table class="table">
	<tr>
		<th>Outcome</th>
		<th>Indicators</th>
	</tr>
	<?php foreach($outcomes as $outcome):?>
		<tr>
			<td><?php echo $this->html->link($outcome['Outcome']['name'],'/outcomes/about/' . $outcome['Outcome']['id']);?></td>
			<td>
				<ul>
				<?php foreach($outcome['Outcome']['Indicator'] as $indicator):?>
					<li><?php echo $indicator['name'];?></li>
				<?php endforeach;?>
				</ul>
			</td>
		</tr>
<?php endforeach;?>
</table>