<table class="table">
	<thead>
		<tr>
			<th>Indicator</th>
			<th>Link to</th>
		</tr>
	</thead>
	<?php foreach($indicators as $indicator):?>
		<tr>
			<td><?php echo $indicator['Indicator']['name'];?></td>
			<td><?php echo $this->html->link('Link ' . $indicator['Indicator']['name'] . " to " . $step['Step']['name'], 
				"/indicators/linkToStep/" . $indicator['Indicator']['id'] . '/' . $step['Step']['id'] . '/' . $programId);?></td>
		</tr>
	<?php endforeach;?>
</table>