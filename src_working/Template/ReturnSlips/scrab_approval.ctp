<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Approval For Scrap Materials</label>
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
                                <th scope="col"><?= ('Department') ?></th>
                                <th scope="col"><?= ('Scrap Date') ?></th>
                                <th scope="col"><?= ('Comments') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <?php $i=1; foreach ($scrabs as $scrabs): ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?= h($scrabs->row_material->name) ?></td>
                                <td><?= h($scrabs->quantity) ?></td>
                                <td><?= h($scrabs->employee->name) ?></td>
                                <td><?= h($scrabs->department->name) ?></td>
                                <td><?= h($scrabs->transaction_date) ?></td>
                                <td><?= h($scrabs->description) ?></td>
                                <td class="actions">
                                    <?php if($scrabs->disposed_status=='0') { ?>
                                    <a href="#myModal<?php echo $scrabs->id ;?>" class="btn btn-primary editbtn sizebtn" data-toggle="modal" /> Dispose</a>
                                <?php } else { ?>
                                    <b style="color:red;">Material Disposed</b>
                                     <!-- <a href="#myModal<?php echo $scrabs->id ;?>" class="btn btn-info editbtn " data-toggle="modal" /> Undo</a> -->

                                <?php }?>
                                        <div id="myModal<?php echo $scrabs->id ;?>" class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-dialog">
                                            <div class="modal-content">
                                            <?= $this->Form->create('',['class'=>'ServiceForm']) ?>
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> Confirm Header </h4>
                                              </div>
                                              <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                      <h4>Are you sure, you want to dispose this material ?</h4> 
                                                    </div>
                                                    <?php echo $this->Form->hidden('scrab_id',[
                                                  'value'=>$scrabs->id]);?>
                                                </div>
                                                 
                                              </div>
                                              <div class="modal-footer">
                                                <?php echo $this->Form->button('Submit',['class'=>'btn btn-info submit_member']); ?>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                              </div>
                                              <?= $this->Form->unlockField('id') ;?>
                                              <?= $this->Form->end() ?>
                                            </div>
                                        </div>
                                    </div> 
                                </td>
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