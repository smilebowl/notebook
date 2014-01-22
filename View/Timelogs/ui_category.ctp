<div class="timelog col-sm-12">
	<div class="widget">
		<div class="widget-header">
			<i class="icon glyphicon glyphicon-th"></i>
			<span class="title"></span>
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

			<table class="timeloglist">

				<?php
					$total = 0;
					foreach($timelogs as $timelog) {
						echo $this->element('../Timelogs/ui_element', array('timelog'=>$timelog));
						$total += $timelog['Timelog']['worktime'];
					}
				?>

				<tr class="total">
					<td colspan="3"></td>
					<td class="total_worktime"><?php echo number_format($total, 2); ?></td>
					<td></td>
				</tr>

			</table>

		</div>

	</div>
</div>
<input id="updateTimelog" type="button" class="btn btn-primary" value="更新" />
<?php //debug($timelogs, true);?>
<?php //echo $this->element('sql_dump'); ?>