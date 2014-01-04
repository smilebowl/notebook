<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('Edit Recordcategory'), array('action' => 'edit', $recordcategory['Recordcategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Recordcategory'), array('action' => 'delete', $recordcategory['Recordcategory']['id']), null, __('Are you sure you want to delete # %s?', $recordcategory['Recordcategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Recordcategories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recordcategory'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Records'), array('controller' => 'records', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Record'), array('controller' => 'records', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="recordcategories view well well-sm">
<h2><?php echo __('Recordcategory'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($recordcategory['Recordcategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($recordcategory['Recordcategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($recordcategory['Recordcategory']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($recordcategory['Recordcategory']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>