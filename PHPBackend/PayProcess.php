<?php
// session_start();
// include_once "../Connect/Connection.php";
// $conn = connection();

// // $total = mysqli_real_escape_string($conn, $_POST['total']);
// $pay = mysqli_real_escape_string($conn, $_POST['pay']);
// // $proof = mysqli_real_escape_string($conn, $_POST['proof']);

// if(!empty($pay)){

//   // $sql2 = mysqli_query($conn, "SELECT * FROM payments");

//   if (isset($_FILES['proof']) && !empty($_FILES['proof']['tmp_name'][0])) {
//     $errors = [];

//     $num_uploaded_images = count($_FILES['proof']['tmp_name']);
//           // if($num_uploaded_images > 1) {
//           //     echo "You can upload up to 1 image only.";
              
//           // }if ($num_uploaded_images == 0) {
//           //     echo "You need to present a screenshot of payment";
//           // }

//         foreach($_FILES['proof']['tmp_name'] as $key => $tmp_name) {
//           $img_name = $_FILES['proof']['name'][$key];            // getting user uploaded img name
//           $img_type = $_FILES['proof']['type'][$key];            // img type na binigay ni user
//           $tmp_name = $_FILES['proof']['tmp_name'][$key]; // tmp name temporary name for save/move file to folder
                
//           $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION)); 
//           $extensions = ["jpeg", "png", "jpg"];   

//           if($img_ext === 'mp4') {
//             $errors[] = "MP4 is not supported for file: $img_name";
//             continue;
//           } else {
  
//             if(in_array($img_ext, $extensions) === true){
//               $types = ["image/jpeg", "image/jpg", "image/png"];

//               if(in_array($img_type, $types) === true){                          
//                 $new_img_name = $_FILES['proof']['name'][$key]; // Use original filename
//                 if(move_uploaded_file($tmp_name,"../Pictures/".$new_img_name)){
//                   $image_names[] = $new_img_name;
              
//                 } else {
//                   $errors[] = "Failed to move uploaded file: $img_name";
//                 }
//               } else {
//                 $errors[] = "Please upload an image file - jpeg, png, jpg for file: $img_name";
//               }
//             } else {
//               $errors[] = "Please upload an image file - jpeg, png, jpg for file: $img_name";
//             }
//           }
//         }
//       foreach($errors as $message) {
//         echo "$message<br>";
//       }              

//       // if(count($image_names) == 1) {
//         $img_column_value = implode(',', $image_names);
//         $insert_payment = mysqli_query($conn, "INSERT INTO payments (money, proof) VALUES ('{$pay}', '{$img_column_value}')");

//           if($insert_payment) {
//             echo "success";
//           } else {
//             echo "Error inserting payment with images: " . mysqli_error($conn);
//           }
//         // } else {
//         //   echo "You can upload up to 1 image only.";
    
//         // }
//   }
// }else{
//   echo "All input is required!";
// }



error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include_once "../Connect/Connection.php";
$conn = connection();

$pay = isset($_POST['pay']) ? mysqli_real_escape_string($conn, $_POST['pay']) : '';

if(!empty($pay)) {
    $errors = [];
    $image_names = [];

    var_dump($_FILES); // Add this line to check the contents of $_FILES array

    if (isset($_FILES['proof']) && !empty($_FILES['proof']['tmp_name'][0])) {
        foreach($_FILES['proof']['tmp_name'] as $key => $tmp_name) {
            $img_name = $_FILES['proof']['name'][$key];
            $img_type = $_FILES['proof']['type'][$key];
            $tmp_name = $_FILES['proof']['tmp_name'][$key];
            
            $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION)); 
            $extensions = ["jpeg", "png", "jpg"];   

            if(in_array($img_ext, $extensions)) {
                $types = ["image/jpeg", "image/jpg", "image/png"];

                if(in_array($img_type, $types)) {                          
                    $new_img_name = $_FILES['proof']['name'][$key];
                    if(move_uploaded_file($tmp_name,"../Pictures/".$new_img_name)){
                        $image_names[] = $new_img_name;
                    } else {
                        $errors[] = "Failed to move uploaded file: $img_name";
                    }
                } else {
                    $errors[] = "Please upload an image file - jpeg, png, jpg for file: $img_name";
                }
            } else {
                $errors[] = "Please upload an image file - jpeg, png, jpg for file: $img_name";
            }
        }

        foreach($errors as $message) {
            echo "$message<br>";
        }              

        if(count($image_names) == 1) {
            $img_column_value = implode(',', $image_names);
            $insert_payment = mysqli_query($conn, "INSERT INTO payments (first_name, middle_name, last_name, month_due, water_bill, due_date, overdue, money, proof) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{$pay}', '{$img_column_value}')");

            if($insert_payment) {
                echo "success";
            } else {
                echo "Error inserting payment with images: " . mysqli_error($conn);
            }
        } else {
            echo "You can upload up to 1 image only.";
        }
    } else {
        echo "No files uploaded.";
    }
} else {
    echo "Payment amount is required!";
}
?>




