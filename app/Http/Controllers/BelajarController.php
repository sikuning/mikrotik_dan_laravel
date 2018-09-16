<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mikrokit;
use PEAR2\Net\RouterOS;
use Response;

class BelajarController extends Controller
{
    private $client;
    public function __construct()
    {
        $this->client = new RouterOS\Client('<host>', '<user>', '<password>');
    }
    public function tes_koneksi()
    {
       // $conn = Mikrokit::connect(['192.168.88.1', 'admin', 'pingwatchsdog']);
       
    //dd($client);
    $responses =$this->client->sendSync(new RouterOS\Request('/ip/arp/print'));
  echo "<a href='/ping'> Klik Untuk Ping 192.168.1.1</a>";
    echo 'Ip Address setiap Interface :<br>';
foreach ($responses as $response) {
  echo'IP'.$response->getProperty('address');
 echo 'MAC: ', $response->getProperty('mac-address').'<br>';

    }
   echo 'Data Logs : <br>';
    $util = new RouterOS\Util($this->client);
    foreach ($util->setMenu('/log')->getAll() as $entry) {

        echo $entry('time') . ' ' . $entry('topics') . ' ' . $entry('message') . "<br>";
    }
}
public function ping()
{
    $pingRequest = new RouterOS\Request('/ping count=3');
    $results = $this->client->sendSync($pingRequest->setArgument('address','192.168.1.1'));
  
    foreach ($results as $result) {
        //Add whatever you want displayed in this section.
        echo '<li>Host'.$result('host').' Size'.$result('size').'</li>';
    } 
}
}
