
<div class="row">
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <?php if(!empty($id)){ ?>
                     <label > Edit Category </label>
                <?php }else{ ?>
                     <label> Add Category </label>
                <?php } ?>
            </div><hr>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($rowMaterialCategory,['id'=>'ServiceForm']) ?>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label"> Name <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('name',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Enter category name','type'=>'text']);?>
                        </div>
                    </div>
                    <span class="help-block"></span>
                    <?php if(!empty($id)){ ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Status </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <hr>
                    <div class="row">
                        <center>
                            <div class="col-md-12">
                                <div class="col-md-offset-3 col-md-6">  
                                    <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member']); ?>
                                </div>
                            </div>
                        </center>       
                    </div>
                       <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header with-border">
                <label> View List </label>
            </div> <hr>
            <div class="box-body">
                <?php $page_no=$this->Paginator->current('RowMaterialCategories'); $page_no=($page_no-1)*20; ?>
                 <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __('Category Name ') ?></th>
                            <th scope="col"><?= __('Status') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($rowMaterialCategories as $rowMaterialCategory): ?>
                        <tr>
                            <td><?php echo ++$page_no;?></td>
                            <td>
                            <?php echo $rowMaterialCategory->name;?>
                            </td> 
                            <td>
                            <?php
                            if($rowMaterialCategory->is_deleted=='1')
                            {
                                echo 'Deactive';
                            }
                            else{
                                echo 'Active';
                            }
                            ?>
                            </td>
                            <td class="actions">
                                <?= $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'index', $EncryptingDecrypting->encryptData($rowMaterialCategory->id)],['class'=>'btn btn-info editbtn','escape'=>false, 'data-widget'=>'Edit Category', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Category']) ?>
                            </td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
            </table>
            </div>
            <div class="box-footer">
                <?= $this->element('pagination') ?> 
            </div>
        </div>
    </div>
</div>
<?= $this->element('selectpicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){
  $('#ServiceForm').validate({ 
        rules: {
            name: {
                required: true
            }
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });
});
    ";
$this->Html->scriptBlock($js,['block'=>'block_js']);
 ?>