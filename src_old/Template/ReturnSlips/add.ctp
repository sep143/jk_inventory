<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Create Return Slip</label>
                <div class="pull-right"> 
                    <div class="col-md-1">
                            <?= $this->Html->link(__('Back'), ['action' => 'ReturnSearchEmp'],['class'=>'btn btn-danger btnClass','escape'=>false, 'data-widget'=>'Go to search', 'data-toggle'=>'tooltip', 'data-original-title'=>'Go to search','style'=>'margin-top:0px;color:#fff;']) ?>
                    </div>
                </div>
            </div><hr>
            <div class="box-body">
                <div class="form-group">
                    <?= $this->Form->create($returnSlip,['id'=>'ServiceForm']) ?>
                         <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Date <span class="required" aria-required="true"> * </span></label>
                                 <?= $this->Form->control('transaction_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','value'=>date('d-M-Y')])?>
                            </div>

                        </div>
                        <span class="help-block"></span>
                      

                         <?php echo $this->Form->hidden('employee_id',['value'=>$employee_id]);  ?>

                        <div class="row">
                                <div class="col-md-12">
                                    <table class="table" width="100%" id="main_table1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> Row Material</th>
                                                <th> Balance</th>
                                                <th> Quantity</th>
                                                <th> Status</th>
                                                <th> Particulars</th>
                                            </tr>
                                        </thead>
                                        <tbody id=""> 
                                            <?php $j=0; $i=1;foreach($query as $qdata) {

                                            if($qdata->total_in >  $qdata->total_out)
                                              {  
                                             ?>
                                            <tr>
                                                <td><?= $i; ?></td>  
                                                <td>
                                                     <?php echo $this->Form->hidden('return_slip_rows.'.$j.'.row_material_id',['value'=>$qdata->row_material_id]);  ?>

                                                    <label> <?= $qdata->row_material->name?></label>
                                                </td>
                                                <td>
                                                    <label class="balance"> 
                                                        <?= $qdata->total_in-$qdata->total_out ?>
                                                    </label>
                                                </td>
                                                <td>
                                                    <?php echo $this->Form->control('return_slip_rows.'.$j.'.quantity',[
                                                    'label' => false,'class'=>'form-control qty','placeholder'=>'Enter quantity','type'=>'text','required']);?>
                                                </td>
                                                <td>
                                                    <?php echo $this->Form->control('return_slip_rows.'.$j.'.return_scrab',['options' => $returnaction,
                                                    'label' => false,'class'=>'select2','empty'=>'Select Status','style'=>'width:200px;','required']);?>
                                                </td>
                                                <td>
                                                    <?php echo $this->Form->control('return_slip_rows.'.$j.'.description',[
                                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter Particulars','type'=>'textarea','rows'=>'3','style'=>'resize:none;']);?>
                                                </td>
                                            </tr>
                                        <?php $i++; $j++;} } ?>
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
            var current_stock = $(this).closest('tr').find('td label.balance').html();
            var qty = parseInt($(this).closest('tr').find('td input.qty').val()); 
            if(qty>current_stock){
                alert('Quantity Exceed');
                $(this).closest('tr').find('td input.qty').val('');
            }
            else{

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

