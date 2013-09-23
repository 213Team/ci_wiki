<div class="col-md-8" style="margin-top:70px;">
<div class="row">
<div class="col-md-11 col-md-offset-1">
<div class="panel panel-default boxshadow no-radius">
	<div class="panel-heading"><strong>我创作的书籍</strong></div>
	<table class="table table-striped table-hover">
	<thead>
            <tr>
              <th>#</th>
              <th>书名</th>
              <th>最后修改</th>
            </tr>
          </thead>
          <tbody>
          <?php 
          $i = 1;
          foreach($mybooks as $book){
          ?>	
            <tr>
              <td><?php echo $i;?></td>
              <td width="60%"><?php echo anchor("usercenter/catalog/{$book->id}", $book->title);?></td>
              <td><?php echo $book->lastmod;?> </td>
            </tr>
           <?php $i++;}?>
          </tbody>
	</table>
	<div class="panel-footer">
	<?php if (isset($tips) && $tips != ''){?>
		<div class="alert alert-danger">
  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  			<strong><?php echo $tips;?></strong>
		</div>
	<?php }?>
	<?php echo form_open('usercenter/doaddbook','class="form-inline" role="form"');?>
  		<div class="form-group">
    		<label for="title" class="sr-only">添加书籍</label>
    		<div class="col-sm-10">
      			<input type="text" class="form-control" id="title" name="title" placeholder="添加书籍">
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
