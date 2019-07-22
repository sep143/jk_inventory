<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Material Transfer Slip</label>
            </div><hr>
            <div class="box-body">
                <div class="form-group">
                    <?= $this->Form->create($returnSlip,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Date <span class="required" aria-required="true"> * </span></label>
                                 <?= $this->Form->control('transaction_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy'])?>
                            </div>
                             <div class="col-md-4">
                                <label class="control-label"> Return By <span class="required" aria-required="true"> * </span></label>
                                 <?php echo $this->Form->control('employee_id',['options' => $employees,
                                    'label' => false,'class'=>' select2','empty'=>'Select Employee','style'=>'width:300px;']);?>
                            </div>
                        </div>
                        <span class="help-block"></span>
                        <div class="row">
                                <div class="col-md-12">
                                    <table class="table" width="100%" id="main_table1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> Row Material</th>
                                                <th> Quantity</th>
                                                <th> Status</th>
                                                <th> Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="main_tbody1"> 
                                            
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

<table id="sample_table1" style="display: none;">
     <tbody>
        <tr class="main_tr1">
            <td>1</td>  
            <td>
                <?php echo $this->Form->control('row_material_id',['options' => $rowMaterials,
                'label' => false,'class'=>'selectadd material_id','empty'=>'Select Material','style'=>'width:300px;']);?>
            </td>
            <td>
                <?php echo $this->Form->control('quantity',[
                'label' => false,'class'=>'form-control qty','placeholder'=>'Enter quantity','type'=>'text']);?>
            </td>
            <td>
                <?php echo $this->Form->control('return_scrab',['options' => $returnaction,
                'label' => false,'class'=>'selectadd returnaction','empty'=>'Select Status','style'=>'width:300px;']);?>
            </td>
            <td>
                <center>
                     <?= $this->Form->button(__('+'),['class'=>'btn btn-md btn-primary addrow','type'=>'button']) ?> 
                      <?= $this->Form->button(__('-'),['class'=>'btn btn-md btn-danger deleterow','type'=>'button']) ?>
                </center>
            </td>    
        </tr>
    </tbody>
</table>
<?= $this->element('selectpicker') ?> 
<?= $this->element('datepicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){
     
    add_row();
    $('body').on('click','.addrow',function(){
        add_row(); rename_rows();
    });
    
    function add_row(){ 
        var tr1=$('#sample_table1 tbody tr').clone();
        $('#main_table1 tbody#main_tbody1').append(tr1);
        rename_rows();
    }
    $('body').on('click','.deleterow',function(){
        var rowCount = $('#main_table1 tbody tr.main_tr1').length;
        if (rowCount>1){
            if (confirm('Are you sure to remove row ?') == true) {
                $(this).closest('tr').remove();
                rename_rows();
            } 
        }
    }); 

     function rename_rows(){
        var j=0;
        var p=0;    
        var i=0;
        $('#main_table1 tbody tr.main_tr1').each(function()
        { 
            $(this).find('td:nth-child(1)').html(++p);
            $(this).find('td:nth-child(2) select.selectadd').attr({name:'return_slip_rows['+i+'][row_material_id]'});
             $(this).find('td:nth-child(2) select.selectadd').select2();
            $(this).find('td:nth-child(3) input').attr({name:'return_slip_rows['+i+'][quantity]'});
            $(this).find('td:nth-child(4) select.selectadd').attr({name:'return_slip_rows['+i+'][return_scrab]'});
            $(this).find('td:nth-child(4) select.selectadd').select2();
            i++;
         });
     }


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

