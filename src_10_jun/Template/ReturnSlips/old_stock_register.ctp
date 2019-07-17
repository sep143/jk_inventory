
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Main Stock Register Report</label>
            </div><hr>
            <div class="box-body">
                <div  class="row" >
                        <div class="col-md-12">
                             <?= $this->Form->create($stock_register,['autocomplete'=>'off','type'=>'get','id'=>'ServiceForm']) ?>
                                <div class="row">
                                     <div class="col-sm-4">
                                        <label class="control-label"> Row Material</label>
                                        <?php echo $this->Form->control('data[row_material_id]', ['options' =>$rowMaterials, 'empty' =>'Select Material','label'=>false,'class'=>'select2','style'=>'width:100%;','required']);?>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="control-label"> Date From </label>
                                        <?= $this->Form->control('data[transaction_date >=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>@$_GET['data']['transaction_date >=']])?>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="control-label"> Date To </label>
                                        <?= $this->Form->control('data[transaction_date <=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>@$_GET['data']['transaction_date <=']])?>
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
                <div class="form-group">
                   <?php $page_no=$this->Paginator->current('ReturnSlips'); $page_no=($page_no-1)*20; ?>
                    <table cellpadding="0" cellspacing="0" class="table">
                        <thead>
                            <tr>
                                <th colspan="4"></th>
                                <th scope="col" style="text-align: center !important;"><?= ('RECEIPT') ?></th>
                                <th scope="col" style="text-align: center !important;"> ISSUE</th>
                                <th scope="col" style="text-align: center !important;"> BALANCE</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th scope="col"><?= ('Sr.No') ?></th>
                                <th scope="col"><?= ('Date') ?></th>
                                <th scope="col"><?= ('Item Name') ?></th>
                                <th scope="col"><?= ('PARTICULARS') ?></th>
                                
                                <th>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> Qty</th>
                                                <th> Rate</th>
                                                <th> Amount</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </th>
                                <th>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> Qty</th>
                                                <th> Rate</th>
                                                <th> Amount</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </th>
                                <th>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> Qty</th>
                                                <th> Rate</th>
                                                <th> Amount</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; $total_in=0; $total_out=0; $total_available=0;
                            foreach ($StockDatas as $stockdata):?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?= h($stockdata->transaction_date) ?></td>
                                <td><?= h($stockdata->row_material->name . $stockdata->id) ?></td>
                                <td><?= h($stockdata->particulars) ?></td>
                                <td>
                                    <table class="table">
                                        <thead >
                                            <?php if(($stockdata->good_receive_note_id !='') && ($stockdata->status=='In')) { ?>
                                            <tr >
                                                <th style="background-color: #fff !important;color: #000 !important;">
                                                    <?php $total_in=$total_in+$stockdata->quantity; ?>
                                                    <?= h($stockdata->quantity) ?></th>
                                                <th style="background-color: #fff !important;color: #000 !important;"> 100</th>
                                                <th style="background-color: #fff !important;color: #000 !important;"> 1000</th>
                                            </tr>
                                        <?php } ?>
                                        </thead>
                                    </table>
                                </td>
                                <td>
                                    <table class="table">
                                        <thead >
                                            <?php if(($stockdata->issue_slip_id !='') && ($stockdata->status=='Out')) { ?>
                                            <tr >
                                                <th style="background-color: #fff !important;color: #000 !important;">
                                                    <?php $total_out=$total_out+$stockdata->quantity; ?>
                                                    <?= h($stockdata->quantity) ?></th>
                                                <th style="background-color: #fff !important;color: #000 !important;"> 100</th>
                                                <th style="background-color: #fff !important;color: #000 !important;"> 1000</th>
                                            </tr>
                                        <?php } ?>
                                        </thead>
                                    </table>
                                </td>
                                <td>
                                     <table class="table">
                                        <thead >
                                            <tr >
                                                <th style="background-color: #fff !important;color: #000 !important;">
                                                    <?php $total_available=$total_in - $total_out; ?>
                                                    <?= h($total_available) ?></th>
                                                <th style="background-color: #fff !important;color: #000 !important;"> 100</th>
                                                <th style="background-color: #fff !important;color: #000 !important;"> 1000</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </td>
                            </tr>
                            <?php  $i++;  endforeach; ?>
                            <tr>
                                <th colspan="3"></th>
                                <th > Total</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--  <div class="box-footer">
                <?= $this->element('pagination') ?> 
            </div>  -->
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

