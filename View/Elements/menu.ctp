<div id="sidebar-wrapper">
	<ul class="sidebar-nav">
		<li class="sidebar-brand">
			<a href="#">NOTEBOOK</a>
		</li>
		<li>
			<a href="<?php echo $this->Html->url(array('controller'=>'todos', 'action'=>'ui')); ?>">
				<i class="glyphicon glyphicon-home"></i>Dashboard</a>
		</li>
		<!-- Todo -->
		<li>
			<a href="<?php echo $this->Html->url(array('controller' => 'todos', 'action' => 'ui')); ?>">
				<i class="glyphicon glyphicon-list-alt"></i><?php echo __('Todo') ?>
			</a>
		</li>
		<li>
			<ul>
				<li>
					<?php echo $this->Html->link(__('Mentenance'), array('controller' => 'todos', 'action' => 'index')); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Todocategories'), array('controller' => 'todocategories', 'action' => 'index')); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Todohistories'), array('controller' => 'todohistories', 'action' => 'index')); ?>
				</li>
			</ul>
		</li>
		<!-- Note -->
		<li>
			<a href="<?php echo $this->Html->url(array('controller'=>'notes', 'action'=>'ui')); ?>"><i class="glyphicon glyphicon-book"></i>Note</a>
		</li>
		<li>
			<ul>
				<li>
					<?php echo $this->Html->link(__('Mentenance'), array('controller' => 'notes', 'action' => 'index')); ?>
				</li>
			</ul>
		</li>
		<li>
			<a href="#">Shortcuts</a>
		</li>
		<li>
			<ul>
				<li>
					<a href="#">Overview</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#" class="btnxxxx">
				<i class="glyphicon glyphicon-wrench"></i>設定</a>
		</li>
		<li>
			<a href="#">About</a>
		</li>
	</ul>
</div>