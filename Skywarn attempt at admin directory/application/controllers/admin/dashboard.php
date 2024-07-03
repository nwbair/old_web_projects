<?php

class Dashboard extends Controller {
    function index()
    {
        $this->load->view('admin/dashboard');
    }
}