<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Create Return Slip</label>
            </div><hr>
            <div class="box-body">
                <div class="form-group">
                     <?= $this->Form->create('',['class'=>'ServiceForm','type'=>'get']) ?>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label"> Return By :<span class="required" aria-required="true"> * </span></label>
                                 <?php echo $this->Form->control('employee_id',['options' => $employees,
                                    'label' => false,'class'=>' select2 employee_id','empty'=>'Select Employee','style'=>'width:300px;' ,'required']);?>
                            </div>
                            <div class="col-md-3 voucher_ajax">
                                <label class="control-label"> Voucher No. :<span class="required" aria-required="true"> * </span>
                                &nbsp;&nbsp;<span id="load" style="display:none;">Loading...</span>
                                </label>
                                 <?php echo $this->Form->control('Voucher',['options' => '',
                                    'label' => false,'class'=>' select2 voucher_id','empty'=>'Select Voucher','style'=>'width:300px;', 'required']);?>
                                    
                            </div>
                            <div class="col-md-1">
                               <?= $this->Form->submit('SEARCH',['class'=>'btn btn-info btnClass','style'=>'margin-top:28px;'])?>
                            </div>
                        </div>
                         <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
<?= $this->element('selectpicker') ?> 
    </div>

    <?php
$js="
$(document).ready(function(){
     
    $(document).on('change','.employee_id',function(){
		var temp=$(this);
		var emp_id = $(this).val();
		var url='".$this->Url->build(['controller' => 'returnSlips', 'action' => 'VoucherShow'])."';
        url = url+'/'+emp_id;
        $('#load').show();
        $.ajax({
			url:url,
			type: 'GET'
		}).done(function(response){
            $('#load').hide();
            $('.voucher_ajax').html(response);
            $('.voucher_ids').select2();
			
		}); 
	});


});
    ";
     $this->Html->scriptBlock($js,['block'=>'block_js']);
 ?>