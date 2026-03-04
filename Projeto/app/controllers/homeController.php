<?php
require_once "controller.php";

class Homecontroller extends Controller
{
    public function index()
    {
        $this->render("home/index");
    }
}

?>