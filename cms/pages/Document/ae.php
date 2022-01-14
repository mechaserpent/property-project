{{form|raw}}
<?php

/**
 * Created by: Raymond Chong
 * Date: 2021-07-07 
 */
return new class
{
    function post(VX $vx)
    {

        outp($vx->_post);
        //$obj=$vx->object();


    }

    function get(VX $vx)
    {
        $form = $vx->ui->createForm();
        $form->add("Name")->input("name")->required();
        //$form->setAction();

        $this->form = $form;
    }
    
};
