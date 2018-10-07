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
        pageLayout::htmlPage($table);


    }
}


class pageLayout
{
    public static function htmlPage($page)
    {   $html = '<html>';

        $html .= '<head><link rel="stylesheet" type="text/css"
                    href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/></head>';
        $html .= '<body>';
        // $html .= '<table>';
        $html .= '<table class = "table table-striped">';
        $html .= $page;
        $html .= '</table></body></html>';
        print $html;
    }
}



class html
{
    public static function generateTable($records)
    {
        //  print_r($records);
        $out = '';
        $count = 0;
        // echo '<table border= "1" width="100%">';
        foreach ($records as $record) {

            //  echo '<table border= "1" width="100%">';
            if ($count == 0) {
                $array = $record->returnArray();
                $fields = array_keys($array);



                $values = array_values($array);

                $out .='<thead><body><tr>' ;
              //  $out .= '<body>';
              //  $out .= '<tr>';
                foreach ($fields as $field)
                {
                    $out .= '<th width="(100/x)%">' . $field . '</th>';
                }

                $out .= '</tr></thead>';
              //  $out .= '</thead>';

                $out .= '<tr>';
                foreach ($values as $value)
                {
                    $out .= '<td width="(100/x)%">' . $value . '</td>';
                }
                $out .='</tr></body>';
              //  $out .= '</body>';

            }

            else {
                $array = $record->returnArray();

                $values = array_values($array);
                $out .= '<body>';
                $out .= '<tr>';
                foreach ($values as $value) {
                    $out .= '<td width="(100/x)%">' . $value . '</td>';
                }
                $out .= '</tr>';
                $out .= '</body>';

            } $count++;

            // echo '</table>';
            //return $out;

        }
        // $out .= '</table>';
        return $out;
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