
      <div class="row">
        <div class="col-md-12">
         <div class="box box-primary">
             <div class="box-header with-border" >
                <label> Change Password</label>
            </div><hr>
            <?= $this->Form->create('',['id'=>'ServiceForm']) ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Current Password <span class="required" aria-required="true"> * </span></label>                            
                            <?php echo $this->Form->control('old_password',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Enter Current Password','type'=>'password']);?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"> New Password <span class="required" aria-required="true"> * </span></label>

                            <?php echo $this->Form->control('password',[
                            'label' => false,'class'=>'form-control pd','placeholder'=>'Enter New Password','type'=>'password']);?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"> Confirm Password <span class="required" aria-required="true"> * </span></label>

                            <?php echo $this->Form->control('cpassword',[
                            'label' => false,'class'=>'form-control cpassword','placeholder'=>'Confirm Password','type'=>'password']);?>
                        </div>
                    </div>
                    <span class="help-block"></span>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member']); ?>
                            </center>   
                        </div>                
                    </div>              
                </div>              
            <?= $this->Form->end() ?>
        </div> 
    </div> 
</div> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

  $('#ServiceForm').validate({ 
        rules: {
            
            password: {
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

      
