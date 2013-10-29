<table class="table">
	<thead>
		<tr>
			<th>Child outcome</th>
			<th>Link to </th>
		</tr>
	</thead>
	<?php foreach($outcomes as $outcome):?>
		<tr>
			<td><?php echo $outcome['Outcome']['name'];?></td>
			<td><?php echo $this->html->link('Link ' . $outcome['Outcome']['name'] . " to " . $parentOutcome['Outcome']['name'], 
				"/outcomes/linkToProgram/" . $outcome['Outcome']['id'] . "/" . $programId . "/" . $parentOutcome['Outcome']['id']);?></td>
		</tr>
	<?php endforeach;?>
</table>