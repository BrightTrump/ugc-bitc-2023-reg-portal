<?php
  $conn = new mysqli("localhost", "id21303150_2023ugcitc", "Trump1234@", "id21303150_brighttrump");
  if(!$conn){
      die("Could not connect to db". mysqli_connect_error());
  }

  //get users from database
  $get_users = $conn->query("SELECT * FROM users");

  $count = 0;
  
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
<style>
  #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  #customers tr:nth-child(even){background-color: #f2f2f2;}

  #customers tr:hover {background-color: #ddd;}

  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #04AA6D;
    color: white;
  }
  div.img{
    width: 200px;
    height: 100px;
  }

  div.img img{
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  /* Style the Image Used to Trigger the Modal */
  .myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
  }
  .myImg:hover {opacity: 0.7;}

  /* The Modal (background) */
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
  }

  /* Modal Content (Image) */
  .modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
  }

  /* Caption of Modal Image (Image Text) - Same Width as the Image */
  #caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
  }

  /* Add Animation - Zoom in the Modal */
  .modal-content, #caption {
    animation-name: zoom;
    animation-duration: 0.6s;
  }

  @keyframes zoom {
    from {transform:scale(0)}
    to {transform:scale(1)}
  }

  /* The Close Button */
  .close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
  }

  .close:hover,
  .close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
  }

  /* 100% Image Width on Smaller Screens */
  @media only screen and (max-width: 700px){
    .modal-content {
      width: 100%;
    }
  }
</style>
</head>
<body>

<h1>Admin Database</h1>

<div style="overflow-x: auto;">
  <table id="customers">
    <tr>
      <th>S/N</th>
      <th>Fullname</th>
      <th>Phone Number</th>
      <th>Email Address</th>
      <th>State Council</th>
      <th>Battalion/Group Council</th>
      <th>Company</th>
      <th>Rank</th>
      <th>D.O.B</th>
      <th>Marital Status</th>
      <th>Gender</th>
      <th>Course</th>
      <th>Proof of Payment</th>
    </tr>
    <?php
        if($get_users->num_rows > 0){
          while($row = $get_users->fetch_assoc()){
    ?>
    <tr>
      <td><?= ++$count; ?></td>
      <td><?= $row['fullname'] ?></td>
      <td><?= $row['tel'] ?></td>
      <td><?= $row['email'] ?></td>
      <td><?= $row['state_council'] ?></td>
      <td><?= $row['battalion_council'] ?></td>
      <td><?= $row['company'] ?></td>
      <td><?= $row['rank'] ?></td>
      <td><?= $row['birthday'] ?></td>
      <td><?= $row['marital_status'] ?></td>
      <td><?= $row['gender'] ?></td>
      <td><?= $row['course_type'] ?></td>
      <td>
        <div class="img">
          <img src="reg_client_images/<?= $row['proof_image'] ?>" class="myImg" alt="">
        </div>
      </td>
    </tr>
    <?php
            }
        }
    ?>
  </table>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var modalImg = document.getElementById("img01");
    $(".myImg").click(function(){
      console.log("working");
      modal.style.display = "block";
      modalImg.src = this.src;
    });

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
  });

</script>
</html>