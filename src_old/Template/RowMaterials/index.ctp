
<div class="row">
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <?php if(!empty($id)){ ?>
                     <label > Edit Raw Material </label>
                <?php }else{ ?>
                     <label> Add Raw Material </label>
                <?php } ?>
            </div><hr>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($rowMaterial,['id'=>'ServiceForm']) ?>
                     <div class="row">
                        <div class="col-md-12">
                            <label class="control-label"> Material Category <span class="required" aria-required="true"> * </span></label>
                          <?= $this->Form->control('row_material_category_id',array('options' => $rowMaterialCategories,'class'=>'select2','label'=>false,'style'=>'width:100%','empty'=>'Select Category','required')) ?>
                        </div>
                    </div>
                    <span class="help-block"></span> 
                     <div class="row">
                        <div class="col-md-12">
                            <label class="control-label"> Measure Unit <span class="required" aria-required="true"> * </span></label>
                          <?= $this->Form->control('unit_id',array('options' => $units,'class'=>'select2','label'=>false,'style'=>'width:100%','empty'=>'Select Unit','required')) ?>
                        </div>
                    </div>
                    <span class="help-block"></span> 
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label"> Name <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('name',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Enter Material name','type'=>'text']);?>
                        </div>
                    </div>
                    <span class="help-block"></span> 
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label"> Opening Balence <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('opening_bal',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Enter Opening Balence','type'=>'text','required']);?>
                        </div>
                    </div>
                     <span class="help-block"></span> 
                      <div class="row">
                        <div class="col-md-12">
                            <label class="control-label"> Re-Useable Status<span class="required" aria-required="true"> * </span></label>
                          <?= $this->Form->control('reuseable',array('options' => $reuseables,'class'=>'select2','label'=>false,'style'=>'width:100%','empty'=>'Select Status','required')) ?>
                        </div>
                    </div>
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
                 <div class="box-tools pull-right">
                    <div style="font-size:19px;  margin-top: -15px;" class="btn btn-box-tool" data-target="#myModal122" data-toggle="collapse"> <i class="fa fa-filter"></i></div>
                </div>
            </div> <hr>
            <div class="box-body">
                       <div  class="row collapse" id="myModal122">
                        <div class="col-md-12">
                             <?= $this->Form->create($rm_data,['autocomplete'=>'off','type'=>'get']) ?>
                                <div class="row">
                                     <div class="col-md-5">
                                        <label class="control-label"> Select Material</label>
                                        <?php echo $this->Form->control('data[id]', ['options' =>$rowMaterias, 'empty' =>'Select Material','label'=>false,'class'=>'select2','style'=>'width:100%;',]);?>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="control-label"> Category </label>
                                        <?php echo $this->Form->control('data[row_material_category_id]', ['options' =>$rowMaterialCategories, 'empty' =>'Select Category','label'=>false,'class'=>'select2','style'=>'width:100%;',]);?>
                                    </div>
                                    <div class="col-md-2">
                                         <?= $this->Form->submit('SEARCH',['class'=>'btn btn-info btnClass','style'=>'margin-top:28px;'])?>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-3 text-center">
                                      
                                    </div>
                                </div> -->
                                <?= $this->Form->end(); ?>
                            </div>
                        </div><br></br>
                <?php $page_no=$this->Paginator->current('RowMaterials'); $page_no=($page_no-1)*20; ?>
                 <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __(' Name ') ?></th>
                            <th scope="col"><?= __('Category ') ?></th>
                            <th scope="col"><?= __('Measure Unit ') ?></th>
                            <th scope="col"><?= __('Re-Useable ') ?></th>
                            <th scope="col"><?= __('Status ') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($rowMaterials as $rowMaterial): ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td>
                            <?php echo $rowMaterial->name;?>
                            </td> 
                             <td>
                            <?php echo $rowMaterial->row_material_category->name;?>
                            </td> 
                            <td>
                            <?php echo $rowMaterial->unit->name;?>
                            </td>
                            <td>
                            <?php echo $rowMaterial->reuseable;?>
                            </td>
                            <td>
                            <?php
                            if($rowMaterial->is_deleted=='1')
                            {
                                echo 'Deactive';
                            }
                            else{
                                echo 'Active';
                            }
                            ?>
                            </td>
                            <td class="actions">
                                <?= $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'index', $EncryptingDecrypting->encryptData($rowMaterial->id)],['class'=>'btn btn-info editbtn','escape'=>false, 'data-widget'=>'Edit Raw Material', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Raw Material']) ?>
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