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
        $table->add("Sequence", "sequence")->sortable()->searchable()->width(110);

        $options = [];
        foreach (Updates::TYPE as $i => $type) {
            $options[] = [
                "text" => $type,
                "value" => $i
            ];
        }
        $table->add("Type", "type")->sortable()->filterable($options);


        $table->add("Preview", "preview_url")->template(function (HTMLTemplateElement $template) {

            $template->innerHTML='<a class="btn btn-sm btn-primary" :href="`${scope.row.preview_url.en}`">EN</a> '
                . '<a class="btn btn-sm btn-primary" :href="`${scope.row.preview_url.tc}`">TC</a> '
                . '<a class="btn btn-sm btn-primary" :href="`${scope.row.preview_url.sc}`">SC</a> ';

/*             return html("a")->class("btn btn-xs btn-primary")->href("{$url}/en/sales-info/" . $type[$o->type] . "?preview=1")->html("EN")->target("_blank") . " " .
                html("a")->class("btn btn-xs btn-primary")->href("{$url}/sales-info/" . $type[$o->type] . "?preview=1")->html("TC")->target("_blank") . " " .
                html("a")->class("btn btn-xs btn-primary")->href("{$url}/sc/sales-info/" . $type[$o->type] . "?preview=1")->html("SC")->target("_blank");
 */
        });
        $table->add("Title[EN]", "title_en")->sortable()->searchable();
        $table->add("Title[TC]", "title_tc")->sortable()->searchable();
        $table->add("Title[SC]", "title_sc")->sortable()->searchable();

        $table->add("Created Time", "created_time");
        $table->add("Created By", "created_by");
        $table->add("Updated Time", "updated_time");
        $table->add("Updated By", "updated_by");

        $options = [];
        foreach (Updates::STATUS as $i => $status) {
            $options[] = [
                "text" => $status,
                "value" => $i
            ];
        }
        $table->add("Status", "status")->sortable()->filterable($options);

        $this->table = $table;
    }

    public function ds(VX $vx)
    {
        $obj = $vx->Object();
        $rt = $vx->ui->createTableResponse();
        $rt->setData(Updates::Query());


        $rt->setDataMap(function (Updates $o) {

            $o->status = $o->status();
            $o->created_by= (string)$o->CreatedBy();
            $o->updated_by= (string)$o->UpdatedBy();
            
            $url = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"];
            $type = Updates::TYPE;
            $type[$o->type] = str_replace(" ", "+", strtolower($type[$o->type]));
            
            $o->preview_url = [
                "en" => "{$url}/en/sales-info/" . $type[$o->type] . "?preview=1",
                "sc" => "{$url}/sc/sales-info/" . $type[$o->type] . "?preview=1",
                "tc" => "{$url}/tc/sales-info/" . $type[$o->type] . "?preview=1",
            ];
            
            $o->type = $o->type();
            return $o;
        });



        return $rt;
    }
};
