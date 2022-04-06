<?php

use VX\Model;

class Updates extends Model
{
    const STATUS = ["Inactive", "Active", "Hide"];
    const TYPE = [
        0 => "Sales Brochure",
        1 => "Price List",
        2 => "Sales Arrangements",
        3 => "Tender Documents",
        4 => "Register of Transactions",
        5 => "Deed of Mutual Covenant",
        6 => "Aerial Photograph",
        7 => "Sales Brochure for Parking Spaces",
        8 => "Price List for Parking Spaces",
        9 => "Ballot Result for Parking Spaces",
        10 => "Agent Corner",
        11 => "The Books"    
    ];   
}
