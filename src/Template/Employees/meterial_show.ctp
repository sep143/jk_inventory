<label class="control-label"> Material Category <span class="required" aria-required="true"> * </span></label>
<?= $this->Form->control('row_material_id',array('options' => $findDatas,'class'=>'select2 material_id','label'=>false,'style'=>'width:100%','empty'=>'Select Material','required','id'=>'material_ids')) ?>
 
                