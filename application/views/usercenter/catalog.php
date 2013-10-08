<?php
function cmp($a, $b)
{
    if ($a->orderid == $b->orderid) {
        return 0;
    }
    return ($a->orderid < $b->orderid) ? -1 : 1;
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
			echo anchor("usercenter/edit/".$row->bookid.'/'.$row->id, $k.".&nbsp;&nbsp;".$row->title);
			echo '</td></tr>';
			printTitle($cata, $row->id, $i + 1);
			$k++;
		}
	}
?>
<div class="col-md-8" style="margin-top:70px;">
<div class="row">
<div class="col-md-11 col-md-offset-1">
<div class="panel panel-default boxshadow no-radius">
	<div class="panel-heading"><strong><?php echo $book->title;?></strong></div>
	
	<?php if(count($catalog) == 0){?>
    	<div class="alert alert-info no-radius">
  			<strong>本书还没有任何章节。</strong>
		</div>
	<?php }else{?>
	<table class="table table-hover">
    	<?php printTitle($catalog, -1, 0);?>
	</table>
	<?php }?>
	<div class="panel-footer">
	<?php if (isset($tips) && $tips != ''){?>
		<div class="alert alert-danger">
  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  			<strong><?php echo $tips;?></strong>
		</div>
	<?php }?>
	<?php echo form_open("usercenter/doaddcatalog/{$book->id}",'class="form-inline" role="form"');?>
  		<div class="form-group">
    		<label for="title" class="sr-only">添加章节</label>
    		<div class="col-sm-10">
      			<input type="text" class="form-control" id="title" name="title" placeholder="添加章节">
    		</div>
  		</div>

  		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-10">
     			<button type="submit" class="btn btn-default">添加</button>
    		</div>
  		</div>
	</form>
	</div>
</div>
</div>
</div>
</div>
