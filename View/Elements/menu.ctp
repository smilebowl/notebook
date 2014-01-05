<?php
$act_todo=''; $act_memo=''; $act_calendar=''; $act_record='';
switch ($this->name) {
	case "Todos":
	case "Todocategories":
	case "Todohistories":
		$act_todo = "active";
		break;
	case "Memos":
	case "Memocategories":
		$act_memo = "active";
		break;
	case "Calendars":
	case "Calendarcategories":
		$act_calendar = "active";
		break;
	case "Records":
	case "Recordcategories":
		$act_record = "active";
		break;
};
?>

<div id="sidebar-wrapper">
	<ul class="sidebar-nav">
		<li class="sidebar-brand">
			<a href="#">NOTEBOOK</a>
		</li>

		<!-- Dashboard -->
		<li>
			<a href="<?php echo $this->Html->url(array('controller'=>'todos', 'action'=>'ui')); ?>">
				<i class="glyphicon glyphicon-home"></i>Dashboard</a>
		</li>

		<!-- Todo -->
		<li>
			<a href="<?php echo $this->Html->url(array('controller' => 'todos', 'action' => 'ui')); ?>">
				<i class="glyphicon glyphicon-tasks <?php echo $act_todo; ?>"></i><?php echo __('Todo') ?>
			</a>
		</li>
		<li>
			<ul>
				<li>
					<?php echo $this->Html->link(__('Todocategories'), array('controller' => 'todocategories', 'action' => 'index')); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Mentenance'), array('controller' => 'todos', 'action' => 'index')); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Todohistories'), array('controller' => 'todohistories', 'action' => 'index')); ?>
				</li>
			</ul>
		</li>

		<!-- Memo -->
		<li>
			<a href="<?php echo $this->Html->url(array('controller'=>'memos', 'action'=>'ui')); ?>">
				<i class="glyphicon glyphicon-book <?php echo $act_memo; ?>"></i>Memo</a>
		</li>
		<li>
			<ul>
				<li>
					<?php echo $this->Html->link(__('Memocategories'), array('controller' => 'memocategories', 'action' => 'index')); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Mentenance'), array('controller' => 'memos', 'action' => 'index')); ?>
				</li>
			</ul>
		</li>

		<!-- Record -->
		<li>
			<a href="<?php echo $this->Html->url(array('controller'=>'records', 'action'=>'ui')); ?>">
				<i class="glyphicon glyphicon-play <?php echo $act_record; ?>"></i><?php echo __('Record');?></a>
		</li>
		<li>
			<ul>
				<li>
					<?php echo $this->Html->link(__('Recordcategories'), array('controller' => 'recordcategories', 'action' => 'index')); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Mentenance'), array('controller' => 'records', 'action' => 'index')); ?>
				</li>
			</ul>
		</li>

		<!-- Calendar -->
		<li>
			<a href="<?php echo $this->Html->url(array('controller'=>'calendars', 'action'=>'ui')); ?>">
				<i class="glyphicon glyphicon-calendar <?php echo $act_calendar; ?>"></i><?php echo __('Calendar');?></a>
		</li>
		<li>
			<ul>
				<li>
					<?php echo $this->Html->link(__('Calendarcategories'), array('controller' => 'calendarcategories', 'action' => 'index')); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Mentenance'), array('controller' => 'calendars', 'action' => 'index')); ?>
				</li>
			</ul>
		</li>

	</ul>
</div>