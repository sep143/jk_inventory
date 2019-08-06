<label class="control-label"> Material</label>
 <?php echo $this->Form->control('data[row_material_id]',['options' => $findDatas,
                'label' => false,'class'=>'','empty'=>'Select Material','style'=>'width:300px;','id'=>'material_ids']); ?>
                