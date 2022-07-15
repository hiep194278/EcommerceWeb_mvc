<?php

require_once ROOT . DS . 'library' . DS . 'Database.php';
require_once ROOT . DS . 'helpers' . DS . 'Format.php';

class BaseModel 
{
    protected $db;
    protected $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
}
