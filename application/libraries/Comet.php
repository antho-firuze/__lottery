<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "assets/jquery-simplecomet/simplecomet.class.php"; 
 
class Comet extends SimpleComet { 
    public function __construct() { 
        parent::__construct(); 
    } 
}