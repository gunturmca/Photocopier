<?php
function belumlogin()
{
    $check = get_instance();
    if (!$check->session->userdata('id_pengguna')) {
        redirect("Login");
    }
}
