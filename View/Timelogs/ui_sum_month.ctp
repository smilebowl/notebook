<div>
	<div class="widget">
		<div class="widget-header">
			<i class="icon glyphicon glyphicon-th"></i>
			<span class="title"></span>
		</div>
		<div class="widget-content nopadding">

			<table class="timelogsummay table table-hover table-condensed">

				<?php
//					debug($summary);
					$subtot = $tot = 0;
					$lastcategory = '';
					foreach ($summary as $record) :
				?>

				<?php
					// subtotal
					if ($lastcategory !== '' && $lastcategory !== $record['Timelogcategory']['Name']) :
				?>
				<tr class="sumamry-row">
					<td colspan="2"><?php echo $lastcategory;?>&nbsp;(Subtotal)</td>
					<td class="right"><?php echo $subtot; ?> </td>
				</tr>
				<?php
						$subtot = 0;
					endif;
					$lastcategory = $record['Timelogcategory']['Name'];
					$subtot += $record['Timelog']['sum_worktime'];
					$tot += $record['Timelog']['sum_worktime'];
				?>

				<tr>
					<td><?php echo $record['Timelogcategory']['Name']?> </td>
					<td><?php echo $record['Timelogtask']['Name']?> </td>
					<td class="right"><?php echo $record['Timelog']['sum_worktime']?> </td>
				</tr>

				<?php
					endforeach;
				?>
				<tr class="sumamry-row">
					<td colspan="2"><?php echo $lastcategory;?>&nbsp;(Subtotal)</td>
					<td class="right"><?php echo $subtot; ?> </td>
				</tr>
				<!--Total -->
				<tr class="sumamry-row">
					<td colspan="2">Total</td>
					<td class="right"><?php echo $tot; ?> </td>
				</tr>

			</table>

		</div>

	</div>
</div>