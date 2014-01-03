<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('Edit Notecategory'), array('action' => 'edit', $notecategory['Notecategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Notecategory'), array('action' => 'delete', $notecategory['Notecategory']['id']), null, __('Are you sure you want to delete # %s?', $notecategory['Notecategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Notecategories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notecategory'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Notes'), array('controller' => 'notes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Note'), array('controller' => 'notes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="notecategories view well well-sm">
<h2><?php echo __('Notecategory'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($notecategory['Notecategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($notecategory['Notecategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($notecategory['Notecategory']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($notecategory['Notecategory']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>