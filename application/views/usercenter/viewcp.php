<?php 
include_once 'markdown/Michelf/Markdown.php';
include_once 'markdown/Michelf/MarkdownExtra.php';
use \Michelf\MarkdownExtra;
?>
<script>
$('body').on('hidden', '.modal', function () {$(this).removeData('modal');});
function showConfirm(id){
	$('#fallbackForm').attr('action', "<?php echo site_url('usercenter/dofallback');?>/"+id+"/");
	$('#modalConfirm').modal();
}
</script>

<div class="col-md-8" style="margin-top:70px;">
<div class="row">
<div class="col-md-11 col-md-offset-1">
<?php
if($cp->body)
	echo MarkdownExtra::defaultTransform($cp->body);
?>
<button type="button" class="btn btn-primary" onclick="javascript:showConfirm(<?php echo $cp->id;?>)">回滚到本还原点</button>
</div>
</div>
</div>

<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="modalConfirm" aria-hidden="true" style="padding-top:70px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">回滚至还原点</h4>
      </div>
      <div class="modal-body">
        您确定要将本节回滚到此还原点吗？
      </div>
      <div class="modal-footer">
      <?php echo form_open("", 'id="fallbackForm"');?>
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-danger">回滚</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
