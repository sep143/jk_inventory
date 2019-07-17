<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Disposed Materials</label>
            </div><hr>
            <div class="box-body">
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
                        <?php $i=1; foreach ($scrabs as $scrabs): ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?= h($scrabs->row_material->name) ?></td>
                                <td><?= h($scrabs->quantity) ?></td>
                                <td><?= h($scrabs->employee->name) ?></td>
                                <td><?= h($scrabs->transaction_date) ?></td>
                                <td><?= h($scrabs->disposed_on) ?></td>
                                <td><?= h($scrabs->disposer->name) ?></td>
                            </tr>
                            <?php $i++;endforeach; ?>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>