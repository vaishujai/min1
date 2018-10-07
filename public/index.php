<?php
/**

 */
main::start(  "example.csv");

class main
{
    static public function start($filename)
    {
        $records = csv::getRecords($filename);
        $table = html::generateTable($records);

        echo $table;

    }
}




class html
{
    public static function generateTable($records)
    {
        //  print_r($records);
        $count = 0;
        echo '<table border= "1" width="100%">';
        foreach ($records as $record) {

            //  echo '<table border= "1" width="100%">';
            if ($count == 0) {
                $array = $record->returnArray();
                $fields = array_keys($array);
                $values = array_values($array);

                echo '<thead>';
                echo '<tr>';
                foreach ($fields as $field) {
                    echo '<th width="(100/x)%">' . $field . '</th>';
                }

                echo '</tr>';
                echo '</thead>';

                echo '<tr>';
                foreach ($values as $value) {
                    echo '<td width="(100/x)%">' . $value . '</td>';
                }
                echo '</tr>';

            } else {
                $array = $record->returnArray();

                $values = array_values($array);

                echo '<tr>';
                foreach ($values as $value) {
                    echo '<td width="(100/x)%">' . $value . '</td>';
                }
                echo '</tr>';


            }
            $count++;

            // echo '</table>';

        }
        echo '</table>';
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
                $records[] = recordFactory::create($fieldNames, $record);
            }
            $count++;
        }

        fclose($file);
        return $records;

    }
}

class record {
    public function __construct(Array $fieldNames = null, $values = null)
    {
        $record = array_combine($fieldNames, $values);
        foreach ($record as $property => $value) {
            $this->createProperty($property, $value);

        }

    }
    public function returnArray()
    { $array = (array) $this;

        // print_r($this);
        return $array;

    }



    public function createProperty($name = 'first', $value = 'Monica') {
        $this->{$name} = $value;
    }
}

class recordFactory {

    public static function create(Array $fieldNames = null, Array $values = null)
    {



        $record = new record($fieldNames, $values);

        return $record;
    }
}