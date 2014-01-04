<div class="record col-sm-12" id="category-<?php echo $recordcategory_id; ?>">
	<div class="widget">
		<div class="widget-header">
			<i class="icon glyphicon glyphicon-th"></i>
			<span class="title" contenteditable="true"></span>
			<span class="actions">
				<i class="insert glyphicon glyphicon-plus" title="アイテム追加"></i>
				<i class="toggletool glyphicon glyphicon-wrench" title="ツール"></i>
				<span class="toolbox" style="display:none;">
					<input type="checkbox" class="tooglecheckall" />
					<i class="removechecked glyphicon glyphicon-remove" title="チェック分を削除"></i>
				</span>
			</span>
		</div>
		<div class="widget-content nopadding">

			<table class="recordlist">

				<?php
					foreach($records as $record) {
						echo $this->element('../Records/ui_element', array('record'=>$record));
					}
				?>

			</table>


		</div>

	</div>
</div>