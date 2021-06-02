<?php
class Model
{

    public function put_contacts($fistName = '', $lastName = '', $email = '', $message = '')
    {
        $fileName = 'contacts.json';
        $datos_clientes = file_get_contents($fileName);
        $json_clientes = json_decode($datos_clientes, true);
        $nObj = 0;
        foreach ($json_clientes as $row) {

            $arrayContacts[$nObj] = array('fistName' => $row['fistName'],
                'lastName' => $row['lastName'],
                'email' => $row['email'],
                'message' => $message,
            );

            $nObj++;
        }

        if ($nObj === 0) {
            $arrayContacts[$nObj] = array('fistName' => strtoupper($fistName),
                'lastName' => strtoupper($lastName),
                'email' => $email,
                'message' => $message,
            );
        } else {
            $arrayNew = array('fistName' => strtoupper($fistName),
                'lastName' => strtoupper($lastName),
                'email' => $email,
                'message' => $message,
            );
        }

        if (@!in_array($arrayNew, $arrayContacts)) {
            @array_push($arrayContacts, $arrayNew);

            echo "<div class='col-md-8 alert alert-success'>New contact added</div><br/>";

        } else {
            echo "<div class='col-md-8 alert alert-danger'>Warning! existing contact.</div><br/>";
        }

        $json_string = json_encode($arrayContacts);

        if (file_put_contents($fileName, $json_string)) {
            echo "<div class='col-md-8 alert alert-warning'>Processed finished!</div><hr/>";
        }
    }

    public function input_post($data = '')
    {
        return @$_POST[$data];
    }

    public function input_get($data = '')
    {
        return @$_GET[$data];
    }

    public function get_contacts($post = '')
    {
        //parent::input_get();
        $filter_param = $post;
        $fileName = 'contacts.json';
        $datos_clientes = file_get_contents($fileName);
        $json_clientes = json_decode($datos_clientes, true);
        echo "<div class='col-md-8'><form method='post'><table class='table'>";
        echo "<thead>";
        echo "<th>Fist Name </th>";
        echo "<th>Last Name </th>";
        echo "<th>Email </th>";
        echo "<th>Message </th>";
        echo "</thead>";
        echo "<tbody>";
        ///variable array que guarda los duplicados.
        $duplicates = array('lastName' => null, 'fistName' => null);
        if (count($json_clientes) > 0) {
            foreach ($json_clientes as $row) {
                if (!is_null($row['fistName'])) {

                    switch ($filter_param) {
                        case 'true':
                            if (in_array(array('lastName' => $row['lastName'], 'fistName' => $row['fistName']), $duplicates)) {
                                echo "<tr class='bg-danger'>";
                                echo "<td><input type='checkbox' name='contacts' value='" . $row['email'] . "'> " . $row['fistName'] . "</td>";
                                echo "<td>" . $row['lastName'] . "</td>";
                                echo "<td>" . $row['email'] . " <strong class='text-black badge badge-warning'>Duplicado</strong></td>";
                                echo "</tr>";
                            } else {
                                echo "<tr>";
                                echo "<td><input type='checkbox' name='contacts' value='null'> " . $row['fistName'] . "</td>";
                                echo "<td>" . $row['lastName'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "</tr>";

                                array_push($duplicates, array('lastName' => $row['lastName'], 'fistName' => $row['fistName']));
                            }
                            //inserta los rows de lista.

                            break;

                        default:
                            echo "<tr>";
                            echo "<td>" . $row['fistName'] . "</td>";
                            echo "<td>" . $row['lastName'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['message'] . "</td>";
                            echo "</tr>";
                            break;
                    }

                }

            }
        }
        echo "<tbody>";
        echo "<tfoor>";
        echo "<tr>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        if ($post === 'true') {
            echo "<td><button class='btn btn-warning pull-rigth' type='submit'>Unique contacts</button></td>";
        }

        echo "</tr>";
        echo "</tfoor>";
        echo "</table></form></div>";

        //var_dump($duplicates);

    }

    public function pull_set_duplicates($post = '')
    {

        if ($post != '') {
            $fileName = 'contacts.json';
            $datos_clientes = file_get_contents($fileName);
            $json_clientes = json_decode($datos_clientes, true);
            $nObj = 0;
            foreach ($json_clientes as $row) {

                if ($row['email'] != $post) {
                    $arrayContacts[$nObj] = array('fistName' => $row['fistName'],
                        'lastName' => $row['lastName'],
                        'email' => $row['email'],
                        'message' => $message,
                    );
                }

                $nObj++;
            }

            $json_string = json_encode($arrayContacts);

            file_put_contents($fileName, $json_string);
        }

    }

    public function get_all_duplicates()
    {
        echo "<a class='btn btn-primary' href='?duplicates=false'>Show posts </a><hr/>";
        return false;
    }

    public function refresh($time = 0, $page = '/last_test/index.php?duplicates=false')
    {
        header("Refresh: $time; url=$page");
    }

}
