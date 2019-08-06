<?= $this->Html->script('/assets/js/plugins/jquery-validation/js/jquery.validate.min.js',['block'=>'validatejs']) ?>
<?php
$js="

$(document).ready(function(){
    $('form').not('.filter_form').validate();

});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>