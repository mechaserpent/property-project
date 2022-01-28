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
        $tab->add("Active", "Updates/list?t=1");
        $tab->add("Inactive", "Updates/list?t=0");
        $tab->add("Hide", "Updates/list?t=2");       
        $this->tab = $tab;

    }
};
