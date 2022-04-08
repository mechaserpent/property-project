<?php

use PUXT\Context;

return new class
{
    public function get(Context $context)
    {
        
        $sv_locale = ["en", "tc", "sc"];
        $query_language = strtolower($context->query["locale"]);
        $res = array_search($query_language, $sv_locale);
        
        if ($res === false) return http_response_code(400);
        
        
        $arr["lastUpdate"] = Config::Query()->where("name = 'lastUpdate'")->first()->value;
        $arr["updated_time"] = Updates::Query()->where("status = 1")->order(["updated_time" => "DESC"])->first()->updated_time;
        $arr["created_time"] = Updates::Query()->where("status = 1")->order(["created_time" => "DESC"])->first()->created_time;
        arsort($arr);

        if(!reset($arr)) return "";

        $data["date"] = ($query_language == "en") ? date("j F Y", strtotime(reset($arr))) :  date("Y年n月j日", strtotime(reset($arr)));

        return $data;
    }
};
