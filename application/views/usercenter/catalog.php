<?php
function cmp($a, $b)
{
    if ($a->id == $b->id) {
        return 0;
    }
    return ($a->id < $b->id) ? -1 : 1;
}

	function printTitle($cata, $fid, $i){
		if(!isset($cata[$fid]))
			return;
		usort($cata[$fid], "cmp");
		$k = 1;
		foreach($cata[$fid] as $row){
			echo '<tr><td style="border-top: none;">';
			for($s = $i; $s > 0; $s--){
				echo '&nbsp;&nbsp;&nbsp;&nbsp;';
			}
			echo anchor("usercenter/edit/".$row->id, $k.".&nbsp;&nbsp;".$row->title);
			echo '</td></tr>';
			printTitle($cata, $row->id, $i + 1);
		}
	}
?>

<div class="col-md-8" style="margin-top:70px;">
<div class="row">
<div class="col-md-11 col-md-offset-1">
<div class="panel panel-default boxshadow no-radius">
	<div class="panel-heading"><strong><?php echo $book_title;?></strong></div>
	<table class="table table-hover">
    	<?php printTitle($catalog, -1, 0);?>
	</table>
	</div>
</div>
</div>
</div>
</div>
