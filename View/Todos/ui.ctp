<?php
	echo $this->Html->css('todo', null, array('inline' => false));
	echo $this->Html->script('todoui', array('inline' => false));
?>
<!--
<div class="actions">
	<h3>
		<?php echo __( 'Actions'); ?>
	</h3>
	<ul class="nav nav-pills well well-sm">
		<li>
			<?php echo $this->Html->link(__('New Todo'), array('action' => 'add')); ?></li>
		<li>
			<?php echo $this->Html->link(__('List Todohistories'), array('controller' => 'todohistories', 'action' => 'index')); ?></li>
		<li>
			<?php echo $this->Html->link(__('List Todocategories'), array('controller' => 'todocategories', 'action' => 'index')); ?></li>
		<li>
			<?php echo $this->Html->link(__('New Todocategory'), array('controller' => 'todocategories', 'action' => 'add')); ?></li>
	</ul>
</div>
-->

<h3><?php echo __( 'Todo'); ?></h3>


<!--<div class="col-sm-12">-->
<div class="categories clearfix">
	<?php foreach($todos as $todoset) : ?>
	<div class="infobox col-sm-2">
		<a href="#category-<?php echo $todoset['Todocategory']['id']?>"><?php echo $todoset['Todocategory']['name']; ?></a>
	</div>
	<?php endforeach; ?>
</div>

<div class="todoui ">

	<?php foreach($todos as $todoset) : ?>

	<div class="todo col-sm-6" id="category-<?php echo $todoset['Todocategory']['id'] ?>">
		<div class="widget">
			<div class="widget-header">
				<i class="icon glyphicon glyphicon-th" title="ドッラグで移動＋α"></i>
				<span class="title" contenteditable="true"><?php echo $todoset[ 'Todocategory'][ 'name']; ?></span>
				<span class="actions">
					<i class="insert glyphicon glyphicon-plus" title="アイテム追加"></i>&nbsp;
					<i class="toggletool glyphicon glyphicon-wrench"></i>
					<span class="toolbox" style="display:none;">
						<input type="checkbox" class="tooglecheckall" />
						<i class="donechecked glyphicon glyphicon-ok" title="チェック分を完了"></i>
						<i class="historychecked glyphicon glyphicon-share" title="チェック分を履歴へ"></i>
						<i class="removechecked glyphicon glyphicon-remove" title="チェック分を削除"></i>
					</span>
					<i class="off glyphicon glyphicon-off" title="Todo一覧を非表示"></i>
				</span>
			</div>
			<div class="widget-content nopadding">

				<table class="todolist">

					<?php
						foreach($todoset[ 'Todo'] as $todo) {
							echo $this->element('../Todos/ui_element', array('todo'=>$todo));
						}
					?>

				</table>


			</div>

		</div>
	</div>

	<?php endforeach; ?>

</div>