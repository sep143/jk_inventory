
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Create GRN against PO No : <?= $goodReceiveNote->voucher_no ?></label>
            </div><hr>
            <div class="box-body">
                <div class="form-group">
                    <?= $this->Form->create($goodReceiveNote,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                    <label class="control-label"> Vendor Name : </label><br>
                                    <label> <?php  echo $goodReceiveNote->purchase_order->vendor->name ;?></label>
                                </div> 
                                <div class="col-md-4">
                                    <label class="control-label"> Date :</label>
                                     <?= $this->Form->control('transaction_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','value'=>date('d-M-Y')])?>
                                </div>
                            <div class="col-md-4">
                                    <label class="control-label"> Bill No :</label>
                                     <?php echo $this->Form->control('bill_no',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter Bill/Challan No','type'=>'text']);?>
                                </div>
                            </div>
                            <span class="help-block"></span>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="control-label"> Transport :</label>
                                     <?php echo $this->Form->control('transport',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter Transport','type'=>'text']);?>
                                </div> 
                                 <div class="col-md-4">
                                    <label class="control-label"> Inspection By<span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('inspection_by',['options' => $inspectors,
                                    'label' => false,'class'=>' select2','empty'=>'Select Inspectors','style'=>'width:300px;','required']);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Inspection Remark :</label>
                                     <?php echo $this->Form->control('inspection_remark',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter Remark','type'=>'textarea','rows'=>'2']);?>
                                </div>
                            </div>
                             <span class="help-block"></span><br></br>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table" width="100%" id="main_table1">
                                        <thead>
                                            <tr>
                                                <th> Sr.No</th>
                                                <th> Material</th>
                                                <th> Ordered in PO </th>
                                                <th> Rate In PO</th>
                                                <th> Received Qty </th>
                                                <th> Pending Qty </th>
                                                <th> Receiving Qty </th>
                                                <th> Amount </th>
                                            </tr>
                                        </thead>
                                        <tbody id="main_tbody1"> 
                                    <?php  //foreach($goodReceiveNote->purchase_order->purchase_order_rows as $po_row) {

                                        $i=1; $j=0; foreach ($goodReceiveNote->good_receive_note_rows as $good_receive_note_row) {
                                             ?>
                                            <tr id="main_tr1">
                                                <td><?php echo $i ; ?></td>  
                                                <td>
                                                    <?php echo $this->Form->hidden('good_receive_note_rows.'.$j.'.row_material_id',['value'=>@$good_receive_note_row->row_material_id]); ?>

                                                    <?php echo $this->Form->hidden('good_receive_note_rows.'.$j.'.grn_row_id',['value'=>@$good_receive_note_row->id]);  ?>

                                                    <?php echo $this->Form->hidden('good_receive_note_rows.'.$j.'.purchase_order_row_id',['value'=>@$good_receive_note_row->purchase_order_row_id]);  ?>

                                                    <label>
                                                        <?php echo @$good_receive_note_row->purchase_order_row->row_material->name; ?>
                                                    </label>
                                                    
                                                </td>
                                                <td>
                                                    <label><?= h($good_receive_note_row->purchase_order_row->quantity) ?></label>
                                                </td>
                                                <td>
                                                    <?php echo $this->Form->hidden('good_receive_note_rows.'.$j.'.rate',['value'=>$good_receive_note_row->rate,'class'=>'rate']);  ?> &#8377;
                                                <label><?= $good_receive_note_row->rate ?></label>
                                                </td>

                                                 <td>
                                                    <?php echo $this->Form->hidden('good_receive_note_rows.'.$j.'.po_received_qty',['value'=>@$good_receive_note_row->purchase_order_row->received_qty]);  ?>

                                                    <label><?= h($good_receive_note_row->purchase_order_row->received_qty) ?></label>
                                                </td>
                                                <td>
                                                    <label class="pending_qty"> <?= @$good_receive_note_row->purchase_order_row->quantity-@$good_receive_note_row->purchase_order_row->received_qty ?></label>
                                                </td>
                                                <td>
                                                <?php echo $this->Form->control('good_receive_note_rows.'.$j.'.quantity',[
                                                    'label' => false,'class'=>'form-control  qty','placeholder'=>'Enter quantity','type'=>'text','style'=>'width:50%']);?>

                                                     <?php echo $this->Form->hidden('good_receive_note_rows.'.$j.'.old_grn_row_qty',['value'=>@$good_receive_note_row->quantity]);  ?>
                                                </td>
                                                <td>
                                                    <?php echo $this->Form->control('good_receive_note_rows.'.$j.'.amount',[
                                                    'label' => false,'class'=>'form-control amount','placeholder'=>'Total Amount','type'=>'text','style'=>'width:100%','readonly']);?>
                                                </td>
                                            </tr>
                                          <?=  $this->Form->unlockField('row_material_id');?>
                                        <?php $i++; $j++; } //} ?>
                                        </tbody>
                                    </table>
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
    $(document).on('keyup','.qty',function(){
        var pending_qty = parseInt($(this).closest('tr').find('td label.pending_qty').html());
        var current = parseInt($(this).val());
        var rate = parseInt($(this).closest('tr').find('td input.rate').val());
        if(isNaN(current)){ current = 0;}
        if(current != 0) {
            if(current <= pending_qty){
                 var amount=rate*current;
                 $(this).closest('tr').find('td input.amount').val(amount);
            }
            else{
                alert('Invalid Quantity');
                $(this).val('');
            }
        }

    });
});
    ";
     $this->Html->scriptBlock($js,['block'=>'block_js']);
 ?>



