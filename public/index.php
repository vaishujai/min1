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
    static  public  function getRecords($filename)
    {
        $file = fopen($filename, "r");
        $fieldNames = array();
        $count = 0;

        while (!feof($file))
        {
            $record= fgetcsv($file);
            if ($count == 0)
            {
                $fieldNames = $record;
            }
            else

            {
                $records[] = recordFactory::create( $record);
            }
            $count++;
        }

        fclose($file);
        return $records;


    }
}
class record {
    public function __construct($record)
        print_r($records)
}
class recordFactory
{

    public static function create(, Array $values = null)
    {


        $record = new record();

        return $record;
    }

}