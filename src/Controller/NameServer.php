<?php


namespace App\Controller;

use App\Entity\Server;

class NameServer{

    public function NameServer(Server $server)
    {
        $location = $server->getLocation()->getCode();

        $distribution = $server->getDistribution()->getCode();

        $random = rand(1, 500);

        $name = 'SC-'.$location. '-'. $distribution. '-' . $random;

        $server->setName($name);
    }
}