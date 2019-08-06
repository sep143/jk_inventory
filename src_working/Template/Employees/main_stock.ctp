<?php
 $url_excel="/?".$url; 
/**
 * @Author: PHP Poets IT Solutions Pvt. Ltd.
 */
//$this->set('title', 'Sales Report');
?>
<?php
if($status=='excel'){
$date= date("d-m-Y"); 
$time=date('h:i:a',time());

$filename="Department_stock_".$date.'_'.$time;
$from_date=date('d-m-Y',strtotime($from_date));
$to_date=date('d-m-Y',strtotime($to_date));

header ("Expires: 0");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=".$filename.".xls");
header ("Content-Description: Generated Report" ); 
echo '<table border="1"><tr style="font-size:14px;"><td colspan="5" align="center" style="text-align:center;">'.$companies->name .'<br/>' .$companies->address .',<br/>'. $companies->state->name .'</span><br/>
<span> <i class="fa fa-phone" aria-hidden="true"></i>'.  $companies->phone_no . ' | Mobile : '. $companies->mobile .'<br/> GSTIN NO:'.
$companies->gstin .'</span></td></tr></table>';
}

 ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Stock Details</label>
                <?php 
                  if($status != 'excel'){
                ?>
                 <div  class="row">
                        <div class="col-md-12">
                             <?= $this->Form->create($po_data,['type'=>'GET']) ?>
                                <div class="row">
                                <?php if($department_id == "1") { ?>
                                     <div class="col-md-3">
                                        <label class="control-label"> Select Department</label>
                                        <?php echo $this->Form->control('department_id', ['options' =>$department, 'empty' =>'Select Department','label'=>false,'class'=>'select2','style'=>'width:100%;','value'=>$this->request->query('department_id')]);?>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label"> Date From </label>
                                        <?= $this->Form->control('from',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>$this->request->query('from')])?>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label"> Date To </label>
                                        <?= $this->Form->control('to',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>$this->request->query('to')])?>
                                    </div>
                                    <div class="col-md-1">
                                         <?= $this->Form->submit('SEARCH',['class'=>'btn btn-info btnClass','style'=>'margin-top:28px;'])?>
                                    </div>
                                    <div class="col-md-1">
                                        <?= $this->Html->link(__('RESET'), ['action' => 'main-stock'],['class'=>'btn btn-danger btnClass','escape'=>false, 'data-widget'=>'Reset', 'data-toggle'=>'tooltip', 'data-original-title'=>'Reset','style'=>'margin-top:28px;']) ?>
                                    </div>
                                <?php } ?>
                                    <div class="col-md-1">
                                        <?php echo  $this->Html->link( '<i class="fa fa-file-excel-o"></i> Excel', '/Employees/main-stock/'.@$url_excel.'&status=excel',['class' =>'btn btn-success btnClass','target'=>'_blank','escape'=>false,'data-original-title'=>'Download as excel','style'=>'margin-top:28px;']); ?>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-3 text-center">
                                      
                                    </div>
                                </div> -->
                                <?= $this->Form->end(); ?>
                            </div>
                        </div><br></br>
                        <?php  } ?>
                    <br>
            </div><hr>
            <?php if(!empty($row_material_list)) { ?>
            <div class="box-body">
                <div class="form-group">
                <?php if(!empty($departmentname)){
                    echo '<h3>Name: '.$departmentname->name.'</h3>';
                } ?>
                   <?php $page_no=$this->Paginator->current('Employees'); $page_no=($page_no-1)*20; ?>
                         <table id="example1" class="table" <?php if($status == 'excel'){ ?> border="1" <?php } ?>>
                            <thead>
                                <tr>
                                    <th scope="col"><?= __('Sr.No') ?></th>
                                    <th scope="col"><?= __('Material Name ') ?></th>
                                     <th scope="col"><?= __('Total In') ?></th>
                                    <th scope="col"><?= __('Issue Quantity') ?></th>
                                    <th scope="col"><?= __('Available Quantity') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($row_material_list as $row_material): 
                                    if(!empty(@$row_material->stock_ledgers[0]->total_in))
                                    {
                                ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td>
                                    <?= h(@$row_material->name) ?>
                                    </td>
                                    <td><?= @$row_material->stock_ledgers[0]->total_in.' '.$row_material->unit->name ?>
                                    </td>
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
                            <?php $i++;} endforeach; ?>
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
<?= $this->element('datepicker') ?> 
