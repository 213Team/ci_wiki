<script>
$('body').on('hidden', '.modal', function () {$(this).removeData('modal');});
function showMod(id,booktitle){
	$('#modForm').attr('action', "<?php echo site_url('usercenter/domodbook');?>/"+id+"/");
	$('#newtitle').attr('placeholder', booktitle);
	$('#modalModify').modal();
}

function showDel(id){
	$('#delForm').attr('action', "<?php echo site_url('usercenter/dodelbook');?>/"+id+"/");
	$('#modalDelete').modal();
}
</script>

<div class="col-md-8" style="margin-top:70px;">
<div class="row">
<div class="col-md-11 col-md-offset-1">
<div class="panel panel-default boxshadow no-radius">
	<div class="panel-heading"><strong>我创作的书籍</strong></div>
    <?php 
          if(!$mybooks):?>
	<div class="alert alert-info no-radius">
  			<strong>您还没有任何书籍。</strong>
	</div>
	<?php else:?>
	<table class="table table-striped table-hover">
	<thead>
            <tr>
              <th>#</th>
              <th>书名</th>
              <th>最后修改</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
          
          <?php $i = 1;
          foreach($mybooks as $book){
          ?>	
            <tr>
              <td><?php echo $i;?></td>
              <td width="60%"><?php echo anchor("usercenter/catalog/{$book->id}", $book->title);?></td>
              <td><?php echo $book->lastmod;?> </td>
              <td><a href="javascript:showMod(<?php echo $book->id.',\''.$book->title.'\'';?>)">修改书名</a>&nbsp;&nbsp;<a href="javascript:showDel(<?php echo $book->id;?>)">删除</a></td>
            </tr>
           <?php $i++;}?>
          </tbody>
	</table>
	<?php endif;?>
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

<!-- Modal Modify-->
<div class="modal fade" id="modalModify" tabindex="-1" role="dialog" aria-labelledby="modalModify" aria-hidden="true" style="padding-top:70px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">新书名</h4>
      </div>
      <?php echo form_open("", 'id="modForm"');?>
      <div class="modal-body">
      <div class="form-group">
    		<label for="newtitle" class="sr-only">修改书名</label>
    		<div class="col-sm-10">
      			<input type="text" class="form-control" id="newtitle" name="newtitle" placeholder="">
    		</div>
  		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">修改</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Delete-->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true" style="padding-top:70px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">删除书籍</h4>
      </div>
      <div class="modal-body">
        您确定要删除本书的全部内容吗？
      </div>
      <div class="modal-footer">
      <?php echo form_open("", 'id="delForm"');?>
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-danger">删除</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

