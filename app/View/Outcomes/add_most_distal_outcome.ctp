<table class="table">
	<thead>
		<tr>
			<th>Most distal outcome</th>
		</tr>
	</thead>
	<?php foreach($outcomes as $outcome):?>
		<tr>
			<td><?php echo $this->html->link($outcome['Outcome']['name'], "/outcomes/linkToProgram/" . $outcome['Outcome']['id'] . "/" . $programId);?></td>
		</tr>
	<?php endforeach;?>
</table>