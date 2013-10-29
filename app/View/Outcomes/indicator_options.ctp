<table class="table">
	<thead>
		<tr>
			<th>Child outcome</th>
		</tr>
	</thead>
	<?php foreach($indicators as $indicator):?>
		<tr>
			<td><?php echo $indicator['Indicator']['name'];?></td>
		</tr>
	<?php endforeach;?>
</table>