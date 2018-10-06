<?php
/**

 */
main::start(  "example.csv");

class main
{


    static public function start()
    {
        $file = fopen("example.csv","r");
        while(! feof($file))
        {
            $record = fgetcsv($file);
            $records[]= $record;

        }
        fclose($file);
        print_r($record);
    }

}


