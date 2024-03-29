
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> GRN Reports</label>
               <!--  <div class="box-tools pull-right">
                    <div style="font-size:19px;  margin-top: -6px;" class="btn btn-box-tool" data-target="#myModal122" data-toggle="collapse"> <i class="fa fa-filter"></i></div>
                </div> -->
            </div><hr>
            <div class="box-body">
                <div  class="row">
                        <div class="col-md-12">
                             <?= $this->Form->create($po_data,['autocomplete'=>'off','type'=>'get']) ?>
                                 <div class="row">
                                    <div class="col-sm-3">
                                        <label class="control-label"> Date From </label>
                                        <?= $this->Form->control('data[transaction_date >=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>@$_GET['data']['in_date >=']])?>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="control-label"> Date To </label>
                                        <?= $this->Form->control('data[transaction_date <=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>@$_GET['data']['in_date <=']])?>
                                    </div>
                                    <div class="col-sm-1">
                                         <?= $this->Form->submit('SEARCH',['class'=>'btn btn-info btnClass','style'=>'margin-top:28px;'])?>
                                    </div>
                                    <div class="col-md-1">
                                        <?= $this->Html->link(__('RESET'), ['action' => 'report'],['class'=>'btn btn-danger btnClass','escape'=>false, 'data-widget'=>'Reset', 'data-toggle'=>'tooltip', 'data-original-title'=>'Reset','style'=>'margin-top:28px;']) ?>
                                    </div>
                                </div>
                               <!--  <div class="row">
                                    <div class="col-md-12 text-center">
                                    </div>
                                </div> -->
                                <?= $this->Form->end(); ?>
                            </div>
                    </div><br></br>
                <?php if($data_exist=='data_exist') { ?>  
                <div class="row">
                    <div class="col-md-4 col-md-offset-8 text-right">
                        <table class="pull-right">
                            <tr>
                                <td>
                                    <?= $this->Form->create($po_data,['autocomplete'=>'off','url'=>['action'=>'reportExport']]) ?>
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
                   <?php $page_no=$this->Paginator->current('GoodReceiveNotes'); $page_no=($page_no-1)*20; ?>
                    <table cellpadding="0" cellspacing="0" class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= ('Sr.No') ?></th>
                                <th scope="col"><?= ('Date') ?></th>
                                <th scope="col"><?= ('GRN No') ?></th>
                                <th scope="col"><?= ('Bill/ Challan No') ?></th>
                                <th scope="col"><?= ('Purchase Order No') ?></th>
                                <th scope="col"><?= ('Through') ?></th>
                                <th scope="col" >Supplier's Name </th>
                                <th scope="col"><?= ('Received By') ?></th>
                                <th scope="col"><?= ('Inspection Remarks') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($goodReceiveNotes as $goodReceiveNote): ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?= h($goodReceiveNote->transaction_date) ?></td>
                                <td><?= h('GRN-'.$goodReceiveNote->id) ?></td>
                                <td><?= h($goodReceiveNote->bill_no) ?></td>
                                <td>
                                    <a href="<?= $this->Url->build(['controller'=>'PurchaseOrders','action' =>'View', $EncryptingDecrypting->encryptData($goodReceiveNote->purchase_order->id)])?>"> <?= 'PO-'.h($goodReceiveNote->purchase_order->voucher_no) ?></a>

                                   </td>
                                 <td><?= h($goodReceiveNote->transport) ?></td>
                                 <td><?= h($goodReceiveNote->purchase_order->vendor->name) ?></td>
                                <td><?= h($goodReceiveNote->creater->name) ?></td>
                                <td><?= h($goodReceiveNote->inspection_remark) ?></td>
                                <td class="actions">
                                        <a href="#myModal<?php echo $goodReceiveNote->id ;?>" class="btn btn-danger btnView" data-toggle="modal" /><i class="fa fa-eye"></i> </a>
                                      
                                        <div id="myModal<?php echo $goodReceiveNote->id;?>" class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> GRN Details </h4>
                                              </div>
                                              <div class="modal-body" id="printModel<?php echo $goodReceiveNote->id ;?>">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table cellpadding="0" cellspacing="0" class="table">
                                                        <thead>
                                                        <?php
                                                        echo '<tr style="font-size:14px; border:solid black;"><td colspan="5" align="center" style="text-align:center;">'.$companies->name .'<br/>' .$companies->address .',<br/>'. $companies->state->name .'</span><br/>
                                                        <span> <i class="fa fa-phone" aria-hidden="true"></i>'.  $companies->phone_no . ' | Mobile : '. $companies->mobile .'<br/> GSTIN NO:'.
                                                        $companies->gstin .'</span></td></tr>';
                                                        ?>
                                                        <tr>
                                                            <td colspan="2">Voucher No. - <?= h('GRN-'.$goodReceiveNote->id) ?></td>
                                                            <td colspan="3" style="text-align: right;">Transaction Date - <?= h($goodReceiveNote->transaction_date) ?></td>
                                                        <tr>
                                                            <tr>
                                                                <th scope="col"><?= ('Sr.No') ?></th>
                                                                <th scope="col"><?= ('Material') ?></th>
                                                                <th scope="col"><?= ('Quantity') ?></th>
                                                                <th scope="col"><?= ('Rate') ?></th>
                                                                <th scope="col"><?= ('Amount') ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $j=1; foreach ($goodReceiveNote->good_receive_note_rows as $goodR_receive_rows){ ?>
                                                            <tr>
                                                                <td style="width:10%;"><?php echo  $j; ?></td>
                                                                <td style="width:40%;"><?php echo $goodR_receive_rows->row_material->name ;?></td>
                                                                <td style="width:20%;"><?php echo $goodR_receive_rows->quantity.' '.$goodR_receive_rows->row_material->unit->name ;?></td>
                                                                <td style="width:15%;"><?php echo $goodR_receive_rows->rate ;?></td>
                                                                <td style="width:15%;"><?php echo $goodR_receive_rows->amount ;?></td>
                                                            </tr>
                                                             <?php $j++; } ?>
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                </div>
                                                 
                                              </div>
                                              <div class="modal-footer">
                                              <button type="button" class="btn btn-info" onclick="printDiv('printModel<?php echo $goodReceiveNote->id ;?>')" >Print</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                              </div>
                                            </div>
                                        </div>
                                    </div> 
                                </td>
                            </tr>
                            <?php $i++;endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
          <div class="box-footer">
                <?php echo $this->element('pagination') ?> 
            </div>
        </div>
        <?php } else { ?>
             <div class="row">
                <div class="col-md-12 text-center">
                    <h3> <?= $data_exist ?></h3>
                </div>
            </div>
        <?php } ?>
</div>


<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
     document.location.reload();
}
</script>
<?= $this->element('selectpicker') ?> 
<?= $this->element('datepicker') ?>