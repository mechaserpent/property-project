{{table|raw}}
<?php

/**
 * Created by: Raymond Chong
 * Date: 2021-07-07 
 */

use Laminas\Db\Sql\Update;
use P\HTMLTemplateElement;

return new class
{
    function get(VX $vx)
    {
        $table = $vx->ui->createTable("ds");
        $action = $table->addActionColumn();
        $action->addView();
        $action->addEdit();
        $action->addDelete();

        $table->add("Date", "date")->sortable()->searchable("date")->width(110);
        $table->add("Seq", "sequence")->sortable()->searchable()->width(80);

        $options = [];
        foreach (Updates::TYPE as $i => $type) {
            $options[] = [
                "text" => $type,
                "value" => $i
            ];
        }
        $table->add("Type", "type")->filterable($options)->width(150);

        $table->add("Title[EN]", "title_en")->sortable()->searchable()->width(150);
        $table->add("Title[TC]", "title_tc")->sortable()->searchable()->width(150);
        $table->add("Title[SC]", "title_sc")->sortable()->searchable()->width(150);
        $table->add("Preview", "preview_url")->template(function (HTMLTemplateElement $template) {

            $template->innerHTML='<a class="btn btn-sm btn-primary" :href="`${scope.row.preview_url.en}`">EN</a> '
                . '<a class="btn btn-sm btn-primary" :href="`${scope.row.preview_url.tc}`">TC</a> '
                . '<a class="btn btn-sm btn-primary" :href="`${scope.row.preview_url.sc}`">SC</a> ';

/*             return html("a")->class("btn btn-xs btn-primary")->href("{$url}/en/sales-info/" . $type[$o->type] . "?preview=1")->html("EN")->target("_blank") . " " .
                html("a")->class("btn btn-xs btn-primary")->href("{$url}/sales-info/" . $type[$o->type] . "?preview=1")->html("TC")->target("_blank") . " " .
                html("a")->class("btn btn-xs btn-primary")->href("{$url}/sc/sales-info/" . $type[$o->type] . "?preview=1")->html("SC")->target("_blank");
 */
        })->width(200);
        
        $table->add("Created Time", "created_time")->width(160);
        $table->add("Created By", "created_by")->width(160);
        $table->add("Updated Time", "updated_time")->width(160);
        $table->add("Updated By", "updated_by")->width(160);

        $options = [];
        foreach (Updates::STATUS as $i => $status) {
            $options[] = [
                "text" => $status,
                "value" => $i
            ];
        }
        $table->add("Status", "status")->filterable($options)->width(110);

        $this->table = $table;
    }

    public function ds(VX $vx)
    {
        $obj = $vx->Object();
        $rt = $vx->ui->createTableResponse();
        $rt->setData(Updates::Query());

        if ($vx->_get["t"] !== null) {
            $rt->source->where(["status" => $vx->_get["t"]]);
        }

        $rt->setDataMap(function (Updates $o) {

            $o->status = $o->status();
            $o->created_by= (string)$o->CreatedBy();
            $o->updated_by= (string)$o->UpdatedBy();
            
            $url = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"];
            $type = Updates::TYPE;
            $type[$o->type] = str_replace(" ", "+", strtolower($type[$o->type]));
            
            $o->preview_url = [
                "en" => "{$url}/sales-info/" . $type[$o->type] . "?preview=1",
                "sc" => "{$url}/sc/sales-info/" . $type[$o->type] . "?preview=1",
                "tc" => "{$url}/tc/sales-info/" . $type[$o->type] . "?preview=1",
            ];
            
            $o->type = $o->type();
            return $o;
        });



        return $rt;
    }
};
