<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Holiday.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Holiday.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Holidays'), array('action' => 'index')); ?></li>
	</ul>
</div>
<div class="holidays form">
<?php echo $this->Form->create('Holiday', array(
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
		<legend><?php echo __('Edit Holiday'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('day', array('type' => 'text', 'class' => 'form-control input_date'));
	?>
	</fieldset>
<?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-primary')); ?>
<?php echo $this->Form->end(); ?>
</div>
