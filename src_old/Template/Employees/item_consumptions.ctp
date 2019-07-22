<div class="row">
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <?php if(!empty($id)){ ?>
                     <label > Edit Item Consumption </label>
                <?php }else{ ?>
                     <label> Add Item Consumption </label>
                <?php } ?>
            </div><hr>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($itemConsumption,['id'=>'ServiceForm','method'=>'post']) ?>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label"> Select Data <span class="required" aria-required="true"> * </span></label>
                            <?= $this->Form->control('transaction_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','value'=>date('d-M-Y')])?>
                        </div>
                    </div>
                    <span class="help-block"></span> 
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label"> Material Category <span class="required" aria-required="true"> * </span></label>
                            <?= $this->Form->control('row_material_id',array('options' => $rowMaterial,'class'=>'select2 material_id','label'=>false,'style'=>'width:100%','empty'=>'Select Material','required')) ?>
                        </div>
                    </div>
                    <span class="help-block"></span> 
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label"> Quantity <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('quantity',[
                            'label' => false,'class'=>'form-control qty ','placeholder'=>'Enter quantity','type'=>'text','required','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                        </div>
                    </div>
                    <span class="help-block"></span> 
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label"> Used For <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('description',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Enter description','type'=>'textarea','required','style'=>'resize:none;']);?>
                        </div>
                    </div>
                    <span class="help-block"></span> 
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
                                    <?php echo $this->Form->button('Submit',['class'=>'btn button','name'=>'test','id'=>'submit_member']); ?>
                                </div>
                            </div>
                        </center>       
                    </div>
                       <?= $this->Form->end() ?>
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
                            <?= $this->Form->create('',['autocomplete'=>'off','type'=>'get']) ?>
                                <div class="row">
                                     <div class="col-md-6">
                                        <label class="control-label"> Select Material</label>
                                        <?php echo $this->Form->control('rm_id', ['options' =>$rowMaterial, 'empty' =>'Select Material','label'=>false,'class'=>'select2','style'=>'width:100%;',]);?>
                                    </div>
                                    <div class="col-md-2">
                                         <?= $this->Form->submit('SEARCH',['class'=>'btn btn-info btnClass','style'=>'margin-top:28px;','name'=>'filter_submit'])?>
                                    </div>
                                    <div class="col-md-2">
                                       <?= $this->Html->link(__('RESET'), ['action' => 'itemConsumptions'],['class'=>'btn btn-danger btnClass','escape'=>false, 'data-widget'=>'Reset', 'data-toggle'=>'tooltip', 'data-original-title'=>'Reset','style'=>'margin-top:28px;']) ?>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-3 text-center">
                                      
                                    </div>
                                </div> -->
                            <?= $this->Form->end(); ?>
                        </div>
                    </div>
                <?php //$page_no=$this->Paginator->current('RowMaterials'); $page_no=($page_no-1)*20; ?>
                 <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __(' Item Name ') ?></th>
                            <th scope="col"><?= __('Quantity ') ?></th>
                            <th scope="col"><?= __('Date ') ?></th>
                            <th scope="col"><?= __('Used For ') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($usedDatas as $usedData): ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td>
                            <?php echo $usedData->row_material->name;?>
                            </td> 
                             <td>
                            <?php echo $usedData->quantity.' '.$usedData->row_material->unit->name;;?>
                            </td> 
                            <td>
                            <?php echo $usedData->transaction_date;?>
                            </td>
                            <td>
                            <?php echo $usedData->description;?>
                            </td>
                            <td class="actions">
                                <a href="#delete<?php echo $usedData->id ;?>" class="btn btn-danger editbtn " data-toggle="modal" style="background-color: #c53636 !important;"/> <i class="fa fa-trash-o"></i></a>
                            </td>
                            <!-- ------------ delete Modal  Start--------------------- -->
                                        <div id="delete<?php echo $usedData->id ;?>" class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-dialog">
                                            <div class="modal-content">
                                              <?= $this->Form->create('',['class'=>'ServiceForm']) ?>
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> Confirm Header </h4>
                                              </div>
                                              <div class="modal-body">
                                                <h4>
                                                    Are you sure, you want to delete this consumption ?
                                                </h4>
                                                <?php echo $this->Form->hidden('used_data_id',[
                                                  'value'=>$EncryptingDecrypting->encryptData($usedData->id) ]);?>
                                                
                                              </div>
                                              <div class="modal-footer">
                                              <?php echo $this->Form->button('Submit',['class'=>'btn btn-info submit_member','name'=>'used_submit']); ?>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                              </div>
                                                <?= $this->Form->unlockField('id') ;?>
                                              <?= $this->Form->end() ?>
                                            </div>
                                        </div>
                                    </div>      
                                    <!-- ------------ delete Modal  End--------------------- -->
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
            </table>
            </div>
           <!--  <div class="box-footer">
                <?= $this->element('pagination') ?> 
            </div> -->
        </div>
    </div>
</div>
<?= $this->element('datepicker') ?> 
<?= $this->element('selectpicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){
       $(document).on('keyup','.qty',function(){
            var current_stock1 = $('select.material_id option:selected').val();
            if(current_stock1==''){
                alert('Please Select Material');
                $('.qty').val('');
            }
            else{
                    var current_stock = parseInt($('select.material_id option:selected').attr('current_stock'));
                    var qty = parseInt($('.qty').val()); 
                    if(qty>current_stock){
                        alert('Quantity Exceed');
                        $('input.qty').val('');
                    }else{

                    }
            }
 
        }); 
  $('#ServiceForm').validate({ 
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });
     $('.ServiceForm').validate({ 
        submitHandler: function () {
            $('#loading').show();
            $('.submit_member').attr('disabled','disabled');
            form.submit();
        }
    });

});
    ";
$this->Html->scriptBlock($js,['block'=>'block_js']);
 ?>