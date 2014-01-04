<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('Edit Calendarcategory'), array('action' => 'edit', $calendarcategory['Calendarcategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Calendarcategory'), array('action' => 'delete', $calendarcategory['Calendarcategory']['id']), null, __('Are you sure you want to delete # %s?', $calendarcategory['Calendarcategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Calendarcategories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calendarcategory'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Calendars'), array('controller' => 'calendars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calendar'), array('controller' => 'calendars', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="calendarcategories view well well-sm">
<h2><?php echo __('Calendarcategory'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($calendarcategory['Calendarcategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($calendarcategory['Calendarcategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($calendarcategory['Calendarcategory']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($calendarcategory['Calendarcategory']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>