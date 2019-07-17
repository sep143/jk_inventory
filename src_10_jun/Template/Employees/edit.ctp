
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Add New Employee</label>
            </div><hr>
            <div class="box-body">
                <div class="form-group">
                    <?= $this->Form->create($employee,['id'=>'ServiceForm']) ?>
                        <div class="row">
                                <div class="col-md-4">
                                    <label class="control-label"> Name <span class="required" aria-required="true"> * </span></label>
                                    
                                    <?php echo $this->Form->control('name',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter Name','type'=>'text']);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Username <span class="required" aria-required="true"> * </span></label>

                                    <?php echo $this->Form->control('username',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter Username','type'=>'text']);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Password <span class="required" aria-required="true"> * </span></label>

                                    <?php echo $this->Form->control('password',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter password','type'=>'password','value'=>'']);?>
                                </div>
                            </div>
                            <span class="help-block"></span>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="control-label"> Email <span class="required" aria-required="true"> * </span></label>
                                    
                                    <?php echo $this->Form->control('email',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter email','type'=>'text']);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Mobile No <span class="required" aria-required="true"> * </span></label>

                                    <?php echo $this->Form->control('mobile_no',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter mobile number','type'=>'text']);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Department <span class="required" aria-required="true"> * </span></label>
                                    <?= $this->Form->control('department_id',array('options' => $departments,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
                                  
                                </div>
                            </div>
                            <span class="help-block"></span>
                            <div class="row">
                                 <div class="col-md-4">
                                    <label class="control-label"> Role <span class="required" aria-required="true"> * </span></label>
                                    <?= $this->Form->control('role_id',array('options' => $roles,'class'=>'select2','empty'=>'Select Role','label'=>false,'style'=>'width:100%')) ?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Address <span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('address',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter Address','type'=>'textarea']);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Status <span class="required" aria-required="true"> * </span></label>
                                   <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
                                </div>
                                
                            </div>
                            <span class="help-block"></span>
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
});
    ";
     $this->Html->scriptBlock($js,['block'=>'block_js']);
 ?>

