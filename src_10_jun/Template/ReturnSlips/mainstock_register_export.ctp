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
                                <th scope="col"><?= ('Sr.No') ?></th>
                                <th scope="col"><?= ('DATE') ?></th>
                                <th scope="col"><?= ('ITEM NAME') ?></th>
                                <th scope="col"><?= ('PARTICULARS') ?></th>
                                <th scope="col" ><?= ('RECEIPT QTY') ?></th>
                                <th scope="col" > ISSUE QTY</th>
                                <!-- <th scope="col"><?= ('ISSUE TO') ?></th> -->
                                <th scope="col" > BALANCE QTY</th>
                                <th scope="col" > THROUGH  </th>
                                <th scope="col" > REMARKS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; $total_in=0; $total_out=0; $total_available=0;
                            foreach ($StockDatas as $stockdata):?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?= h($stockdata->transaction_date) ?></td>
                                <td><?= h($stockdata->row_material->name ) ?></td>
                                <td><?= h($stockdata->particulars) ?></td>
                                <td>
                                        <?php if(($stockdata->good_receive_note_id !='' || $stockdata->return_slip_id !='' ) && ($stockdata->status=='In')) { ?>
                                                <?php $total_in=$total_in+$stockdata->quantity; ?>
                                                    <?= h($stockdata->quantity.' '.$stockdata->row_material->unit->name) ?></th>
                                        <?php } ?>
                                </td>
                                <td>
                                    <?php if(($stockdata->issue_slip_id !='') && ($stockdata->status=='Out')) { ?>
                                    <?php $total_out=$total_out+$stockdata->quantity; ?>
                                     <?= h($stockdata->quantity.' '.$stockdata->row_material->unit->name) ?>
                                    <?php }?>
                                </td>
                                <!-- <td><?= h($issueSlip->employee->name) ?></td> -->
                                <td>
                                    <?php $total_available=$total_in - $total_out; ?>
                                    <?= h($total_available.' '.$stockdata->row_material->unit->name) ?></th>
                                </td>
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
                                <th colspan="3"></th>
                                <th > <b>Total </b></th>
                               <th >
                                 <?php if(!empty($total_out)) { ?>
                                <b><?= $total_in.' '.$stockdata->row_material->unit->name ?></b></th>
                                 <?php }?>
                             </th>
                                <th >
                                <?php if(!empty($total_out)) { ?>
                                 <b><?= $total_out.' '.$stockdata->row_material->unit->name ?></b></th>
                                 <?php }?>
                                <th > 
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