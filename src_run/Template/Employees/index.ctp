
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Employee Details</label>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                              <?= $this->Form->create(' ',['id'=>'ServiceForm','type'=>'get']) ?>
                                    <fieldset><legend>Filter</legend>
                                        <div class="col-md-12 " >
                                            <div class="row"> 
                                                   <div class="col-md-4">
                                                    <label class="control-label">Search By Employee</label>
                                                    <?= $this->Form->control('employee_id',array('options' => $empfff,'class'=>'select2','label'=>false,'style'=>'width:100%','empty'=>'Select Employee')) ?>
                                                </div> 
                                                <div class="col-md-1">
                                                     <?= $this->Form->submit('SEARCH',['class'=>'btn btn-info btnClass','style'=>'margin-top:30px;'])?>
                                                </div>
                                                <div class="col-md-2">
                                                <label class="control-label"  style="visibility: hidden;">Search</label>
                                                  <?= $this->Html->link(__('RESET'), ['action' => 'index'],['class'=>'btn btn-danger btn-md','escape'=>false, 'data-widget'=>'Reset', 'data-toggle'=>'tooltip', 'data-original-title'=>'Reset','style'=>'margin-top: 30px;color:white;']) ?>
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </fieldset>
                              <?= $this->Form->end() ?>
                        </div>
                    </div>
                    <br>
                <?php if(!empty($employees)) { ?>
                <div class="form-group">
                   <?php $page_no=$this->Paginator->current('Employees'); $page_no=($page_no-1)*20; ?>
                         <table id="example1" class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><?= __('Sr.No') ?></th>
                                    <th scope="col"><?= __('Name ') ?></th>
                                    <th scope="col"><?= __('Username') ?></th>
                                    <th scope="col"><?= __('Email') ?></th>
                                    <th scope="col"><?= __('Mobile') ?></th>
                                    <th scope="col"><?= __('Role') ?></th>
                                    <th scope="col"><?= __('Department') ?></th>
                                    <th scope="col"><?= __('Status') ?></th>
                                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($employees as $employee): ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td>
                                    <?php echo $employee->name;?>
                                    </td>
                                    <td>
                                    <?php echo $employee->username;?>
                                    </td>
                                     <td>
                                    <?php echo $employee->email;?>
                                    </td>
                                    <td>
                                    <?php echo $employee->mobile_no;?>
                                    </td>
                                    <td>
                                    <?php echo $employee->role->role;?>
                                    </td>
                                    <td>
                                    <?php echo $employee->department->name;?>
                                    </td>
                                    <td>
                                    <?php $status=$employee->is_deleted;
                                            if($status=='1')
                                                echo"Deactive";
                                            else
                                                echo"Active";
                                    
                                    ?>
                                    </td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $EncryptingDecrypting->encryptData($employee->id)],['class'=>'btn btn-info editbtn','escape'=>false, 'data-widget'=>'Edit Employee', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Employee']) ?>
                                    </td>
                                </tr>
                            <?php $i++; endforeach; ?>
                            </tbody>
                    </table>
                </div>
            </div>
             <div class="box-footer">
                <?= $this->element('pagination') ?> 
            </div>
        <?php } ?>
        </div>
    </div>
</div>
<?= $this->element('selectpicker') ?> 
