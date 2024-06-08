<?php 
session_start();
include_once "../Connect/Connection.php";
$conn = connection();


$start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
$start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
$end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
$end_time = mysqli_real_escape_string($conn, $_POST['end_time']);       //Getting Inputs For Admin Residents data
$title_name = mysqli_real_escape_string($conn, $_POST['title_name']);
$desc_name = mysqli_real_escape_string($conn, $_POST['description_name']);  


if(!empty($start_date) && !empty($start_time) && !empty($end_date) && !empty($end_time) && !empty($title_name) && !empty($desc_name)){

  if(strtotime($end_date) < strtotime($start_date)){
    echo "End date cannot precede start date.";
    exit;
  }

  $sql2 = mysqli_query($conn, "SELECT * FROM announcements WHERE title = '{$title_name}'");

    if(mysqli_num_rows($sql2) > 0){ 
      echo "This Announcement already exist!";
      exit;
    } else {

      $image_names = [];

      if (isset($_FILES['images']) && !empty($_FILES['images']['tmp_name'][0])) {
          $errors = [];

          $num_uploaded_images = count($_FILES['images']['tmp_name']);
          if($num_uploaded_images > 10) {
              echo "You can upload up to 10 images only.";
              exit;
          }
          

        foreach($_FILES['images']['tmp_name'] as $key => $tmp_name) {
          $img_name = $_FILES['images']['name'][$key];            // getting user uploaded img name
          $img_type = $_FILES['images']['type'][$key];            // img type na binigay ni user
          $tmp_name = $_FILES['images']['tmp_name'][$key]; // tmp name temporary name for save/move file to folder
                
          $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION)); 
          $extensions = ["jpeg", "png", "jpg"];   

          if($img_ext === 'mp4') {
            $errors[] = "MP4 is not supported for file: $img_name";
            continue;
          } else {
            
            if(in_array($img_ext, $extensions) === true){
              $types = ["image/jpeg", "image/jpg", "image/png"];

              if(in_array($img_type, $types) === true){                          
                $new_img_name = $_FILES['images']['name'][$key]; // Use original filename

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
        }
        foreach($errors as $message) {
          echo "$message<br>";
        }

        if(count($image_names) <= 10) {
        $img_column_value = implode(',', $image_names);
        $insert_query_announce = mysqli_query($conn, "INSERT INTO announcements (title, context, start_date, start_time, end_date, end_time, img) VALUES ('{$title_name}', '{$desc_name}', '{$start_date}', '{$start_time}', '{$end_date}', '{$end_time}', '{$img_column_value}')");

          if($insert_query_announce) {
            echo "success";
          } else {
            echo "Error inserting announcement with images: " . mysqli_error($conn);
          }
        } else {
          echo "You can upload up to 10 images only.";
        }
  
      } else {

        $insert_query_noImage = mysqli_query($conn, "INSERT INTO announcements (title, context, start_date, start_time, end_date, end_time) VALUES ('{$title_name}', '{$desc_name}', '{$start_date}', '{$start_time}', '{$end_date}', '{$end_time}')");
                   
          if ($insert_query_noImage) {
            echo "success";
          } else {
            echo "Error inserting announcement without images: " . mysqli_error($conn);
          }
      }
  }
}else{
  echo "All input is required!";
}
?>