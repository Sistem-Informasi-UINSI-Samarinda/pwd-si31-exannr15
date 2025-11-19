<?php 
session_start();
include '../../config/koneksi.php';
?>







<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
<?php 
if(isset($_POST['login'])){
    $input = $_POST['username'];
    $password = $_POST['password'];

    // cek inpuT ke database

if(filter_var($input,FILTER_VALIDATE_EMAIL)){
    $query = "SELECT * FROM users WHERE email ='$input'";
    } else{
    $query = "SELECT * FROM users WHERE username = $input'";
    }
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result)> 0) {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password,$row['password'])){
            $_SESSION[ 'user_id'] = $row['id'];
            $_SESSION[ 'nama_lengkap'] = $row['nama_lengkap'];
            $_SESSION[ 'username'] = $row['username'];

            header("location; dashboard.php");
            exit();

 }
 else {
    echo"<p style=colorr:red'> username/email tidak sesuai/p>" ;
}
}
else {
    echo"<p style=colorr:red'> username/email tidak sesuai/p>" ;
}
}
?>


    <form method= "post" action="">
        <label for= Username atau email></label>
        <input type="text" name= "username" placeholder= "masukkan username email" required> <br>

        <label>password</label>
    <input type="password"name= "password" placeholder= "masukkan password" required> <br>

    <button type="submit">login</button>
    </form>
</body>
</html>