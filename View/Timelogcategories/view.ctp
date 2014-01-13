<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('Edit Timelogcategory'), array('action' => 'edit', $timelogcategory['Timelogcategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Timelogcategory'), array('action' => 'delete', $timelogcategory['Timelogcategory']['id']), null, __('Are you sure you want to delete # %s?', $timelogcategory['Timelogcategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Timelogcategories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timelogcategory'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timelogs'), array('controller' => 'timelogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timelog'), array('controller' => 'timelogs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="timelogcategories view well well-sm">
<h2><?php echo __('Timelogcategory'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($timelogcategory['Timelogcategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($timelogcategory['Timelogcategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($timelogcategory['Timelogcategory']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($timelogcategory['Timelogcategory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($timelogcategory['Timelogcategory']['deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted Date'); ?></dt>
		<dd>
			<?php echo h($timelogcategory['Timelogcategory']['deleted_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>