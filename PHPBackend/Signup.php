<?php
    session_start();
    include_once "../Connect/Connection.php";
    $conn = connection();

    $access = "Pending";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $suffix = mysqli_real_escape_string($conn, $_POST['suffix']);       //Getting Inputs For Admin Residents data
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);  
    // $pwd = mysqli_real_escape_string($conn, $_POST['pwd']); 
    $phonenum = mysqli_real_escape_string($conn, $_POST['phonenum']);         
    $block = mysqli_real_escape_string($conn, $_POST['block']);
    $lot = mysqli_real_escape_string($conn, $_POST['lot']);
    
    // $GrdnName = mysqli_real_escape_string($conn, $_POST['GrdnName']);
    // $GrdnNumber = mysqli_real_escape_string($conn, $_POST['GrdnNumber']);
    // $GrdnRelship = mysqli_real_escape_string($conn, $_POST['GrdnRelship']);   //Getting Emergency contacts
    // $GrdnAdress = mysqli_real_escape_string($conn, $_POST['GrdnAdress']);  
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = "user";             //Getting Inputs for accounts
  
    
    function isGmailOrYahoo($email) {
        // Extracting domain part from the email address
        $domain = substr(strrchr($email, "@"), 1);
        
        // List of allowed domains (Gmail and Yahoo)
        $allowedDomains = ["gmail.com", "yahoo.com"];
    
        // Checking if the domain is in the allowed domains list
        return in_array($domain, $allowedDomains);
    }

    if(!empty($access) && !empty($fname) && !empty($mname) && !empty($lname) && !empty($gender) && !empty($age) && !empty($phonenum) && !empty($block) &&  !empty($lot) && !empty($email) && !empty($password) && !empty($role)){

        if(!isGmailOrYahoo($email)) {
            echo "Only Yahoo or Gmail can be used.";
            exit();
        }

            //checking the email if valid 
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){

                //checking if existing in database yung email
                $sql = mysqli_query($conn, "SELECT * FROM tblaccounts WHERE email = '{$email}'");
                if(mysqli_num_rows($sql) > 0){ 
                    echo "$email - This email already exist!"; //hanggang dito
                }else{

                    // checking if the user ba upload file or hinde
                    if(isset($_FILES['image'])){
                        $img_name = $_FILES['image']['name'];            // getting user uploaded img name
                        $img_type = $_FILES['image']['type'];            // img type na binigay ni user
                        $tmp_name = $_FILES['image']['tmp_name'];        // tmp name /temporary name for save/move file to folder
                        
                        // image explode to get the extension (jpeg png jpg)
                        $img_explode = explode('.',$img_name);      
                        $img_ext = end($img_explode);                    // dito na makukuha kung ano bang type yung nilagay ni user
        
                        $extensions = ["jpeg", "png", "jpg"];   //eto yung mga pwede lang na extension tapos lagay sa array

                        if(in_array($img_ext, $extensions) === true){
                            $types = ["image/jpeg", "image/jpg", "image/png"];

                            if(in_array($img_type, $types) === true){
                                $time = time();                             //eto yung magbibigay ng current time  
                                $new_img_name = $time.$img_name;            // ang ipapangalan sa file

                                if(move_uploaded_file($tmp_name,"../Pictures/".$new_img_name)){      //if nagupload na si user lilipat na si file sa specific folder
                                    $ran_id = rand(time(), 100000000);                          // random id para kay user
                                    $status = "Pending";                 //kapag nagsign in na si user maga active na to
                                    $encrypt_pass = md5($password);         // naka md5 para 

                                    //insert na ang data ni user para sa resident data
                                    $insert_query_data = mysqli_query($conn, "INSERT INTO tblresident (access, first_name, middle_name, last_name, suffix, sex, age, phone_number, block, lot)
                                    VALUES ('{$access}','{$fname}', '{$mname}', '{$lname}', '{$suffix}', '{$gender}', '{$age}', '{$phonenum}', '{$block}', '{$lot}')");
                                    

                                    //eto naman ay para sa kanilang account
                                    $insert_query_account = mysqli_query($conn, "INSERT INTO tblaccounts (unique_id, email, password, img, status, role, access)
                                    VALUES ({$ran_id}, '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}', '{$role}', '{$access}')");


                                    if($insert_query_account){
                                        $select_sql2 = mysqli_query($conn, "SELECT * FROM tblaccounts WHERE email = '{$email}'");

                                        if(mysqli_num_rows($select_sql2) > 0){  
                                            $result = mysqli_fetch_assoc($select_sql2);
                                            $_SESSION['unique_id'] = $result['unique_id'];
                                            echo "success";
                                        }else{
                                            echo "This email address not Exist!";
                                        }
                                    }else{
                                        echo "Something went wrong. Please try again!";
                                    }
                                }
                            }else{
                                echo "Please upload an image file - jpeg, png, jpg";
                            }
                        }else{
                            echo "Please upload an image file - jpeg, png, jpg";
                        }
                    }
                }
            }else{
                echo "$email is not a valid email!";
            }
        }else{
            echo "All input fields are required!";
        }
?>