 <?php
foreach ($menus as $menu) {
    if(empty($menu->children))
    {
        ?>
        <li class="">
            <?= $this->Html->link($this->Html->tag('i', '', ['class'=>$menu->icon_class_name]).' '.$this->Html->tag('span', $menu->menu_name),['controller'=>$menu->controller,'action'=>$menu->action],['escape'=>false]) ?>
        </li>
        <?php
    }
    else if(!empty($menu->children))
    {
        ?>
        <li class="treeview">
            <?= $this->Html->link($this->Html->tag('i', '', ['class'=>$menu->icon_class_name]).' '.$this->Html->tag('span', $menu->menu_name).$this->Html->tag('i', '', ['class'=>'fa fa-angle-left pull-right']),'javascript:;',['escape'=>false]) ?>
            <ul class="treeview-menu">
        <?php
        foreach ($menu->children as $childrenMenu) {
            if(!empty($childrenMenu->children))
            {
                ?>
                <li class="treeview">
                    <?= $this->Html->link($this->Html->tag('i', '', ['class'=>$childrenMenu->icon_class_name]).' '.$this->Html->tag('span', $childrenMenu->menu_name).$this->Html->tag('i', '', ['class'=>'fa fa-angle-left pull-right']),'javascript:;',['escape'=>false]) ?>
                    <ul class="treeview-menu">
                    <?php
                    foreach ($childrenMenu->children as $childrenSubMenu) {
                        ?>
                        <li class="">
                            <?= $this->Html->link($this->Html->tag('i', '', ['class'=>$childrenSubMenu->icon_class_name]).' '.$this->Html->tag('span', $childrenSubMenu->menu_name),['controller'=>$childrenSubMenu->controller,'action'=>$childrenSubMenu->action],['escape'=>false]) ?>
                        </li>
                        <?php
                    }
                    ?>
                    </ul>
                </li>
                <?php
            }
            else
            {
                ?>
                <li class="">
                    <?= $this->Html->link($this->Html->tag('i', '', ['class'=>$childrenMenu->icon_class_name]).' '.$this->Html->tag('span', $childrenMenu->menu_name),['controller'=>$childrenMenu->controller,'action'=>$childrenMenu->action],['escape'=>false]) ?>
                </li>
                <?php
            }
                
        }
        ?>
            </ul>
        </li>
        <?php
    }
}
?>
 <li style="padding-left: 30px;padding-top: 25px;">
        <a href="<?php echo $this->Url->build(["controller" => "Employees",'action'=>'logout']); ?>" class="" style="font-size:15px;width:80%;background-color:#00B17A;height:33px;border-radius:5px;padding-bottom: 25px;color:white;text-align:center;padding-top:5px;padding-left: 5px;"><i class="fa fa-sign-out"></i>Log out</a>
    </li>

