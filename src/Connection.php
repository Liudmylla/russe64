<?php

namespace App;



use \PDO;



class Connection {



    public static function getPDO (): PDO

    {

        
        return new PDO('mysql:dbname=russe1364122;host=127.0.0.1', 'root', '', [
        // return new PDO('mysql:dbname=russe1364122;host=185.98.131.91', 'russe1364122', 'qifnea6sar', [

            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION

        ]);

    }

}