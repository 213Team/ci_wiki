<script>
$('body').on('hidden', '.modal', function () {$(this).removeData('modal');});

function showDel(id){
	$('#delForm').attr('action', "<?php echo site_url('usercenter/dodelcp');?>/"+id+"/");
	$('#modalDelete').modal();
}
</script>

<div class="col-md-8" style="margin-top:70px;">
<div class="row">
<div class="col-md-11 col-md-offset-1">
<div class="panel panel-default boxshadow no-radius">
	<div class="panel-heading"><strong><?php echo $cata->title;?>&nbsp;&nbsp;的历史还原点</strong></div>
    <?php 
          if(!$cp):?>
	<div class="alert alert-info no-radius">
  			<strong>您还没有创建任何还原点。</strong>
	</div>
	<?php else:?>
	<table class="table table-striped table-hover">
	<thead>
            <tr>
              <th>#</th>
              <th>创建时间</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
          
          <?php $i = 1;
          foreach($cp as $row){
          ?>	
            <tr>
              <td><?php echo $i;?></td>
              <td width="60%"><?php echo anchor("usercenter/viewcp/{$row->id}", $row->lastmod);?></td>
              <td><a href="javascript:showDel(<?php echo $row->id;?>)">删除</a></td>
            </tr>
           <?php $i++;}?>
          </tbody>
	</table>
	<?php endif;?>

	</div>
</div>
</div>
</div>
</div>

<!-- Modal Delete-->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true" style="padding-top:70px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">删除还原点</h4>
      </div>
      <div class="modal-body">
        您确定要删除此还原点吗？
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

