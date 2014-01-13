<?php
echo $this->Html->css('timelog', null, array('inline' => false));
echo $this->Html->script('timelogui', array('inline' => false));
?>

<h3>
	<?php echo __( 'Timelog'); ?>
</h3>

<div id="calendar"></div>

<div id="timelogui"></div>

<!--<input id="updateTimelog" type="button" class="btn btn-primary" value="更新" />-->
