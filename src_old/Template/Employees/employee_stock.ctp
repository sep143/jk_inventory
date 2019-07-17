
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> My Stock Details</label>
                <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="box-header with-border">
                              <?= $this->Form->create(' ',['id'=>'ServiceForm']) ?>
                                    <fieldset><legend>Filter</legend>
                                        <div class="col-md-12 " >
                                            <div class="row"> 
                                                   <div class="col-md-4">
                                                    <label class="control-label">Search By Employee</label>
                                                    <?= $this->Form->control('employee_id',array('options' => $empfff,'class'=>'select2','label'=>false,'style'=>'width:100%','empty'=>'Select Employee')) ?>
                                                </div> 
                                                <div class="col-md-1">
                                                    <label class="control-label"  style="visibility: hidden;">Search</label>
                                                     <?php echo $this->Form->button('Go',['class'=>'btn btn-md btn-success','id'=>'submit_member','name'=>'search_report','value'=>'yes']); ?> 
                                                </div>
                                                <div class="col-md-2">
                                                <label class="control-label"  style="visibility: hidden;">Search</label>
                                                  <?= $this->Html->link(__('Reset '), ['action' => 'index'],['class'=>'btn btn-danger btn-md','escape'=>false, 'data-widget'=>'Reset', 'data-toggle'=>'tooltip', 'data-original-title'=>'Reset','style'=>'margin-top: 28px;color:white;']) ?>
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </fieldset>
                              <?= $this->Form->end() ?>
                            </div>
                        </div>
                    </div> -->
                    <br>
            </div><hr>
            <?php if(!empty($row_material_list)) { ?>
            <div class="box-body">
                <div class="form-group">
                   <?php $page_no=$this->Paginator->current('Employees'); $page_no=($page_no-1)*20; ?>
                         <table id="example1" class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><?= __('Sr.No') ?></th>
                                    <th scope="col"><?= __('Material Name ') ?></th>
                                    <th scope="col"><?= __('Total Issue') ?></th>
                                    <th scope="col"><?= __('Used Quantity') ?></th>
                                    <th scope="col"><?= __('Available Quantity') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($row_material_list as $row_material): ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td>
                                    <?= h(@$row_material->name) ?>
                                    </td>
                                    <td><?= @$row_material->stock_ledgers[0]->total_in.' '.$row_material->unit->name ?></td>
                                    <td>
                                        <?php if(!empty($row_material->stock_ledgers[0]->total_out)) { ?>
                                        <?= @$row_material->stock_ledgers[0]->total_out.' '.$row_material->unit->name ?>
                                            
                                        <?php } else { ?>
                                            NA
                                        <?php } ?>
                                        </td>
                                    <td>
                                    <?php $current_stock=$row_material->stock_ledgers[0]->total_in-$row_material->stock_ledgers[0]->total_out; 

                                    ?>

                                    <?php
                                    if($current_stock>0)
                                    { 
                                        echo $current_stock.' '.h($row_material->unit->name);
                                    }else{
                                        echo "Out Of Stock";
                                    }
                                    ?>
                                    </td>
                                </tr>
                            <?php $i++; endforeach; ?>
                            </tbody>
                    </table>
                </div>
            </div>
             <!-- <div class="box-footer">
                <?= $this->element('pagination') ?> 
            </div> -->
        <?php } ?>
        </div>
    </div>
</div>
<?= $this->element('selectpicker') ?> 
