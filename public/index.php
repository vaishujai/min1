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
    static public function getRecords($filename)
    {
        $file = fopen($filename, "r");
        $fieldNames = array();
        $count = 0;

        while (!feof($file)) {
            $record = fgetcsv($file);
            if ($count == 0) {
                $fieldNames = $record;
            } else {
                $records[] = recordFactory::create($fieldNames, $record);
            }
            $count++;
        }

        fclose($file);
        return $records;


    }
}
class record {

}
class recordFactory
{

    public static function create(Array $array=null)
    {


        $record = new record();

        return $record;
    }

}