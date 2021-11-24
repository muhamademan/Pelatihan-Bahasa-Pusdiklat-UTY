<?php

class Method_model extends CI_Model
{
    public function CekMethod($id_sert)
    {
        if ($id_sert == "1") {
            $method = "ept";
        } elseif ($id_sert == "2") {
            $method = "jpt";
        }

        return $method;
    }
}