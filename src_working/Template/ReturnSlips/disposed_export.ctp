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
                            <h4> Disposed Material Report</h4>
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
                                <th scope="col"><?= ('Scrap Date') ?></th>
                                <th scope="col"><?= ('Disposed On') ?></th>
                                <th scope="col"><?= ('Disposed By') ?></th>
                            </tr>
                        </thead>
                            <?php $i=1; foreach ($disposedDatas as $disposedData): ?>
                               <tr>
                                <td><?php echo $i;?></td>
                                <td><?= h($disposedData->row_material->name) ?></td>
                                <td><?= h($disposedData->quantity).' '.h($disposedData->row_material->unit->name) ?></td>
                                <td><?= h($disposedData->employee->name) ?></td>
                                <td><?= h($disposedData->transaction_date) ?></td>
                                <td><?= h($disposedData->disposed_on) ?></td>
                                <td><?= h($disposedData->disposer->name) ?></td>
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