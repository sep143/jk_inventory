<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseOrder $purchaseOrder
 */
?>
<style type="text/css">
    .table>tbody>tr>th,.table>tbody>tr>td{
        border: 1px solid #020101 !important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="heading" >
                <div class="row">
                    <div class="col-md-12">
                         <div class="col-md-2">

                        </div>
                        <div class="col-md-8">
                             <?= $this->Html->image('JKIT-logo1.png',['style'=>'margin:20px;width:100%;'])?> 

                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                </div>
            </div>
            <hr></hr>
            <div class="row" style="padding-left: 20px;">
                <div class="col-md-12">
                    <div class="col-md-6" style="float: left;width: 33%;">
                        <?= __('Ref') ?> :
                        <label> JKIT/ 09/OFF/</label>
                    </div>
                    <div class="col-md-6" style="float: right;width: 33%;">
                        <?= __('DATE') ?> :
                        <label> <?= h($purchaseOrder->transaction_date) ?></label>
                    </div>
                </div>
            </div>
             <div class="row" style="padding-left: 20px;">
                <div class="col-md-12">
                    <div class="col-md-4" >
                            <label> <?= h($purchaseOrder->vendor->name) ?><br>
                             <?= h($purchaseOrder->vendor->address) ?></label>
                    </div>
                </div>
            </div>
             <div class="row" style="padding-left: 32px;font-size: 15px !important;">
                <div class="col-md-12" >
                    <label><u>Subject : </u></label>  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;  <label><u>Purchase Order </u></label>
                </div>
            </div>
             <div class="row" style="padding-left: 32px;">
                <div class="col-md-12" >
                    <label>Dear Sir, <br></br>
                        With Reference to our discussions with you, we are pleased to place an order as follow:
                    </label>
                </div>
            </div>
            <div class="row" style="padding-left: 32px;">
                <div class="col-md-12" >
                    <?php if (!empty($purchaseOrder->purchase_order_rows)): ?>
                    <table class="table" cellpadding="0" cellspacing="0">
                        <tr>
                            <th scope="col" style="font-size: 16px !important;"><b><?= __('S. No.') ?></b></th>
                            <th scope="col" style="font-size: 16px !important;"><b><?= __('Name of the Books') ?></b></th>
                            <th scope="col" style="font-size: 16px !important;"><b><?= __('Quantity') ?></b></th>
                            <th scope="col" style="font-size: 16px !important;"><b><?= __('Rate') ?></b></th>
                            <th scope="col" style="font-size: 16px !important;"><b><?= __('Amount') ?> (In Rs.) </b></th>
                        </tr>
                        <?php $total=0;$i=1;foreach ($purchaseOrder->purchase_order_rows as $purchaseOrderRows): ?>
                        <tr>
                            <td><?= h($i) ?></td>
                            <td><?php echo $purchaseOrderRows->row_material->name; ?></td>
                            <td><?php echo $purchaseOrderRows->quantity.' '.$purchaseOrderRows->row_material->unit->name; ?></td>
                            <td><?= h($purchaseOrderRows->rate) ?></td>
                            <td><?= h($purchaseOrderRows->amount) ?></td>
                        </tr>
                        <?php $total=$total+$purchaseOrderRows->amount; $i++;endforeach; ?>

                         <tr>
                            <th colspan="4" style="text-align: right"><b> Total Rs. </b></th>
                            <th><b><?= h($total) ?> </b></th>
                        </tr>
                </table>

                <?php endif; ?>
                </div>
            </div>
            <div class="row" style="padding-left: 32px;">
                <div class="col-md-12">
                    Terms & Conditions :<br>

                    <table class="table" style="width: 30%;">
                        
                            <tr>
                                <th style="border:0px !important;">1. </th>
                                <th style="border:0px !important;">Taxes </th>
                                <th style="border:0px !important;">- </th>
                                <th style="border:0px !important;">Extra</th>
                            </tr>
                             <tr>
                                <th style="border:0px !important;">2. </th>
                                <th style="border:0px !important;">FOR </th>
                                <th style="border:0px !important;">- </th>
                                <th style="border:0px !important;">J.K.I.T. Nimbahera</th>
                            </tr>
                             <tr>
                                <th style="border:0px !important;">3. </th>
                                <th style="border:0px !important;">Delivery </th>
                                <th style="border:0px !important;">- </th>
                                <th style="border:0px !important;">Within 07 Days</th>
                            </tr>
                             <tr>
                                <th style="border:0px !important;">4. </th>
                                <th style="border:0px !important;">Payment </th>
                                <th style="border:0px !important;">- </th>
                                <th style="border:0px !important;">Within 15 Days After Delivery</th>
                            </tr>
                        
                    </table>
                    

                </div>
                <div class="col-md-12">
                   <br></br> Thanking You<br></br>
                    For J.K. Institute Of Technology, <br></br><br></br><br></br>

                    Authorised Signatory
                </div>
                
            </div> 
            
            </div>
        </div>
    </div>

