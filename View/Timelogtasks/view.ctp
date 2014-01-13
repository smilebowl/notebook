<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('Edit Timelogtask'), array('action' => 'edit', $timelogtask['Timelogtask']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Timelogtask'), array('action' => 'delete', $timelogtask['Timelogtask']['id']), null, __('Are you sure you want to delete # %s?', $timelogtask['Timelogtask']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Timelogtasks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timelogtask'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timelogs'), array('controller' => 'timelogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timelog'), array('controller' => 'timelogs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="timelogtasks view well well-sm">
<h2><?php echo __('Timelogtask'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($timelogtask['Timelogtask']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($timelogtask['Timelogtask']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($timelogtask['Timelogtask']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($timelogtask['Timelogtask']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($timelogtask['Timelogtask']['deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted Date'); ?></dt>
		<dd>
			<?php echo h($timelogtask['Timelogtask']['deleted_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>