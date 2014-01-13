<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">

		<li><?php echo $this->Html->link(__('List Timelogcategories'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Timelogs'), array('controller' => 'timelogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timelog'), array('controller' => 'timelogs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="timelogcategories form">
<?php echo $this->Form->create('Timelogcategory', array(
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
		<legend><?php echo __('Add Timelogcategory'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('position');
	?>
	</fieldset>
<?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-primary')); ?>
<?php echo $this->Form->end(); ?>
</div>
