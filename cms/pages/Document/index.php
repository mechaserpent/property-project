<vx-card>
    <vx-card-body>
        {{tab|raw}}
    </vx-card-body>
</vx-card>
<?php

/**
 * Created by: Raymond Chong
 * Date: 2021-07-07 
 */
return new class
{
    function get(VX $vx)
    {
        $tab = $vx->ui->createTab();
        $tab->add("All", "list");
        $this->tab = $tab;
    }
};
