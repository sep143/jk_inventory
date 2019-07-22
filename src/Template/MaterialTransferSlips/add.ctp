
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Material Transfer Slip</label>
            </div><hr>
            <div class="box-body">
                <div class="form-group">
                    <?= $this->Form->create($materialTransferSlip,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Date <span class="required" aria-required="true"> * </span></label>
                                 <?= $this->Form->control('transaction_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','value'=>Date('d-M-Y')])?>
                            </div>
                             <div class="col-md-4">
                                <label class="control-label"> Transfer To </label><br>
                                <?php echo $this->Form->control('employee_id',['label' => false,'class'=>'form-control ','type'=>'text','style'=>'width:100%','readonly','value'=>@$materialTransfers->employee->name]);?>

                                <?php echo $this->Form->hidden('employee_id',['value'=>@$materialTransfers->employee_id]); ?>
                                <?php echo $this->Form->hidden('created_by',['value'=>@$materialTransfers->created_by]); ?>
                                
                            </div>
                        </div>
                        <span class="help-block"></span>
                        <div class="row">
                                <div class="col-md-12">
                                    <table class="table" width="100%" id="main_table1">
                                        <thead>
                                            <tr>
                                                <th> Sr. No.</th>
                                                <th> Material</th>
                                                <th> Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody id="main_tbody1"> 
                                        <?php 
                                        //pr($materialTransfers);
                                        $i=1; $j=0;
                                        foreach($materialTransfers->request_slip_rows as $materialTransferData)
                                        { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>  
                                            <td>
                                                 <?php echo $this->Form->hidden('material_transfer_slip_rows.'.$j.'.row_material_id',['value'=>@$materialTransferData->row_material_id]); ?>
                                                <label>
                                                    <?php echo @$materialTransferData->row_material->name; ?>
                                                </label>
                                            </td>
                                            <td>
                                                 <?php echo $this->Form->control('material_transfer_slip_rows.'.$j.'.quantity',[
                                                    'label' => false,'class'=>'form-control amount','placeholder'=>'Quantity','type'=>'text','style'=>'width:100%','readonly','value'=>@$materialTransferData->quantity]);?>
                                            </td>
                                        </tr>
                                        <?php $i++; $j++; } ?> 
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

<?= $this->element('selectpicker') ?> 
<?= $this->element('datepicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){
     
     $(document).on('keyup','.qty',function(){
            var current_stock1 = $(this).closest('tr').find('select.material_id option:selected').val();
            if(current_stock1==''){
                alert('Please Select Material');
                $(this).closest('tr').find('td input.qty').val('');
            }
            else{
                    var current_stock = parseInt($(this).closest('tr').find('select.material_id option:selected').attr('current_stock'));
                    var qty = parseInt($(this).closest('tr').find('td input.qty').val()); 
                    if(qty>current_stock){
                        alert('Quantity Exceed');
                        $(this).closest('tr').find('td input.qty').val('');
                    }else{

                    }
            }
 
        });  

  $('#ServiceForm').validate({ 
        rules: {
            transaction_date: {
                required: true
            },
            employee_id: {
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

