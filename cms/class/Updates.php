<?php

use VX\Model;

class Updates extends Model
{
    const STATUS = ["Inactive", "Active", "Hide"];
    const TYPE = [
        "Sales Brochure",
        "Price List",
        "Sales Arrangements",
        "Tender Document",
        "Register of Transactions",
        "Deed of Mutual Covenant",
        "Aerial Photograph",
        "Sales Brochure for Parking Spaces",
        "Price List for Parking Spaces",
        "Ballot Result for Parking Spaces"
    ];

    /*   public function Delete()
    {               
        if ($sv = self::$_app->system_value['en']['lastUpdate']) {

            $sv->value = date("j F Y");
            $sv->save();
            $sv = self::$_app->system_value['zh-hk']['lastUpdate'];
            $sv->value = date("Y年n月j日");
            $sv->save();
        }
        return parent::Delete();
    }

    public function Update()
    {
        if ($sv = self::$_app->system_value['en']['lastUpdate']) {

            $sv->value = date("j F Y");
            $sv->save();
            $sv = self::$_app->system_value['zh-hk']['lastUpdate'];
            $sv->value = date("Y年n月j日");
            $sv->save();
        }
        return parent::Update();
    } */
}
