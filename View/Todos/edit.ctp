<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Todo.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Todo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Todos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Todocategories'), array('controller' => 'todocategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Todocategory'), array('controller' => 'todocategories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="todos form">
<?php echo $this->Form->create('Todo', array(
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
		<legend><?php echo __('Edit Todo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('todocategory_id');
		echo $this->Form->input('position');
		echo $this->Form->input('completed', array('type' => 'text', 'class' => 'form-control input_date'));
	?>
	</fieldset>
<?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-primary')); ?>
<?php echo $this->Form->end(); ?>
</div>
