<?php
echo $this->Html->css('timelog', null, array('inline' => false));
echo $this->Html->script('timelogui', array('inline' => false));
?>

<h3>
	<?php echo __( 'Timelog'); ?>
</h3>

<div class="row">
	<div class="col-sm-5">
		<div id="calendar"></div>
	</div>
	<div class="col-sm-6">
		<div id="summaryOfMonth"></div>
	</div>
</div>

<!--<div class="clearfix"></div>-->

<div id="timelogui"></div>

<div id="timeloglist">
</div>
