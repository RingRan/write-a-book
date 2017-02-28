
<?php
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$modelLesson = new \common\models\Lesson();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      
        <div class="box-header">
          <h3 class="box-title">单元管理</h3>
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <button id="create_btn" type="button" class="btn btn-xs btn-primary">添&nbsp;&emsp;加</button>
        			|
        		<button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <!-- row start search-->
          	<div class="row">
          	<div class="col-sm-12">
                <?php ActiveForm::begin(['id' => 'lesson-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute(['lesson/index', 'chapterId' => $chapter->id])]); ?> 
                
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLesson->getAttributeLabel('id')?>:</label>
                      <input type="text" class="form-control" id="query[id]" name="query[id]"  value="<?=isset($query["id"]) ? $query["id"] : "" ?>">
                  </div>
              <div class="form-group">
              	<a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
           	  </div>
               <?php ActiveForm::end(); ?> 
            </div>
          	</div>
          	<!-- row end search -->
          	
          	<!-- row start -->
          	<div class="row">
          	<div class="col-sm-12">
          	<table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
            <thead>
            <tr role="row">
            
            <?php 
		      echo '<th><input id="data_table_check" type="checkbox"></th>';
              echo '<th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLesson->getAttributeLabel('id').'</th>';
              echo '<th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLesson->getAttributeLabel('course_id').'</th>';
              echo '<th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLesson->getAttributeLabel('chapter_id').'</th>';
              echo '<th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLesson->getAttributeLabel('title').'</th>';
              echo '<th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLesson->getAttributeLabel('status').'</th>';
              echo '<th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLesson->getAttributeLabel('order').'</th>';
              echo '<th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLesson->getAttributeLabel('course_id').'</th>';
              echo '<th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLesson->getAttributeLabel('created_at').'</th>';
              echo '<th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLesson->getAttributeLabel('updated_at').'</th>';
			?>
	
            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
            </tr>
            </thead>
            <tbody>
            
            <?php
            $row = 0;
            foreach ($models as $model) {
                echo '<tr id="rowid_' . $model->id . '">';
                echo '  <td><label><input type="checkbox" value="' . $model->id . '"></label></td>';
                echo '  <td>' . $model->id . '</td>';
                echo '  <td>' . $model->course->title . '</td>';
                echo '  <td>' . $model->chapter->title . '</td>';
                echo '  <td>' . $model->title . '</td>';
                echo '  <td>' . $model->status . '</td>';
                echo '  <td>' . $model->order . '</td>';
                echo '  <td>' . $model->course->title . '</td>';
                echo '  <td>' . $model->created_at . '</td>';
                echo '  <td>' . $model->updated_at . '</td>';
                echo '  <td class="center">';
                echo '      <a id="view_btn" onclick="viewAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>';
                echo '      <a id="edit_btn" onclick="editAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>';
                echo '      <a id="delete_btn" onclick="deleteAction(' . $model->id . ')" class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
                echo '  </td>';
                echo '<tr/>';
            }
            
            ?>
            </tbody>
            <!-- <tfoot></tfoot> -->
          </table>
          </div>
          </div>
          <!-- row end -->
          
          <!-- row start -->
          <div class="row">
          	<div class="col-sm-5">
            	<div class="dataTables_info" id="data_table_info" role="status" aria-live="polite">
            		<div class="infos">
            		从<?= $pages->getPage() * $pages->getPageSize() + 1 ?>            		到 <?= ($pageCount = ($pages->getPage() + 1) * $pages->getPageSize()) < $pages->totalCount ?  $pageCount : $pages->totalCount?>            		 共 <?= $pages->totalCount?> 条记录</div>
            	</div>
            </div>
          	<div class="col-sm-7">
              	<div class="dataTables_paginate paging_simple_numbers" id="data_table_paginate">
              	<?= LinkPager::widget([
              	    'pagination' => $pages,
              	    'nextPageLabel' => '下一页',
              	    'prevPageLabel' => '上一页',
              	    'firstPageLabel' => '首页',
              	    'lastPageLabel' => '尾页',
              	]); ?>	
              	
              	</div>
          	</div>
		  </div>
		  <!-- row end -->
        </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<div class="modal fade" id="edit_dialog" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "lesson-form", "class"=>"form-horizontal", "action"=>Url::toRoute("lesson/save")]); ?>                      
            	<input type="hidden" class="form-control" id="chapterId" name="Lesson[chapter_id]" value="<?php echo $chapterId;?>"/>
            	<input type="hidden" class="form-control" id="courseId" name="Lesson[course_id]" value="<?php echo $chapter->course_id;?>"/>
            	<input type="hidden" class="form-control" id="id" name="Lesson[id]" />
            	<div class="form-group">
	              	<label class="col-sm-2 control-label">
	              		<?php echo $modelLesson->getAttributeLabel("course_id")?>
	              	</label>
	              	<div class="col-sm-10">
	              		<?php echo $chapter->course->title;?>
	              	</div>
	              	<div class="clearfix"></div>
	          	</div>
            	<div class="form-group">
	              	<label class="col-sm-2 control-label"><?php echo $modelLesson->getAttributeLabel("chapter_id")?></label>
	              	<div class="col-sm-10" >
	              		<?php echo $chapter->title;?>
	              	</div>
	              	<div class="clearfix"></div>
	          	</div>
	          	<div id="title_div" class="form-group">
	              	<label for="title" class="col-sm-2 control-label"><?php echo $modelLesson->getAttributeLabel("title")?></label>
	              	<div class="col-sm-10">
	                	<input type="text" class="form-control" id="title" name="Lesson[title]" placeholder="必填" />
	              	</div>
	              	<div class="clearfix"></div>
	          	</div>
	          	<div id="desc_div" class="form-group">
	              	<label for="desc" class="col-sm-2 control-label"><?php echo $modelLesson->getAttributeLabel("desc")?></label>
	              	<div class="col-sm-10">
	                	<input type="text" class="form-control" id="desc" name="Lesson[desc]" placeholder="必填" />
	              	</div>
	              	<div class="clearfix"></div>
	          	</div>
	          	<div id="order_div" class="form-group">
	              	<label for="order" class="col-sm-2 control-label"><?php echo $modelLesson->getAttributeLabel("order")?></label>
	              	<div class="col-sm-10">
	                	<input type="text" class="form-control" id="order" name="Lesson[order]" placeholder="必填" />
	              	</div>
	              	<div class="clearfix"></div>
	          	</div>

			<?php ActiveForm::end(); ?>          
                </div>
			<div class="modal-footer">
				<a href="#" class="btn btn-default" data-dismiss="modal">关闭</a> <a
					id="edit_dialog_ok" href="#" class="btn btn-primary">确定</a>
			</div>
		</div>
	</div>
</div>
<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
 <script>
 function searchAction(){
		$('#lesson-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#title").val('');
    	$("#desc").val('');
    	$("#order").val('');
	}else{
		$("#id").val(data.id);
    	$("#title").val(data.title);
    	$("#desc").val(data.desc);
    	$("#order").val(data.order);
    }
    
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#title").attr({readonly:true,disabled:true});
      $("#desc").attr({readonly:true,disabled:true});
      $("#order").attr({readonly:true,disabled:true});
	  $('#edit_dialog_ok').addClass('hidden');
	}else{
      $("#id").attr({readonly:false,disabled:false});
      $("#title").attr({readonly:true,disabled:true});
      if(type == "create" || type == "edit"){
    	  $("#title").attr({readonly:false,disabled:false});
    	  $("#desc").attr({readonly:false,disabled:false});
    	  $("#order").attr({readonly:false,disabled:false});
      }else{
    	  $("#title").attr({readonly:true,disabled:true});
      }
      
	  $('#edit_dialog_ok').removeClass('hidden');
	}
	$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('lesson/view')?>",
		   data: {"id":id},
		   cache: false,
		   dataType:"json",
		   error: function (xmlHttpRequest, textStatus, errorThrown) {
			    alert("出错了，" + textStatus);
			},
		   success: function(data){
			   initEditSystemModule(data, type);
		   }
		});
}
	
function editAction(id){
	initModel(id, 'edit');
}

function deleteAction(id){
	var ids = [];
	if(!!id == true){
		ids[0] = id;
	}
	else{
		var checkboxs = $('#data_table :checked');
	    if(checkboxs.size() > 0){
	        var c = 0;
	        for(i = 0; i < checkboxs.size(); i++){
	            var id = checkboxs.eq(i).val();
	            if(id != ""){
	            	ids[c++] = id;
	            }
	        }
	    }
	}
	if(ids.length > 0){
		admin_tool.confirm('请确认是否删除', function(){
		    $.ajax({
				   type: "get",
				   url: "<?=Url::toRoute('lesson/delete')?>",
				   data: {"ids":ids, },
				   cache: false,
				   dataType:"json",
				   error: function (xmlHttpRequest, textStatus, errorThrown) {
					    alert("出错了，" + textStatus);
					},
				   success: function(data){
					   for(i = 0; i < ids.length; i++){
						   $('#rowid_' + ids[i]).remove();
					   }
					   admin_tool.alert('msg_info', '删除成功', 'success');
					   window.location.reload();
				   }
				});
		});
	}else{
 		admin_tool.alert('msg_info', '请先选择要删除的数据', 'warning');
	}
    
}

function getSelectedIdValues(formId)
{
	var value="";
	$( formId + " :checked").each(function(i)
	{
		if(!this.checked)
		{
			return true;
		}
		value += this.value;
		if(i != $("input[name='id']").size()-1)
		{
			value += ",";
		}
	 });
	return value;
}

$('#edit_dialog_ok').click(function (e) {
    e.preventDefault();
	$('#lesson-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#lesson-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	
	var action = id == "" ? "<?=Url::toRoute('lesson/create')?>" : "<?=Url::toRoute('lesson/update')?>";
    $(this).ajaxSubmit({
    	type: "post",
    	dataType:"json",
    	url: action,
    	data:{id:id},
    	success: function(value) 
    	{
        	if(value.errno == 0){
        		$('#edit_dialog').modal('hide');
        		admin_tool.alert('msg_info', '添加成功', 'success');
        		window.location.reload();
        	}else{
            	var json = value.data;
        		for(var key in json){
        			$('#' + key).attr({'data-placement':'bottom', 'data-content':json[key], 'data-toggle':'popover'}).addClass('popover-show').popover('show');
        		}
        	}

    	}
    });
});

 
</script>
<?php $this->endBlock(); ?>