<?php
namespace app\controller;

class Index
{
    public function index()
    {
        return redirect(url('/Product'));
    }

}