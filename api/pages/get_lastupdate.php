<?php

use PUXT\Context;

return new class
{
    public function get(Context $context)
    {        
     /*    if ($language = $this->_query["locale"]) {
            if (!$data["date"] = ($language == "en") ? App\Core\SystemValue::_("lastUpdate", "en")->value : App\Core\SystemValue::_("lastUpdate", "zh-hk")->value) {
                if ($u = Updates::First("status = 1", "updated_time desc , created_time desc")) {
                    if ($u->updated_time) {
                        $data["date"] = ($language == "en") ? date("j F Y", strtotime($u->updated_time)) :  date("Y年n月j日", strtotime($u->updated_time));
                    } else {
                        $data["date"] =  ($language == "en") ? date("j F Y", strtotime($u->created_time)) :  date("Y年n月j日", strtotime($u->created_time));
                    }
                }
            }
        } */

        return $data ?? [];
    }

    public function post()
    {
        //return ["test"];
    }
};
