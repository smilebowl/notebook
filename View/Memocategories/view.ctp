<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="nav nav-pills well well-sm">
		<li><?php echo $this->Html->link(__('Edit Memocategory'), array('action' => 'edit', $memocategory['Memocategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Memocategory'), array('action' => 'delete', $memocategory['Memocategory']['id']), null, __('Are you sure you want to delete # %s?', $memocategory['Memocategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Memocategories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Memocategory'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Memos'), array('controller' => 'memos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Memo'), array('controller' => 'memos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="memocategories view well well-sm">
<h2><?php echo __('Memocategory'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($memocategory['Memocategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($memocategory['Memocategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($memocategory['Memocategory']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($memocategory['Memocategory']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>