<?php

use PUXT\Context;

return new class
{
    public function get(Context $context)
    {
        $arr["lastUpdate"] = Config::Query()->where("name = 'lastUpdate'")->first()->value;

        $sv_locale = ["en", "tc", "sc"];
        $query_language = strtolower($context->query["locale"]);
        $res = array_search($query_language, $sv_locale);
        
        $data["date"] = ($query_language == "en") ? date("j F Y", strtotime(reset($arr))) :  date("Y年n月j日", strtotime(reset($arr)));
        if ($res === false) return $data; 

        $arr["updated_time"] = Updates::Query()->where("status = 1")->order(["updated_time" => "DESC"])->first()->updated_time;
        $arr["created_time"] = Updates::Query()->where("status = 1")->order(["created_time" => "DESC"])->first()->created_time;
        arsort($arr);
        

        $data["date"] = ($query_language == "en") ? date("j F Y", strtotime(reset($arr))) :  date("Y年n月j日", strtotime(reset($arr)));

        return $data ?? [];
    }  
};
