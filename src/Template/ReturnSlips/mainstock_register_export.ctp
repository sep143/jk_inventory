<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookIssueReturn[]|\Cake\Collection\CollectionInterface $bookIssueReturns
 */
?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                </div> 
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12 text-center" id="school_detail">
                            <h4>Main Stock Report</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-md-offset-8 text-right">
                            <table class="pull-right">
                               
                                <tr>
                                    <td>    
                                        <button id="btnExport" onclick="fnExcelReport();" class="btn btn-sm btn-info no-print"> EXPORT </button>
                                </tr>
                            </table>
                        </div>
                    </div>
                     <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
                         <thead>
                            <tr>
                                <h3> Name Of Article : <b><?php  $b=0;
                                foreach ($StockDatas as $stockdatas){
                                    $a=$stockdatas->row_material->name;
                                    if($a != $b)
                                    {
                                        echo $a;
                                        $b=$a;
                                    }
                                }?> </b></h3>
                            </tr>
                            <tr>
                                <th scope="col" rowspan="2"><?= ('Sr.No') ?></th>
                                <th scope="col" rowspan="2"><?= ('Date') ?></th>
                                <th scope="col" rowspan="2"><?= ('PARTICULARS') ?></th>
                                <th scope="col" colspan="3" ><?= ('RECEIPT QTY') ?></th>
                                <th scope="col" colspan="3"> ISSUE QTY</th>
                                <!-- <th scope="col"><?= ('ISSUE TO') ?></th> -->
                                <th scope="col" colspan="3" > BALANCE QTY</th>
                                <th scope="col" rowspan="2"> THROUGH  </th>
                                <th scope="col" rowspan="2"> REMARKS</th>
                            </tr>
                            <tr>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Amt.</th>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Amt.</th>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Amt.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; $total_in=0; $total_out=0; $total_available=0;
                            foreach ($StockDatas as $stockdata):?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?= h($stockdata->transaction_date) ?></td>
                                <td><?= h($stockdata->particulars) ?></td>
                                <td>
                                        <?php if(($stockdata->good_receive_note_id !='' || $stockdata->return_slip_id !='' ) && ($stockdata->status=='In')) { ?>
                                                <?php $total_in=$total_in+$stockdata->quantity; ?>
                                                    <?= h($stockdata->quantity.' '.$stockdata->row_material->unit->name) ?></th>
                                        <?php } ?>
                                </td>
                                <td><?php
                               
                                       echo $stockdata->rate;
                                ?></td>
                                <td><?php
                                if(($stockdata->good_receive_note_id !='' || $stockdata->return_slip_id !='' ) && ($stockdata->status=='In')) {
                                    echo $stockdata->quantity*$stockdata->rate;
                                    } ?></td>
                                <td>
                                    <?php if(($stockdata->issue_slip_id !='') && ($stockdata->status=='Out')) { ?>
                                    <?php $total_out=$total_out+$stockdata->quantity; ?>
                                     <?= h($stockdata->quantity.' '.$stockdata->row_material->unit->name) ?>
                                    <?php }?>
                                </td>
                                <td><?php 
                                        echo $stockdata->rate;
                                ?></td>
                                <td><?php
                                    if(($stockdata->issue_slip_id !='') && ($stockdata->status=='Out')) {
                                    echo $stockdata->quantity*$stockdata->rate;} ?></td>
                                <!-- <td><?= h($issueSlip->employee->name) ?></td> -->
                                <td>
                                    <?php $total_available=$total_in - $total_out; ?>
                                    <?= h($total_available.' '.$stockdata->row_material->unit->name) ?></th>
                                </td>
                               <td><?php echo $stockdata->rate;
                                ?></td>
                                 <td><?= $total_available * $stockdata->rate ?></td>
                                <td>
                                    <?php if($stockdata->good_receive_note_id!='0') { 
                                        echo " GRN";
                                    }
                                    else if($stockdata->return_slip_id!='0') {
                                        echo " RETURN ";
                                    }
                                    else if($stockdata->issue_slip_id!='0') {
                                        echo " ISSUE ";
                                    }
                                    ?>

                                </td>
                                 <td> </td>
                            </tr>
                            <?php  $i++;  endforeach; ?>
                            <tr style="background-color: #efe8e8;">
                                <th colspan="2"></th>
                                <th> <b>Total </b></th>
                               <th colspan="3">
                                 <?php if(!empty($total_out)) { ?>
                                <b><?= $total_in.' '.$stockdata->row_material->unit->name ?></b></th>
                                 <?php }?>
                             </th>
                                <th colspan="3">
                                <?php if(!empty($total_out)) { ?>
                                 <b><?= $total_out.' '.$stockdata->row_material->unit->name ?></b></th>
                                 <?php }?>
                                <th colspan="3"> 
                                    <?php if(!empty($total_available)) { ?>
                                    <b><?= $total_available.' '.$stockdata->row_material->unit->name ?></b>
                                <?php }?>
                                </th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->element('excelexport',['table'=>'example1']) ?>