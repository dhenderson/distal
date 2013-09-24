<h1><?php echo $program['Program']['name'];?></h1>


<?php echo $this->html->link('Add a target', '/targets/add/' . $program['Program']['id']);?> | 
<?php echo $this->html->link('Impact model', '/programs/impactmodel/' . $program['Program']['id']);?>