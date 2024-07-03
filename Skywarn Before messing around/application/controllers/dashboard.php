<?php

class Dashboard extends Controller {
    function index()
    {
        echo "You are signed into the dashboard as " . $this->session->userdata('email') . ". <br />";
        echo "Your UserType is " . $this->session->userdata('userType') . ".";
    }
}