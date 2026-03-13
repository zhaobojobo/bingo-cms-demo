<?php


namespace Admin\Controllers;


class ErrorController extends BaseController
{
    public function error403()
    {
        return $this->render('error/403');
    }

    public function errorBanned()
    {
        return $this->render('error/banned');
    }
}