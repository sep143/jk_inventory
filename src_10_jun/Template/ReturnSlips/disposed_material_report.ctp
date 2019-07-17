<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Disposed Materials</label>
            </div><hr>
            <div class="box-body">
                <div class="row">
                        <div class="col-md-12">
                             <?= $this->Form->create($disposed_data,['autocomplete'=>'off']) ?>
                                 <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label"> Select Employee</label>
                                        <?php echo $this->Form->control('data[employee_id]', ['options' =>$employees, 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;',]);?>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label"> Select Department</label>
                                        <?php echo $this->Form->control('data[department_id]', ['options' =>$departments, 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;',]);?>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="control-label"> Date From </label>
                                        <?= $this->Form->control('data[transaction_date >=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','value'=>@$_POST['data']['in_date >='],'placeholder'=>'Select Date'])?>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="control-label"> Date To </label>
                                        <?= $this->Form->control('data[transaction_date <=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','value'=>@$_POST['data']['in_date <='],'placeholder'=>'Select Date'])?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="col-md-5"></div>
                                            <div class="col-md-1">
                                                <?= $this->Form->submit('SEARCH',['class'=>'btn btn-info btnClass','style'=>'margin-top:28px;'])?>
                                            </div>
                                            <div class="col-md-1">
                                                <?= $this->Html->link(__('RESET'), ['action' => 'scrabMaterialReport'],['class'=>'btn btn-danger btnClass','escape'=>false, 'data-widget'=>'Reset', 'data-toggle'=>'tooltip', 'data-original-title'=>'Reset','style'=>'margin-top:28px;']) ?>
                                            </div>
                                    </div>
                                </div>
                                <?= $this->Form->end(); ?>
                            </div>
                        </div>
                    <br>
                <?php if(!empty($disposedData)) { ?>     
                <div class="row">
                    <div class="col-md-4 col-md-offset-8 text-right">
                        <table class="pull-right">
                            <tr>
                                <td>
                                    <?= $this->Form->create($disposed_data,['autocomplete'=>'off','url'=>['action'=>'disposedExport']]) ?>
                                        <?php if (isset($where)): ?>
                                            <?php foreach ($where as $key => $value): ?>
                                                <?= $this->Form->hidden($key,['value'=>$value]) ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                        <?= $this->Form->submit('Export',['class'=>'btn btn-sm btn-info no-print"',])?>
                                    <?= $this->Form->end() ?>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                   <?php $page_no=$this->Paginator->current('ReturnSlips'); $page_no=($page_no-1)*20; ?>
                    <table cellpadding="0" cellspacing="0" class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= ('Sr.No') ?></th>
                                <th scope="col"><?= ('Material Name') ?></th>
                                <th scope="col"><?= ('Quantity') ?></th>
                                <th scope="col"><?= ('Scrap From') ?></th>
                                <th scope="col"><?= ('Scrap Date') ?></th>
                                <th scope="col"><?= ('Disposed On') ?></th>
                                <th scope="col"><?= ('Disposed By') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach ($disposedData as $disposed): ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?= h($disposed->row_material->name) ?></td>
                                <td><?= h($disposed->quantity) ?></td>
                                <td><?= h($disposed->employee->name) ?></td>
                                <td><?= h($disposed->transaction_date) ?></td>
                                <td><?= h($disposed->disposed_on) ?></td>
                                <td><?= h($disposed->disposer->name) ?></td>
                            </tr>
                            <?php $i++;endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
</div>
<?= $this->element('selectpicker')?>
<?= $this->element('datepicker')?>