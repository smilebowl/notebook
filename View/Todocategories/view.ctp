<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('Edit Todocategory'), array('action' => 'edit', $todocategory['Todocategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Todocategory'), array('action' => 'delete', $todocategory['Todocategory']['id']), null, __('Are you sure you want to delete # %s?', $todocategory['Todocategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Todocategories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Todocategory'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Todos'), array('controller' => 'todos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Todo'), array('controller' => 'todos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="todocategories view well well-sm">
<h2><?php echo __('Todocategory'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($todocategory['Todocategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($todocategory['Todocategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($todocategory['Todocategory']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($todocategory['Todocategory']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>