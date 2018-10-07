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
        //print_r($records);


        $count = 0;
        foreach ($records as $record) {
            /* if ($count == 0) {
                 $array = $record->returnArray();
                 $fields = array_keys($array);
                 $values = array_values($array);

                 //print_r($fields);
                 $count = 0; */
            echo '<table border="1">';
            if ($count == 0) {
                $array = $record->returnArray();
                $fields = array_keys($array);
                $values = array_values($array);
                // $html = '<html>';
                // $html = '<table>';

                // echo '<table border="1">';
                echo '<thead>' ;
                echo '<tr>';
                foreach ($fields as $field)
                {
                    echo '<th>' . $field . '</th>';
                }

                // echo "<tr><td>First</td><td>last</td><td>UCID</td><td>grade</td><td>no</td>";
                // $values = array_values($array);
                //  print_r($fields);
                echo '</tr>';
                echo '</thead>';

                echo '<tr>';
                foreach ($values as $value)
                {
                    echo '<td>' . $value . '</td>';
                }
                echo '</tr>';

            }  // print_r($values);

            else {
                $array = $record->returnArray();
                // $fields = array_keys($array);
                $values = array_values($array);
                //  echo "<tr><td>";

                echo '<tr>';
                foreach ($values as $value) {
                    echo '<td>' . $value . '</td>';
                }
                echo '</tr>';




            } $count++;
            // print_r($values);
            // echo '</body>';
            echo '</table>';

        }

    }


    /*   class html
       {

           public static function generateTable($records)
           {
               $count = 0;
               $html = '<html>';
               $html .= '<head>';
               $html .= '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">';

               $html .= '<body>';
               $html .= '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>';

               $html .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>';
               $html .= '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>';


               foreach ($records as $record) {
                   if ($count == 0) {
                       $array = $record->returnArray();
                       $fields = array_keys($array);
                       $values = array_values($array);

                       $array =  $record--;
                       $html .= '<table>';

                       $html .= '<tr>';

                       foreach ($fields as $field) {
                           $html .= '<th>' . $field . '</th>';


                       }
                       $html .= '</tr>';






                   } else {
                       $array = $record->returnArray();
                       $values = array_values($array);
                       $html .= '<tr>';
                       foreach ($values as $value) {
                           $html .= '<td>' . $value . '</td>';
                       }
                       $html .= '</tr>';

                       $html .= '</table>';
                       return $html;

                   } $count++;




               }

           }
       } */
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