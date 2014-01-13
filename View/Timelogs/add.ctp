<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">

		<li><?php echo $this->Html->link(__('List Timelogs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Timelogcategories'), array('controller' => 'timelogcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timelogcategory'), array('controller' => 'timelogcategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timelogtasks'), array('controller' => 'timelogtasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timelogtask'), array('controller' => 'timelogtasks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="timelogs form">
<?php echo $this->Form->create('Timelog', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'label' => array('class' => 'col col-sm-3 control-label'),
		'wrapInput' => 'col col-sm-9',
		'class' => 'form-control',
	),
	'class' => 'well form-horizontal',
	'novalidate' => true,
)); ?>
	<fieldset>
		<legend><?php echo __('Add Timelog'); ?></legend>
	<?php
		echo $this->Form->input('timelogcategory_id');
		echo $this->Form->input('timelogtask_id');
		echo $this->Form->input('workdate', array('type' => 'text', 'class' => 'form-control input_date'));
		echo $this->Form->input('title');
		echo $this->Form->input('worktime');
	?>
	</fieldset>
<?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-primary')); ?>
<?php echo $this->Form->end(); ?>
</div>
