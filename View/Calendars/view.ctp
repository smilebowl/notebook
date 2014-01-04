<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('Edit Calendar'), array('action' => 'edit', $calendar['Calendar']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Calendar'), array('action' => 'delete', $calendar['Calendar']['id']), null, __('Are you sure you want to delete # %s?', $calendar['Calendar']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Calendars'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calendar'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Calendarcategories'), array('controller' => 'calendarcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calendarcategory'), array('controller' => 'calendarcategories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="calendars view well well-sm">
<h2><?php echo __('Calendar'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($calendar['Calendar']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Calendarcategory'); ?></dt>
		<dd>
			<?php echo $this->Html->link($calendar['Calendarcategory']['name'], array('controller' => 'calendarcategories', 'action' => 'view', $calendar['Calendarcategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($calendar['Calendar']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start'); ?></dt>
		<dd>
			<?php echo h($calendar['Calendar']['start']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End'); ?></dt>
		<dd>
			<?php echo h($calendar['Calendar']['end']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Detail'); ?></dt>
		<dd>
			<?php echo h($calendar['Calendar']['detail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo h($calendar['Calendar']['color']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Textcolor'); ?></dt>
		<dd>
			<?php echo h($calendar['Calendar']['textcolor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($calendar['Calendar']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>