<?= $this->Html->css('/assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css',['block'=>'datepickercss']) ?>
<?= $this->Html->script('/assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js',['block'=>'datepickerjs']) ?>
<?php 
$js="
$(document).ready(function(){

	 $('.datepicker').datepicker({
         autoclose: true
    });

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>