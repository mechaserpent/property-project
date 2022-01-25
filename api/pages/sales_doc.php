<?php

use Laminas\Db\Sql\Expression;
use PUXT\Context;

return new class
{
    public function get(Context $context)
    {
        $w = [];
        $sv_type = [
            "sales brochure",
            "price list",
            "sales arrangements",
            "tender document",
            "register of transactions",
            "deed of mutual covenant",
            "aerial photograph",
            "sales brochure for parking spaces",
            "price list for parking spaces",
            "ballot result for parking spaces"

        ];
        $sv_locale = ["en", "tc", "sc"];
        $query_type = $context->query["type"];  //      $query_type = $this->_query["type"];
        $query_language = $context->query["locale"];

        $res = array_search($query_language, $sv_locale);

        if ($res === false) return http_response_code(400);

        $res = array_search(str_replace("+", " ",  strtolower($query_type)), $sv_type);
        if ($res === false) return http_response_code(400);
        $w[] = "type = $res";

        if (intval($context->query["preview"])) $w[] = "status = 0";
        else $w[] ="status = 1";

        //                                                              DOCUMENTATION    ===>    https://docs.laminas.dev/laminas-db/sql/

        if ($query_language) {
            $data = Updates::Query();
            $data->where($w);
            $data->order(["date" => "DESC", "sequence" => "DESC"]);
            //print_r($data->getSqlString());            
            //print_r($data->toArray());
            $data = $data->map(function (Updates $updates) use ($query_language, $query_type) {
                $updates->title = $updates->{"title_" . $query_language} ? $updates->{"title_" . $query_language} : $updates->title_en;
                $updates->file = $updates->{"file_" . $query_language} ? $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . "/uploads/" . $updates->{"file_" . $query_language} : $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . "/uploads/" . $updates->file_en;

                $result["date"] = $updates->date;
                $result["title"] = $updates->title;
                $result["file"] = $updates->file;

                return $result;
            });
        }

        return $data ?? [];
    }

    public function post()
    {
        //return ["test"];
    }
};
