<?php

$uploadsDir = "uploads/";
$contactsFile = "contacts.json";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $phone = filter_input(INPUT_POST,"phone", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if ($name && $email && $phone && isset($_FILES["image"])) {

    if (!is_dir($uploadsDir)) {
        mkdir($uploadsDir,0777, true);
    }
    $imageName = time() .".". basename($_FILES["image"]["name"]);
    $imagePath = $uploadsDir . $imageName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
        $contacts = file_exists($contactsFile) ? json_decode(file_get_contents($contactsFile)) : [];
    
    $contacts [] = [
        "id" => rand(100000000, 2000000000),
        "name" => $name,
        "email"=> $email,
        "phone"=> $phone,
        "image" => $imagePath
    ];

    file_put_contents($contactsFile, json_encode($contacts, JSON_PRETTY_PRINT));

    echo "Contact Added: $name ($email, $phone)";
    } else {
        echo "Image upload failed";
    }
  } else {
    echo "Invalid Input!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="POST" enctype="multipart/form-data">
    <label htmlFor="name">Name:</label>
    <input type="text" name="name"/>
    
    <label htmlFor="email">Email:</label>
    <input type="email" name="email"/>

    <label htmlFor="phone">Phone:</label>
    <input type="text" name="phone"/>
    
    <label htmlFor="image">Contact Image:</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit">Add Contact</button>
  </form>
  <a href="/">Back</a>
</body>
</html>