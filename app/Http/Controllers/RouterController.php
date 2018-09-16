<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouterController extends Controller
{
    public function __construct()
    {
       
    }
    public function tes_koneksi(Type $var = null)
    {
        $conn = Mikrokit::connect(['192.168.88.1', 'admin', 'pingwatchsdog']);
        if($conn->isConnected()) {
        dd('terkoneksi ');
        }

    }

}
