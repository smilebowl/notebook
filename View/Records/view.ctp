<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('Edit Record'), array('action' => 'edit', $record['Record']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Record'), array('action' => 'delete', $record['Record']['id']), null, __('Are you sure you want to delete # %s?', $record['Record']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Records'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Record'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Recordcategories'), array('controller' => 'recordcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recordcategory'), array('controller' => 'recordcategories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="records view well well-sm">
<h2><?php echo __('Record'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($record['Record']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recordcategory'); ?></dt>
		<dd>
			<?php echo $this->Html->link($record['Recordcategory']['name'], array('controller' => 'recordcategories', 'action' => 'view', $record['Recordcategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Eventdate'); ?></dt>
		<dd>
			<?php echo h($record['Record']['eventdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($record['Record']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($record['Record']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Priority'); ?></dt>
		<dd>
			<?php echo h($record['Record']['priority']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($record['Record']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>