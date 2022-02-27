<?php 
   $students = file_get_contents('http://localhost:8090/api/v1/students') ;
   $students = json_decode($students);
   
    // var_dump($students);
    // exit(0);

// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value

    function CallAPI($method, $url, $data = false, $json = '')
    {
        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
                $headers = array(
                   "Accept: application/json",
                   "Content-Type: application/json",
                );
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_URL, $url);
                $headers = array(
                   "Accept: application/json",
                   "Content-Type: application/json",
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    function delete($id){
       CallAPI("DELETE", "http://localhost:8090/api/v1/students/".$id, $data = false);

        header("location:index.php");

    }

    function create($id, $name, $email, $dob){
        $form_data = [];
        $form_data["id"] = $id;
        $form_data["name"] = $name;
        $form_data["email"] = $email;
        $form_data["dob"] = $dob;

        $form_data = json_encode($form_data);
        CallAPI("POST", "http://localhost:8090/api/v1/students", $data = $form_data);

        header("location:index.php");
    }

    function update($id, $name, $email, $dob){
        $form_data = [];
        $form_data["id"] = $id;
        $form_data["name"] = $name;
        $form_data["email"] = $email;
        $form_data["dob"] = $dob;

        $form_data = json_encode($form_data);
        CallAPI("PUT", "http://localhost:8090/api/v1/students/".$id, $data = $form_data);

        header("location:index.php");
    }


?>