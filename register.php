<?php
    if (isset($_POST['fullname'])){
        $conn = mysqli_connect('localhost', 'root', '', 'mnm2023');
        if(!$conn){
            die("Không thể kết nối ".mysqli_connect_error());
        }

        $name = $_POST['fullname'];
        $pw = $_POST['password'];
        $email = $_POST['email'];
        //$sql = "insert into users (fullName, pw, email) value ($name, $pw, $email)";

        mysqli_query($conn, "insert into users (fullName, password, email) value ('$name', '$pw', '$email')");
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/register.css">
    <title>Đăng ký</title>
</head>

<body>
    <div class="main">

        <form action="" method="post" class="form" id="form-1">
            <h3 class="heading">Đăng ký</h3>            

            <!-- <div class="spacer"></div> -->

            <div class="form-group">
                <label for="fullname" class="form-label">Tên đầy đủ</label>
                <input id="fullname" name="fullname" type="text" placeholder="VD: Nguyễn Văn A" class="form-control">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" type="text" placeholder="VD: email@domain.com" class="form-control">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu</label>
                <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                <input id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu"
                    type="password" class="form-control">
                <span class="form-message"></span>
            </div>

            <input class="form-submit" type="submit" value="Đăng ký" />

            <!-- <button class="form-submit">Đăng ký</button> -->
        </form>

    </div>
    <script src="./assets/js/register.js"></script>
    <!-- <script>
        Validator({
            form: '#form-1',
            rules: [
                Validator.isRequired('#fullname'),
                Validator.isRequired('#email'),
                Validator.isEmail('#email'),
                Validator.isRequired('#password'),
                //Validator.minLength('#password'),
                Validator.isRequired('#password_confirmation'),
                Validator.isConfirm('#password_confirmation', function(){
                    return document.querySelector('#form-1 #password').value;
                })
            ],

            onSubmit: function(data){
                console.log(data);
            }
        });
    </script>  -->
</body>

</html>