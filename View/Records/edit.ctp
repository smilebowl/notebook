<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Record.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Record.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Records'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Recordcategories'), array('controller' => 'recordcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recordcategory'), array('controller' => 'recordcategories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="records form">
<?php echo $this->Form->create('Record', array(
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
		<legend><?php echo __('Edit Record'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('recordcategory_id');
		echo $this->Form->input('eventdate');
		echo $this->Form->input('title');
		echo $this->Form->input('priority');
	?>
	</fieldset>
<?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-primary')); ?>
<?php echo $this->Form->end(); ?>
</div>
