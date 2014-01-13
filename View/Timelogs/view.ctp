<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('Edit Timelog'), array('action' => 'edit', $timelog['Timelog']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Timelog'), array('action' => 'delete', $timelog['Timelog']['id']), null, __('Are you sure you want to delete # %s?', $timelog['Timelog']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Timelogs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timelog'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timelogcategories'), array('controller' => 'timelogcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timelogcategory'), array('controller' => 'timelogcategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timelogtasks'), array('controller' => 'timelogtasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timelogtask'), array('controller' => 'timelogtasks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="timelogs view well well-sm">
<h2><?php echo __('Timelog'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($timelog['Timelog']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Timelogcategory'); ?></dt>
		<dd>
			<?php echo $this->Html->link($timelog['Timelogcategory']['name'], array('controller' => 'timelogcategories', 'action' => 'view', $timelog['Timelogcategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Timelogtask'); ?></dt>
		<dd>
			<?php echo $this->Html->link($timelog['Timelogtask']['name'], array('controller' => 'timelogtasks', 'action' => 'view', $timelog['Timelogtask']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Workdate'); ?></dt>
		<dd>
			<?php echo h($timelog['Timelog']['workdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($timelog['Timelog']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Worktime'); ?></dt>
		<dd>
			<?php echo h($timelog['Timelog']['worktime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($timelog['Timelog']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($timelog['Timelog']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>