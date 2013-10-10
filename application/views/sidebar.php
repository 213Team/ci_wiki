<?php
function cmp($a, $b)
{
    if ($a->orderid == $b->orderid) {
        return 0;
    }
    return ($a->orderid < $b->orderid) ? -1 : 1;
}

	function printTitle($cata, $fid, $cid,$i){
		if(!isset($cata[$fid]))
			return;
		usort($cata[$fid], "cmp");
		$k = 1;
		foreach($cata[$fid] as $row){
			if($row->id == $cid)
				echo '<li style="background-color: #efefef">';
			else
				echo '<li>';
			for($s = $i; $s > 0; $s--){
				echo '&nbsp;&nbsp;&nbsp;&nbsp;';
			}
			
			echo anchor("books/view/".$row->bookid.'/'.$row->id, $k.".&nbsp;&nbsp;".$row->title);
			echo '</li>';
			printTitle($cata, $row->id, $cid, $i + 1);
			$k++;
		}
	}
?>
<div class="col-md-4" style="margin-top:70px;">
<div class="row">
<div class="col-md-offset-3 col-md-8">

<ul class="nav nav-stacked">
	<li class="disabled nav-header"><a><?php echo $book->title;?>&nbsp;:&nbsp;目录</a></li>
	<?php printTitle($catalog, -1, $cid, 0);?>
	<li class="disabled nav-header"><a>操作</a></li>
	<li><?php echo anchor("books/generatePDF/{$bookid}","下载本书pdf");?></li>
	<li><?php echo anchor("books/pullrequest/{$bookid}/{$cid}","修改建议");?></li>
</ul>

</div>
</div>
</div>
