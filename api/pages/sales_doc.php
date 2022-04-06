<?php

use Laminas\Db\Sql\Expression;
use PUXT\Context;

return new class
{
    public function get(Context $context)
    {
        $w = [];
        $sv_type = [
            0 => "sales brochure",
            1 => "price list",
            2 => "sales arrangements",
            3 => "tender documents",
            4 => "register of transactions",
            5 => "deed of mutual covenant",
            6 => "aerial photograph",
            7 => "sales brochure for parking spaces",
            8 => "price list for parking spaces",
            9 => "ballot result for parking spaces",
            10 => "agent corner",
            11 => "the books"
        ];

        $sv_locale = ["en", "tc", "sc"];
        $query_type = strtolower($context->query["type"]);
        $query_language = strtolower($context->query["locale"]);

        $res = array_search($query_language, $sv_locale);
        if ($res === false) return http_response_code(400);


        $res = array_search(str_replace("+", " ",  $query_type), $sv_type);
        if(!$res){
            $res = array_search(str_replace("-", " ",  $query_type), $sv_type);
        }
            
        if ($res === false) return [http_response_code(400)];
        $w["type"] = $res;

        if (intval($context->query["preview"])) $w["status"] = 0;
        else $w["status"] = 1;

        //                                                              DOCUMENTATION    ===>    https://docs.laminas.dev/laminas-db/sql/

        if ($res !== false) {
            $data = Updates::Query();
            $data->where($w);
            $data->order(["date" => "DESC", "sequence" => "DESC"]);
            //print_r($data->getSqlString());
            $data = $data->map(function (Updates $updates) use ($query_language, $query_type) {
                $updates->title = $updates->{"title_" . $query_language} ? $updates->{"title_" . $query_language} : $updates->title_en;
                $updates->file = $updates->{"file_" . $query_language} ? $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . "/uploads/" . $updates->{"file_" . $query_language} : $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . "/uploads/" . $updates->file_en;

                $result["date"] = $updates->date;
                $result["title"] = $updates->title;
                $result["file"] = $updates->file;

                $updates->url = $updates->{"file_" . $query_language} ? "/uploads/" . $updates->{"file_" . $query_language} : "/uploads/" . $updates->file_en;
                $result["url"] = $updates->url;
                
                $result["cover"] = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] ."/uploads/" . $updates->thumbnail;
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
