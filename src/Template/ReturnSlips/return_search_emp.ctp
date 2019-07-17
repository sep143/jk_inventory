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
                            <div class="col-md-4">
                                <label class="control-label"> Return By :<span class="required" aria-required="true"> * </span></label>
                                 <?php echo $this->Form->control('employee_id',['options' => $employees,
                                    'label' => false,'class'=>' select2 employee_id','empty'=>'Select Employee','style'=>'width:300px;']);?>
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