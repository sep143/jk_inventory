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
                            <h4> Receipt Register Report</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-md-offset-8 text-right">
                            <table class="pull-right">
                                <tr>
                                    <td>    
                                        <button id="btnExport" onclick="fnExcelReport();" class="btn btn-sm btn-info no-print"> EXPORT </button></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                     <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
                       <thead>
                            <tr>
                                <th scope="col"><?= ('Sr.No') ?></th>
                                <th scope="col"><?= ('Date') ?></th>
                                <th scope="col"><?= ('GRN No') ?></th>
                                <th scope="col"><?= ('Bill/ Challan No') ?></th>
                                <th scope="col"><?= ('Purchase Order No') ?></th>
                                <th scope="col"><?= ('Through') ?></th>
                                <th scope="col" >Supplier's Name </th>
                                <th scope="col"><?= ('Item Name') ?></th>
                                <th scope="col"><?= ('Quantity') ?></th>
                                <th scope="col"><?= ('Received By') ?></th>
                                <th scope="col"><?= ('Inspection Remarks') ?></th>
                                 <th scope="col"><?= ('Inspection By') ?></th>
                                <th scope="col"><?= ('Rate') ?></th>
                                <th scope="col"><?= ('Amount') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  foreach ($goodReceiveNotes as $goodReceiveNote): ?>

                             <?php $j=1; foreach ($goodReceiveNote->good_receive_note_rows as $goodR_receive_rows){ ?>
                            <tr>
                                <td><?php echo $j;?></td>
                                <td><?= h($goodReceiveNote->transaction_date) ?></td>
                                <td><?= h('GRN-'.$goodReceiveNote->id) ?></td>
                                <td><?= h($goodReceiveNote->bill_no) ?></td>
                                <td>
                                    <?= h($goodReceiveNote->purchase_order->voucher_no) ?></a>

                                </td>
                                 <td><?= h($goodReceiveNote->transport) ?></td>
                                 <td><?= h($goodReceiveNote->purchase_order->vendor->name) ?></td>
                                 <td><?php echo $goodR_receive_rows->row_material->name ;?></td>
                                <td><?php echo $goodR_receive_rows->quantity ;?></td>
                                <td><?= h($goodReceiveNote->creater->name) ?></td>
                                <td><?= h($goodReceiveNote->inspection_remark) ?></td>
                                <td><?= h($goodReceiveNote->inspector->name) ?></td>
                                 <td><?php echo $goodR_receive_rows->rate ;?></td>
                                <td><?php echo $goodR_receive_rows->amount ;?></td>
                               
                            </tr>
                            <?php $j++; } ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->element('excelexport',['table'=>'example1']) ?>