<h1><?php echo $target['Target']['name'];?></h1>

<?php echo $this->html->link('New indicator', "/indicators/add/$organizationId/$programId?targetId=" . $target['Target']['id']) ?>

<h2>Demographics</h2>

<table class="table">
	<tr>
		<th>Indicator</th>
	</tr>
	<?php foreach($target['IndicatorTarget'] as $indicator):?>
		<tr>
			<td><?php echo $this->html->link($indicator['Indicator']['name'], '/indicators/about/' . $indicator['Indicator']['id']);?></td>
		</tr>
	<?php endforeach;?>
</table>