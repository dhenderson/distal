<h1><?php echo $target['Target']['name'];?></h1>
<h2>Description</h2>
<?php echo $target['Target']['description'];?>

<h2>Demographic indicators that help define the target</h2>
<?php echo $this->html->link('New indicator', "/indicators/add/$organizationId/$programId?targetId=" . $target['Target']['id']) ?>
<table class="table">
	<tr>
		<th>Indicators</th>
	</tr>
	<?php foreach($target['IndicatorTarget'] as $indicator):?>
		<tr>
			<td><?php echo $this->html->link($indicator['Indicator']['name'], '/indicators/about/' . $indicator['Indicator']['id']);?></td>
		</tr>
	<?php endforeach;?>
</table>