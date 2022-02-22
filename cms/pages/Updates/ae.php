{{form|raw}}

<?php

return new class
{
    function get(VX $vx)
    {     
        $form = $vx->ui->createForm();

        $form->add("Date")->date("date")->required();
        $form->add("Sequence")->inputNumber("sequence");

        $form->add("Status")->select("status", Updates::STATUS);
        $form->add("Type")->select("type", Updates::TYPE);


        $form->add("Title[EN]")->input("title_en")->required();
        $form->add("Title[TC]")->input("title_tc");
        $form->add("Title[SC]")->input("title_sc");


        $r = $form->add("File[EN]");
        $r->filemanager("file_en");
        $r->setAttribute("required",true);
        
        $form->add("File[TC]")->filemanager("file_tc");
        $form->add("File[SC]")->filemanager("file_sc");
        
        $form->add("Thumbnail")->filemanager("thumbnail");
        if ($vx->user->isAdmin()) {
            //$r = $form->add("CDN Link[EN]");
            //$r->input("link_en")->attr("onchange", "AddCDN(this)");
            //$r->helpBlock("** If you have only one CDN file, you just enter the CDN link on this field.<br/>
            //** System will automatically to show this CDN file on 3 languages of the page.");

            $form->add("CDN Link[EN]")->input("link_en");
            $form->add("CDN Link[TC]")->input("link_tc");
            $form->add("CDN Link[SC]")->input("link_sc");
        }
        $this->form = $form;
    }
};
