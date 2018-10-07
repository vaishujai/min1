
<?php
/*
 */
main::start("example.csv");
class main  {
    static public function start($filename) {
        $records = csv::getRecords($filename);
        $table = html::generateTable($records);
    }
}
class html
{
    public static function generateTable($records)
    {
       // print_r($records);
        $count = 0;
        foreach ($records as $record) {
            if ($count == 0) {
                $array = $record->returnArray();
                $fields = array_keys($array);
                $values = array_values($array);

                print_r($fields);
                $count = 0;

                if ($count == 0) {
                    $array = $record->returnArray();
                    $fields = array_keys($array);
                    echo '<table border="1">';
                    echo "<tr><td>First</td><td>last</td><td>UCID</td><td>grade</td><td>no</td>";

                    $values = array_values($array);
                    print_r($fields);
                    echo '<tr>';
                    foreach ($values as $value) {
                        echo '<td>' . $value . '</td>';
                    }
                    echo '</tr>';

                    print_r($values);

                } else {
                    $array = $record->returnArray();
                    $values = array_values($array);
                    //    echo "<tr><td>";
                    echo '<tr>';
                    foreach ($values as $value) {
                        echo '<td>' . $value . '</td>';
                    }
                    echo '</tr>';

                }
                echo '</table>';
                $count++;
            } // print_r($values);

            else {
                $array = $record->returnArray();

                $values = array_values($array);
                print_r($values);
            }
            $count++;
        }
    }
}


class csv {
    static public function getRecords($filename) {
        $file = fopen($filename,"r");
        $fieldNames = array();
        $count = 0;
        while(! feof($file))
        {
            $record = fgetcsv($file);
            if($count == 0) {
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
    public function __construct(Array $fieldNames = null, $values = null )
    {
        $record = array_combine($fieldNames, $values);
        foreach ($record as $property => $value) {
            $this->createProperty($property, $value);
        }
    }
    public function returnArray() {
        $array = (array) $this;
        return $array;
    }
    public function createProperty($name = 'first', $value = 'keith') {
        $this->{$name} = $value;
    }
}
class recordFactory {
    public static function create(Array $fieldNames = null, Array $values = null) {
        $record = new record($fieldNames, $values);
        return $record;
    }
}
