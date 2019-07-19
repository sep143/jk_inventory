
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Main Stock Register Report</label>
            </div><hr>
            <div class="box-body">
                    <div  class="row" >
                        <div class="col-md-12">
                             <?= $this->Form->create($stock_register,['autocomplete'=>'off','id'=>'ServiceForm']) ?>
                                <div class="row">
                                     <div class="col-sm-4">
                                        <label class="control-label"> Row Material</label>
                                        <?php echo $this->Form->control('data[row_material_id]', ['options' =>$rowMaterials, 'empty' =>'Select Material','label'=>false,'class'=>'select2','style'=>'width:100%;','required']);?>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="control-label"> Date From </label>
                                        <?= $this->Form->control('data[transaction_date >=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>@$_POST['data']['transaction_date >=']])?>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="control-label"> Date To </label>
                                        <?= $this->Form->control('data[transaction_date <=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>@$_POST['data']['transaction_date <=']])?>
                                    </div>
                                     <div class="col-sm-1 ">
                                       <?= $this->Form->submit('SEARCH',['class'=>'btn btn-info btnClass','style'=>'margin-top:28px;','id'=>'submit_member'])?>
                                    </div>
                                    <div class="col-md-1">
                                        <?= $this->Html->link(__('RESET'), ['action' => 'stockRegisterReport'],['class'=>'btn btn-danger btnClass','escape'=>false, 'data-widget'=>'Reset', 'data-toggle'=>'tooltip', 'data-original-title'=>'Reset','style'=>'margin-top:28px;']) ?>
                                    </div>
                                </div>
                                <?= $this->Form->end(); ?>
                            </div>
                    </div><br></br>

                <?php if(@$data_exist=='data_exist') { ?>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-8 text-right">
                            <table class="pull-right">
                                <tr>
                                    <td>
                                        <?= $this->Form->create($stock_register,['autocomplete'=>'off','url'=>['action'=>'mainstockRegisterExport']]) ?>
                                            <?php if (isset($where)): ?>
                                                <?php foreach ($where as $key => $value): ?>
                                                    <?= $this->Form->hidden($key,['value'=>$value]) ?>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                            <?= $this->Form->submit('Export',['class'=>'btn btn-sm btn-info no-print"',])?>
                                        <?= $this->Form->end() ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                <div class="form-group">
                   <?php $page_no=$this->Paginator->current('ReturnSlips'); $page_no=($page_no-1)*20; ?>
                    <table cellpadding="0" cellspacing="0" class="table" border="1">
                        <thead>
                            <tr>
                                <h3> Name Of Article : <b><?php echo  $StockDatas[0]->row_material->name ?> </b></h3>
                            </tr>
                            <tr>
                               <th scope="col" rowspan="2"><?= ('Sr.No') ?></th>
                                <th scope="col" rowspan="2"><?= ('Date') ?></th>
                                <th scope="col" rowspan="2"><?= ('PARTICULARS') ?></th>
                                <th scope="col" colspan="3" ><?= ('RECEIPT QTY') ?></th>
                                <th scope="col" colspan="3"> ISSUE QTY</th>
                                <!-- <th scope="col"><?= ('ISSUE TO') ?></th> -->
                                <th scope="col" colspan="3" > BALANCE QTY</th>
                                <th scope="col" rowspan="2"> THROUGH  </th>
                                <!-- <th scope="col" > DEPARTMENT  </th> -->
                            </tr>
                            <tr>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Amt.</th>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Amt.</th>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Amt.</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <?php $i=1; $total_in=0; $total_out=0; $total_available=0;
                            foreach ($StockDatas as $stockdata):?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?= h($stockdata->transaction_date) ?></td>
                                <td><?= h($stockdata->particulars) ?></td>
                                <td>
                                        <?php if(($stockdata->good_receive_note_id !='' || $stockdata->return_slip_id !='' ) && ($stockdata->status=='In')) { ?>
                                                <?php $total_in=$total_in+$stockdata->quantity; ?>
                                                    <?= h($stockdata->quantity.' '.$stockdata->row_material->unit->name) ?></th>
                                     <?php }else if($stockdata->opening_balence == 'yes'  && $stockdata->status=='In'){
                                         $total_in=$total_in+$stockdata->quantity;
                                     } ?>  
                                </td>
                                <td><?php 
                                        echo $stockdata->rate;
                                ?> </td>
                                <td><?php
                                     if(($stockdata->good_receive_note_id !='' || $stockdata->return_slip_id !='' ) && ($stockdata->status=='In')) {
                                        echo $stockdata->quantity * $stockdata->rate; }?></td>
                                <td>
                                    <?php if(($stockdata->issue_slip_id !='') && ($stockdata->status=='Out')) { ?>
                                    <?php $total_out=$total_out+$stockdata->quantity; ?>
                                     <?= h($stockdata->quantity.' '.$stockdata->row_material->unit->name) ?>
                                    <?php }?>
                                </td>
                               <td><?php  echo $stockdata->rate;
                                ?></td>
                                <td><?php
                                     if(($stockdata->issue_slip_id !='') && ($stockdata->status=='Out')) {
                                        $stockdata->quantity * $stockdata->rate; }?></td>
                                <!-- <td><?= h($issueSlip->employee->name) ?></td> -->
                                <td>
                                    <?php $total_available=$total_in - $total_out; ?>
                                    <?= h($total_available.' '.$stockdata->row_material->unit->name) ?></th>
                                </td>
                                <td><?php 
                                    echo $stockdata->rate;
                                ?></td>
                                <td><?= $total_available*$stockdata->rate ?></td>
                                 <td>
                                    <?php if($stockdata->good_receive_note_id!='0') { 
                                        echo " GRN";
                                    }
                                    else if($stockdata->return_slip_id!='0') {
                                        echo " RETURN ";
                                    }
                                    else if($stockdata->issue_slip_id!='0') {
                                        echo " ISSUE ";
                                    }
                                    ?>
                                </td>
                               <!--  <td>
                                    <?= h($stockdata->department->name)?>
                                </td> -->

                            </tr>
                            <?php  $i++;  endforeach; ?>
                            <tr style="background-color: #efe8e8;">
                                <th colspan="2"></th>
                                <th> <b>Total </b></th>
                               <th colspan="3">
                                 <?php if(!empty($total_out)) { ?>
                                <b><?= $total_in.' '.$stockdata->row_material->unit->name ?></b></th>
                                 <?php }?>
                             </th>
                                <th colspan="3" >
                                <?php if(!empty($total_out)) { ?>
                                 <b><?= $total_out.' '.$stockdata->row_material->unit->name ?></b></th>
                                 <?php }?>
                                <th colspan="3"> 
                                    <?php if(!empty($total_available)) { ?>
                                    <b><?= $total_available.' '.$stockdata->row_material->unit->name ?></b>
                                <?php }?>
                                </th>
                                <th></th>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <?php } else { ?>
             <div class="row">
                <div class="col-md-12 text-center">
                    <h3> <?= @$data_exist ?></h3>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</div>
<?= $this->element('selectpicker') ?> 
<?= $this->element('datepicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){
$('#ServiceForm').validate({ 
        rules: {
            row_material_id: {
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

