<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">

		<li><?php echo $this->Html->link(__('List Calendars'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Calendarcategories'), array('controller' => 'calendarcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calendarcategory'), array('controller' => 'calendarcategories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="calendars form">
<?php echo $this->Form->create('Calendar', array(
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
		<legend><?php echo __('Add Calendar'); ?></legend>
	<?php
		echo $this->Form->input('calendarcategory_id');
		echo $this->Form->input('title');
		echo $this->Form->input('start', array('type' => 'text', 'class' => 'form-control input_date'));
		echo $this->Form->input('end', array('type' => 'text', 'class' => 'form-control input_date'));
		echo $this->Form->input('detail');
		echo $this->Form->input('color');
		echo $this->Form->input('textcolor');
	?>
	</fieldset>
<?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-primary')); ?>
<?php echo $this->Form->end(); ?>
</div>
