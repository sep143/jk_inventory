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
                            <h4>Scrap Material Report</h4>
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
                                <th scope="col"><?= ('Material Name') ?></th>
                                <th scope="col"><?= ('Quantity') ?></th>
                                <th scope="col"><?= ('Scrap From') ?></th>
                                <th scope="col"><?= ('Department') ?></th>
                                <th scope="col"><?= ('Scrap Date') ?></th>
                            </tr>
                            </thead>
                            <?php $i=1; foreach ($scrabs as $scrabs): ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?= h($scrabs->row_material->name) ?></td>
                                    <td><?= h($scrabs->quantity).' '.h($scrabs->row_material->unit->name) ?></td>
                                    <td><?= h($scrabs->employee->name) ?></td>
                                    <td><?= h($scrabs->employee->department->name) ?></td>
                                    <td><?= h($scrabs->transaction_date) ?></td>
                                </tr>
                                <?php $i++;endforeach; ?>
                            <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->element('excelexport',['table'=>'example1']) ?>