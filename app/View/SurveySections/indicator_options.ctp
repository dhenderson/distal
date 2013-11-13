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
			<td></td>
		</tr>
	<?php endforeach;?>
</table>