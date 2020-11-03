<?php
//Redirection simple
function redirect($page)
{
    return header('location: ' . URLROOT . '/' . $page);
}
