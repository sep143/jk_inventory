<label class="control-label"> Voucher No. :<span class="required" aria-required="true"> * </span>
                                &nbsp;&nbsp;<span id="load" style="display:none;">Loading...</span>
<?php //pr($voucher_id); exit;?>
 <?php echo $this->Form->control('Voucher',['options' => $voucher,
                'label' => false,'class'=>'voucher_ids','empty'=>'Select Voucher','style'=>'width:300px;', 'required']); ?>
                
                