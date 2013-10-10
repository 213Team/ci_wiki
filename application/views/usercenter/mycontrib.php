<div class="col-md-8" style="margin-top:70px;">
<div class="row">
<div class="col-md-11 col-md-offset-1">
<div class="panel panel-default boxshadow no-radius">
	<div class="panel-heading"><strong>我参与贡献的书籍</strong></div>
	
	<?php if(!$mycontrib || count($mycontrib) == 0){?>
    	<div class="alert alert-info no-radius">
  			<strong>暂时没有贡献任何意见。</strong>
		</div>
	<?php }else{?>
	<table class="table table-hover table-striped">
    	<thead>
            <tr>
              <th>#</th>
              <th>书籍：章节</th>
              <th>创作用户</th>
            </tr>
        </thead>
        <?php $i = 1;
          foreach($mycontrib as $row){
          ?>	
            <tr>
              <td><?php echo $i;?></td>
              <td width="60%"><?php echo anchor("books/view/{$row->bid}/{$row->cid}", $row->btitle." : ".$row->ctitle);?></td>
              <td><?php echo $row->username?></td>
            </tr>
           <?php $i++;}?>
          </tbody>
	</table>
	<?php }?>
</div>
</div>
</div>
</div>
