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

$filename="Requisition_report_".$date.'_'.$time;
$from_date=date('d-m-Y',strtotime($from_date));
$to_date=date('d-m-Y',strtotime($to_date));

header ("Expires: 0");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=".$filename.".xls");
header ("Content-Description: Generated Report" ); 
echo '<table border="1"><tr style="font-size:14px;"><td colspan="13" align="center" style="text-align:center;">'.$companies->name .'<br/>' .$companies->address .',<br/>'. $companies->state->name .'</span><br/>
<span> <i class="fa fa-phone" aria-hidden="true"></i>'.  $companies->phone_no . ' | Mobile : '. $companies->mobile .'<br/> GSTIN NO:'.
$companies->gstin .'</span></td></tr></table>';
}

 ?>

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
                        <?php
                        if($status != 'excel'){
                        ?>
                             <?= $this->Form->create($new,['autocomplete'=>'off', 'type'=>'GET']) ?>
                                <div class="row">
                                <div class="col-sm-3">
                                    <label class="control-label"> Category</label>
                                        <?php echo $this->Form->control('row_material_category_id',['options' => $RowMaterialCategory,
                                        'label' => false,'class'=>'selectaddCat select2','id'=>'category_first','empty'=>'Select category','style'=>'width:100%;']);?>
                                    </div>
                                     <div class="col-sm-3">
                                        <label class="control-label"> Material</label>
                                        <div class="material_ajax">
                                        <?php echo $this->Form->control('row_material_id', ['options' =>'', 'empty' =>'Select Material','label'=>false,'class'=>'select2','style'=>'width:100%;','required','value'=>$this->request->query('row_material_id')]);?>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label"> Date From </label>
                                        <?= $this->Form->control('from',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>$this->request->query('from')])?>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label"> Date To </label>
                                        <?= $this->Form->control('to',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>$this->request->query('to')])?>
                                    </div>
                                   <div class="col-sm-1 ">
                                       <?= $this->Form->submit('SEARCH',['class'=>'btn btn-info btnClass','style'=>'margin-top:28px;','id'=>'submit_member'])?>
                                    </div>
                                    <div class="col-md-1">
                                        <?= $this->Html->link(__('RESET'), ['action' => 'stockRegisterReport'],['class'=>'btn btn-danger btnClass','escape'=>false, 'data-widget'=>'Reset', 'data-toggle'=>'tooltip', 'data-original-title'=>'Reset','style'=>'margin-top:28px;']) ?>
                                    </div>
                                    <div class="col-md-1">
                                        <?php echo  $this->Html->link( '<i class="fa fa-file-excel-o"></i> Excel', '/requisition-slips/file/'.@$url_excel.'&status=excel',['class' =>'btn btn-success btnClass','target'=>'_blank','escape'=>false,'data-original-title'=>'Download as excel','style'=>'margin-top:28px;']); ?>
                                    </div>
                                </div>
                                <?= $this->Form->end(); ?>
                        <?php } ?>
                            </div>
                    </div><br></br>
                    <?php if(!empty($requisitionSlip))
                    {?>
                     <table id="example1" class="table table-bordered table-striped" <?php if($status == 'excel'){ echo 'border="1"'; } ?> style="border-collapse:collapse;">
                         <thead>
                            <tr>
                                <h3> Name Of Article : <b><?php
                                // $a=[];$abc ='';
                                // foreach($requisitionSlip as $req1)
                                // {
                                //     $a[]= $req1->row_material->name;
                                //     $abc = $req1->row_material->name;
                                // } 
                                echo $rowMaterialsName->name;
                                 
                                ?></b></h3>
                            </tr>
                            <tr>
                                <th scope="col" rowspan="2"><?= ('Sr.No') ?></th>
                                <th scope="col" colspan="3"><?= ('Issue') ?></th>
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
                                <th>No.</th>
                                <th>Date</th>
                                <th>Qty</th>
                                <th>Inspector</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; $total_in=0; $total_out=0; $total_available=0;
                            foreach($requisitionSlip as $req)
                            {
                               
                           ?>
                            <tr>
                                 <td><?= $i; $i++;?></td>
                                 <td><?= $req->issue_slip->voucher_no?></td>
                                 <td><?= date('d-m-Y',strtotime($req->issue_slip->created_on))?></td>
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
                                 <td><?= $req->issue_slip->voucher_no?></td>
                                 <td><?= date('d-m-Y',strtotime($req->issue_slip->created_on))?></td>
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
                                 <td><?= $i;  $i++;?></td>
                                 <td><?= $req->issue_slip->voucher_no?></td>
                                 <td><?= date('d-m-Y',strtotime($req->issue_slip->created_on))?></td>
                                 <td><?= $req->quantity?></td>
                                 <td>-</td>
                                 <td><?php if(!empty($row_material->stock_ledgers[0]->total_out)) { ?>
                                        <?php echo @$row_material->stock_ledgers[0]->total_out.' '.$row_material->unit->name; }?></td>
                                 <td>-</td>
                                 <td><?= $return->return_slip->voucher_no?></td>
                                 <td><?php echo date('d-m-Y',strtotime($return->return_slip->created_on)) ?></td>
                                 <td><?= $return->quantity?></td>
                                 
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
                                 <td><?= $i;  $i++;?></td>
                                 <td><?= $req->issue_slip->voucher_no?></td>
                                 <td><?= date('d-m-Y',strtotime($req->issue_slip->created_on))?></td>
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

<?php
$js="
$(document).ready(function(){

    $(document).on('change','.selectaddCat',function(){
		//var row_material_category_id=$(this).val();
		var temp=$(this);
		var cat_id_add = $(this).val();
		var url='".$this->Url->build(['controller' => 'RequisitionSlips', 'action' => 'meterialShow'])."';
        url = url+'/'+cat_id_add; 
        $.ajax({
			url:url,
			type: 'GET'
		}).done(function(response){
            $('.material_ajax').html(response);
            $('#material_ids').select2();
			
		}); 
	});

$('#ServiceForm').validate({ 
        rules: {
            row_material_id: {
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