<?php

use PUXT\Context;

return new class
{
    public function get(Context $context)
    {
        $sv_locale = ["en", "tc", "sc"];
        $query_language = $context->query["locale"];
        $res = array_search($query_language, $sv_locale);
        if ($res === false) return http_response_code(400);



        $arr["updated_time"] = Updates::Query()->where("status = 1")->order(["updated_time" => "DESC"])->first()->updated_time;
        $arr["created_time"] = Updates::Query()->where("status = 1")->order(["created_time" => "DESC"])->first()->created_time;
        $arr["lastUpdate"] = Config::Query()->where("name = 'lastUpdate'")->first()->value;
        arsort($arr);

        $date = reset($arr);

        $data["date"] = ($query_language == "en") ? date("j F Y", strtotime($date)) :  date("Y年n月j日", strtotime($date));


        return $data ?? [];
    }

    public function post()
    {
        //return ["test"];
    }
};
