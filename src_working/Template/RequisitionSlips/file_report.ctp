

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                 <div class="box-header with-border" >
                    <label>Requisition Report</label>
                </div><hr>
                <div class="box-body">
                   <div  class="row" >
                        <div class="col-md-12">
                             <?= $this->Form->create($new,['autocomplete'=>'off']) ?>
                                <div class="row">
                                     <div class="col-sm-4">
                                        <label class="control-label"> Material</label>
                                        <?php echo $this->Form->control('data[row_material_id]', ['options' =>$rowMaterials, 'empty' =>'Select Material','label'=>false,'class'=>'select2','style'=>'width:100%;','required']);?>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label"> Date From </label>
                                        <?= $this->Form->control('data[from]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date'])?>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label"> Date To </label>
                                        <?= $this->Form->control('data[to]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date'])?>
                                    </div>
                                   <div class="col-sm-1 ">
                                       <?= $this->Form->submit('SEARCH',['class'=>'btn btn-info btnClass','style'=>'margin-top:28px;','id'=>'submit_member'])?>
                                    </div>
                                    <div class="col-md-1">
                                        <?= $this->Html->link(__('RESET'), ['action' => 'stockRegisterReport'],['class'=>'btn btn-danger btnClass','escape'=>false, 'data-widget'=>'Reset', 'data-toggle'=>'tooltip', 'data-original-title'=>'Reset','style'=>'margin-top:28px;']) ?>
                                    </div>
                                </div>
                                <?= $this->Form->end(); ?>
                            </div>
                    </div><br></br>
                    <?php if(!empty($requisitionSlip))
                    {?>
                     <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
                         <thead>
                            <tr>
                                <h3> Name Of Article : <b><?php
                                 echo $requisitionSlip->name;
                                
                                ?></b></h3>
                            </tr>
                            <tr>
                                <th scope="col" rowspan="2"><?= ('Sr.No') ?></th>
                                <th scope="col" colspan="3"><?= ('Requisition') ?></th>
                                <th scope="col" colspan="3"><?= ('Consumption') ?></th>
                                <th scope="col" colspan="3" ><?= ('Return') ?></th>
                                <th scope="col" rowspan="2">Remain</th>
                                <th scope="col" colspan="2">Signature</th>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Qty.</th>
                                <th></th>
                                <th>Qty</th>
                                <th>Reason.</th>
                                <th>Date</th>
                                <th>Qty</th>
                                <th>No.</th>
                                <th>Inspector</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; $total_in=0; $total_out=0; $total_available=0;
                            foreach($requisitionSlip->requisition_slip_rows as $req)
                            {
                           ?>
                            <tr>
                                 <td><?= $i; $i++;?></td>
                                 <td><?= $req->requisition_slip->voucher_no?></td>
                                 <td><?= date('d-m-Y',strtotime($req->requisition_slip->created_on))?></td>
                                 <td><?= $req->quantity?></td>
                                 <td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                            </tr>
                            <?php 
                             
                            foreach($row_material_list as $row_material)
                            {
                            if(!empty($row_material->stock_ledgers))
                             {?>
                            <tr>
                                 <td><?= $i; $i++;?></td>
                                 <td><?= $req->requisition_slip->voucher_no?></td>
                                 <td><?= date('d-m-Y',strtotime($req->requisition_slip->created_on))?></td>
                                 <td><?= $req->quantity?></td>
                                 <td>-</td>
                                 <td><?php if(!empty($row_material->stock_ledgers[0]->total_out)) { ?>
                                        <?php echo @$row_material->stock_ledgers[0]->total_out.' '.$row_material->unit->name; }?></td>
                                 <td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                            </tr>
                             <?php 
                             if(!empty($returns))
                             {
                                foreach($returns as $return)
                                {
                                    
                            ?>
                            <tr>
                                 <td><?= $i?></td>
                                 <td><?= $req->requisition_slip->voucher_no?></td>
                                 <td><?= date('d-m-Y',strtotime($req->requisition_slip->created_on))?></td>
                                 <td><?= $req->quantity?></td>
                                 <td>-</td>
                                 <td><?php if(!empty($row_material->stock_ledgers[0]->total_out)) { ?>
                                        <?php echo @$row_material->stock_ledgers[0]->total_out.' '.$row_material->unit->name; }?></td>
                                 <td>-</td>
                                 <td><?php echo date('d-m-Y',strtotime($return->return_slip->created_on)) ?></td>
                                 <td><?= $return->quantity?></td>
                                 <td><?= $return->return_slip->voucher_no?></td>
                                 <td>
                                 <?php
                                    $minus= $req->quantity-$return->quantity;
                                    echo $minus - @$row_material->stock_ledgers[0]->total_out;
                                 ?>
                                 </td>
                                 <td>-</td>
                                 <td>-</td>
                            </tr>
                            <?php } } 
                            else
                            {
                            ?>
                            <tr>
                                 <td><?= $i?></td>
                                 <td><?= $req->requisition_slip->voucher_no?></td>
                                 <td><?= date('d-m-Y',strtotime($req->requisition_slip->created_on))?></td>
                                 <td><?= $req->quantity?></td>
                                 <td>-</td>
                                 <td><?php if(!empty($row_material->stock_ledgers[0]->total_out)) { ?>
                                        <?php echo @$row_material->stock_ledgers[0]->total_out.' '.$row_material->unit->name; }?></td>
                                 <td>-</td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                                 <td>-</td>
                            </tr>
                            <?php } ?>
                           
                            <?php $i++;}}} ?>
                        </tbody>
                        </tbody>
                    </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->element('selectpicker') ?> 
<?= $this->element('datepicker') ?> 
<?= $this->element('validate') ?> 
<?php $this->element('excelexport',['table'=>'example1']) ?>