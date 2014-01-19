<?php
echo $this->Html->css('timelog', null, array('inline' => false));
echo $this->Html->script('timelogui', array('inline' => false));
?>

<h3>
	<?php echo __( 'Timelog'); ?>
</h3>

<div class="row">
	<div id="calendar" class="col-sm-5"></div>
	<div id="summaryOfMonth" class="col-sm-6"></div>
</div>

<!--<div class="clearfix"></div>-->

<div id="timelogui"></div>

<div id="timeloglist">
</div>
