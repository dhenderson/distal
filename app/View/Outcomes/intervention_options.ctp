<table class="table">
	<thead>
		<tr>
			<th>Intervention</th>
		</tr>
	</thead>
	<?php foreach($interventions as $intervention):?>
		<tr>
			<td><?php echo $intervention['Intervention']['name'];?></td>
		</tr>
	<?php endforeach;?>
</table>