
<tr class="main_tr1">
            <td>1</td>  
            <td>
                <?php echo $this->Form->control('row_material_id',['options' => $rowMaterial,
                'label' => false,'class'=>'selectadd material_id','empty'=>'Select Material','style'=>'width:300px;']);?>
            </td>
            <td>
                <?php echo $this->Form->control('quantity',[
                'label' => false,'class'=>'form-control qty','placeholder'=>'Enter quantity','type'=>'text']);?>
            </td>
            <td>
                <?php echo $this->Form->control('return_scrab',['options' => $returnaction,
                'label' => false,'class'=>'selectadd returnaction','empty'=>'Select Status','style'=>'width:300px;']);?>
            </td>
            <td width="15%">
                <center>
                     <?= $this->Form->button(__('+'),['class'=>'btn btn-md btn-primary addrow','type'=>'button']) ?> 
                      <?= $this->Form->button(__('-'),['class'=>'btn btn-md btn-danger deleterow','type'=>'button']) ?>
                </center>
            </td>    
        </tr>