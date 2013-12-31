<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('Edit Todohistory'), array('action' => 'edit', $todohistory['Todohistory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Todohistory'), array('action' => 'delete', $todohistory['Todohistory']['id']), null, __('Are you sure you want to delete # %s?', $todohistory['Todohistory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Todohistories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Todohistory'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Todocategories'), array('controller' => 'todocategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Todocategory'), array('controller' => 'todocategories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="todohistories view well well-sm">
<h2><?php echo __('Todohistory'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($todohistory['Todohistory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($todohistory['Todohistory']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Todocategory'); ?></dt>
		<dd>
			<?php echo $this->Html->link($todohistory['Todocategory']['name'], array('controller' => 'todocategories', 'action' => 'view', $todohistory['Todocategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($todohistory['Todohistory']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Priority'); ?></dt>
		<dd>
			<?php echo h($todohistory['Todohistory']['priority']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($todohistory['Todohistory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Completed'); ?></dt>
		<dd>
			<?php echo h($todohistory['Todohistory']['completed']); ?>
			&nbsp;
		</dd>
	</dl>
</div>