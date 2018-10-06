<?php
/**

 */
main::start(  "example.csv");

class main
{


   static  public function start($filename)
   {
       $records = csv::getRecords($filename);
       print_r($records);
   }

}

class csv
{
    static public function getRecords()
    {
        $file = fopen("example.csv","r");
        while(! feof($file))
        {
            $record = fgetcsv($file);
            $records[]= $record;

        }
        fclose($file);
       return $records;
    }


}
