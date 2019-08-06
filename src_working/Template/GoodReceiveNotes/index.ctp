
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> GRN Details</label>
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
                                        <?= $this->Html->link(__('RESET'), ['action' => 'index'],['class'=>'btn btn-danger btnClass','escape'=>false, 'data-widget'=>'Reset', 'data-toggle'=>'tooltip', 'data-original-title'=>'Reset','style'=>'margin-top:28px;']) ?>
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
                <div class="form-group">
                   <?php $page_no=$this->Paginator->current('GoodReceiveNotes'); $page_no=($page_no-1)*20; ?>
                    <table cellpadding="0" cellspacing="0" class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= ('Sr.No') ?></th>
                                <th scope="col"><?= ('Voucher No') ?></th>
                                <th scope="col"><?= ('Purchase Order No') ?></th>
                                <th scope="col"><?= ('Transaction Date') ?></th>
                                <th scope="col"><?= ('Received By') ?></th>
                                <th scope="col"><?= ('Inspection By') ?></th>
                                <th scope="col"><?= ('Inspection Remarks') ?></th>
                                <th style="width: 20%" scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($goodReceiveNotes as $goodReceiveNote): ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?= 'GRN-'.h($goodReceiveNote->voucher_no) ?></td>
                                <td>
                                    <a href="<?= $this->Url->build(['controller'=>'PurchaseOrders','action' =>'View', $EncryptingDecrypting->encryptData($goodReceiveNote->purchase_order_id)])?>"> <?= 'PO-'.h($goodReceiveNote->purchase_order->voucher_no) ?></a>

                                   </td>
                                <td><?= h($goodReceiveNote->transaction_date) ?></td>
                                <td><?= h($goodReceiveNote->creater->name) ?></td>
                                <td><?= h($goodReceiveNote->inspector->name) ?></td>
                                <td><?= h($goodReceiveNote->inspection_remark) ?></td>
                                <td class="actions">

                                    <a href="#myModal<?php echo $goodReceiveNote->id ;?>" class="btn btn-danger editbtn" data-toggle="modal" /><i class="fa fa-eye"></i> </a>

                                    <!-- <?= $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $EncryptingDecrypting->encryptData($goodReceiveNote->id)],['class'=>'btn btn-info editbtn','escape'=>false, 'data-widget'=>'Edit GRN', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit GRN']) ?> -->

                                      &nbsp;
                                    <a href="#delete<?php echo $goodReceiveNote->id ;?>" class="btn btn-info btnView " data-toggle="modal" /><i class="fa fa-trash"></i> </a> 



                                    <div id="delete<?php echo $goodReceiveNote->id ;?>" class="modal fade" role="dialog">
                                    <?php echo $this->Form->create('', [
                                            'url' => ['controller' => 'GoodReceiveNotes', 'action' => 'delete',$EncryptingDecrypting->encryptData($goodReceiveNote->id)]
                                        ]); ?>
                                          <div class="modal-dialog modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> Confirm Header </h4>
                                              </div>
                                              <div class="modal-body">
                                                    <h4> Are you sure, you want to delete this GRN slip ? </h4>
                                              </div>
                                              <div class="modal-footer">
                                                <?php echo $this->Form->button('Submit',['class'=>'btn btn-info submit_member']); ?>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                              </div>
                                            </div>
                                        </div>
                                         <?= $this->Form->end(); ?>
                                    </div> 


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
                                                            <td colspan="2">Voucher No. - <?= 'GRN-'.h($goodReceiveNote->voucher_no) ?></td>
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
                                                                <td><?php echo  $j; ?></td>
                                                                <td style="width:40%;"><?php echo $goodR_receive_rows->row_material->name ;?></td>
                                                                <td><?php echo $goodR_receive_rows->quantity.' '.$goodR_receive_rows->row_material->unit->name ;?></td> 
                                                                <td><?php echo $goodR_receive_rows->rate ;?></td> 
                                                                <td><?php echo $goodR_receive_rows->amount ;?></td>
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