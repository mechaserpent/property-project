<el-card>
    {{tab|raw}}
</el-card>
<?php

return new class
{
    function get(VX $vx)
    {
        $tab = $vx->ui->createTabs();
        $tab->add("All", "Updates/list");
        $this->tab = $tab;
    }
};
