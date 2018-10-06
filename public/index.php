<?php
/**
 * Created by PhpStorm.
 * User: vaishnavi
 * Date: 10/2/18
 * Time: 7:31 PM
 */
main::start( );

class main
{
    static public function start(){
        $file = fopen("example.csv","r");

        while(! feof($file))
        {
            print_r(fgetcsv($file));
        }

        fclose($file);
    }
}