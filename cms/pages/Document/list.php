{{table|raw}}
<?php

/**
 * Created by: Raymond Chong
 * Date: 2021-07-07 
 */
return new class
{
    function get(VX $vx)
    {
        $rt = $vx->ui->createRTable("ds");
        $rt->add("Name", "name");
        $this->table = $rt;
    }

    public function ds(VX $vx)
    {
        $rt = $vx->ui->createRTableResponse();
        $rt->source = Document::Query();

        return $rt;
    }
};
