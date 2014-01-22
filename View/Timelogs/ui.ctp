<?php
echo $this->Html->css('timelog', null, array('inline' => false));
echo $this->Html->script('timelogui', array('inline' => false));
?>

<h3>
	<?php echo __( 'Timelog'); ?>
</h3>

<div id="calendar" class="pull-left"></div>

<div id="summaryOfMonth" class="col-sm-7"></div>

<div class="clearfix"></div>

<div id="timelogui"></div>

<div id="timeloglist">

</div>
