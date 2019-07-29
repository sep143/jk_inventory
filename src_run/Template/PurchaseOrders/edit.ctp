
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Edit Purchase Order</label>
            </div><hr>
            <div class="box-body">
                <div class="form-group">
                    <?= $this->Form->create($purchaseOrder,['id'=>'ServiceForm']) ?>
                        <div class="row">
                                <div class="col-md-4">
                                    <label class="control-label"> Date <span class="required" aria-required="true"> * </span></label>
                                     <?= $this->Form->control('transaction_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','value'=>date('d-M-Y')])?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Delivery Date <span class="required" aria-required="true"> * </span></label>
                                     <?= $this->Form->control('delivery_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy'])?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Vendor <span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('vendor_id',['options' => $vendors,
                                    'label' => false,'class'=>'select2','empty'=>'Select Vendor','    style'=>'width:300px;']);?>
                                </div>
                            </div>
                            <span class="help-block"></span><br></br>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table" width="100%" id="main_table1">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th> Material</th>
                                                <th> Quantity</th>
                                                <th> Rate</th>
                                                <th> Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody > 
                                        <?php  $j=0; $i=1; 
                                        foreach ($purchaseOrder->purchase_order_rows as $reqslip): ?>
                                            <tr class="main_tr1" >
                                                <td><?php echo $i; ?></td>  
                                               <td>
                                                <?php echo $this->Form->hidden('purchase_order_rows.'.$j.'.requisition_slip_id',['value'=>$reqslip->requisition_slip_id]);  ?>

                                                 <?php echo $this->Form->hidden('purchase_order_rows.'.$j.'.received_qty',['value'=>$reqslip->received_qty]);  ?>

                                                <?php echo $this->Form->hidden('purchase_order_rows.'.$j.'.requisition_slip_row_id',['value'=>$reqslip->requisition_slip_row_id]);  ?>

                                                    <?php echo $this->Form->hidden('purchase_order_rows.'.$j.'.row_material_id',['value'=>$reqslip->row_material_id]);  ?>
                                                    <label>
                                                        <?php echo @$reqslip->row_material->name; ?>
                                                    </label>
                                                    
                                                </td>
                                                <td>
                                                    <?php echo $this->Form->control('purchase_order_rows.'.$j.'.quantity',[
                                                    'label' => false,'class'=>'form-control qty','placeholder'=>'Enter quantity','type'=>'text','value'=>$reqslip->sum,'readonly']);?>
                                                </td>
                                                <td>
                                                    <?php echo $this->Form->control('purchase_order_rows.'.$j.'.rate',[
                                                    'label' => false,'class'=>'form-control rate','placeholder'=>'Enter rate','type'=>'text']);?>
                                                </td>
                                                 <td>
                                                    <?php echo $this->Form->control('purchase_order_rows.'.$j.'.amount',[
                                                    'label' => false,'class'=>'form-control amount','placeholder'=>'Total amount','type'=>'text','readonly']);?>
                                                </td>
                                            </tr>
                                             <?php //echo $this->Form->hidden('requisition_slip_id[]',['value'=>$reqslip->requisition_slip_id]);  ?>

                                            <?php $i++; $j++; endforeach; ?>

                                           
                                        </tbody>
                                        <tfoot >
                                            <tr>
                                                <td colspan="4"></td>
                                                <td>
                                                     <?php echo $this->Form->control('total',[
                                                    'label' => false,'class'=>'form-control grand_total','placeholder'=>'Grand total','type'=>'text','readonly']);?>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div><br></br>
                            <div class="row">
                                <div class="col-md-4 ">
                                     <label class="control-label"> Discount Percentage <span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('discount_per',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter Discount %','type'=>'text']);?>
                                </div><div class="col-md-4 ">
                                     <label class="control-label"> P/F Charges<span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('packing_forwarding_charges',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter P/F Charges','type'=>'text']);?>
                                </div><div class="col-md-4 ">
                                     <label class="control-label"> GST Percentage <span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('gst_charges',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter GST %','type'=>'text']);?>
                                </div>
                            </div>
                            <span class="help-block"></span>
                            <div class="row">
                                <div class="col-md-4 ">
                                     <label class="control-label"> Delivery Location <span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('delivery_location',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter Delivery Location','type'=>'text']);?>
                                </div>
                                <div class="col-md-4 ">
                                     <label class="control-label"> Payment Terms<span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('payment_terms',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter Payment Terms','type'=>'text']);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Status <span class="required" aria-required="true"> * </span></label>
                                     <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
                                </div>
                               
                            </div>
                    </div>
                </div>
            <div class="box-footer">
                        <div class="row">
                            <center>
                                <div class="col-md-12">
                                    <div class="col-md-offset-3 col-md-6">  
                                        <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member']); ?>
                                    </div>
                                </div>
                            </center>       
                        </div>
                    </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?= $this->element('datepicker') ?> 
<?= $this->element('selectpicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){
     

    $(document).on('keyup','.qty,.rate',function(){
            calculate();
    });

    function calculate(){
        var qty=0;
        var rate=0;
        var amount=0;
        var grand_total=0;
        var total_amount=0;
        $('#main_table1 tbody tr.main_tr1').each(function()
        {
            qty=$(this).find('td:nth-child(3) input.qty').val();
            rate=$(this).find('td:nth-child(4) input.rate').val();
            amount=qty*rate;
            $(this).find('td:nth-child(5) input.amount').val(amount)
            total_amount+=parseFloat($(this).find('td:nth-child(5) input.amount').val());
            
        });
        $('.grand_total').val(total_amount);

    }
    function rename_rows(){
        var j=0;
        var p=0;    
        var i=0;
        $('#main_table1 tbody tr.main_tr1').each(function()
        { 
            $(this).find('td:nth-child(1)').html(++p);
             $(this).find('td:nth-child(2) select.selectadd').attr({name:'purchase_order_rows['+i+'][row_material_id]'});
             $(this).find('td:nth-child(2) select.selectadd').select2();
              $(this).find('td:nth-child(3) input').attr({name:'purchase_order_rows['+i+'][quantity]'});
              $(this).find('td:nth-child(4) input').attr({name:'purchase_order_rows['+i+'][rate]'});
              $(this).find('td:nth-child(5) input').attr({name:'purchase_order_rows['+i+'][amount]'});
            i++;
         });
     }


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

