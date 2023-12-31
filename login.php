<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/register.css">
    <title>Đăng nhập</title>
</head>

<body>
    <?php    
            if (isset($_POST['email'])){
                $conn = mysqli_connect('localhost', 'root', '', 'mnm2023');
                if(!$conn){
                    die("Không thể kết nối ".mysqli_connect_error());
                }

                $pw = $_POST['password'];
                $email = $_POST['email'];                
                $sql = "select * from users where email = '$email' and password = '$pw'";

                $row = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($row);
                
                if($count == 1){
                    session_start();    
                    $_SESSION['email'] = $email;
                    $_SESSION['tb'] = "Đăng nhập thành công!";
                    header('Location: index.php');   
                    exit();         
                }else{            
                    $_SESSION['error'] = "Tài khoản không chính xác!";                      
                }
            }
    ?>

    <div class="main">

        <form action="" method="POST" class="form" id="form-1">
            <h3 class="heading">Đăng nhập</h3>   
            
            <div style="color: red; font-size:medium;"> 
                <?php 
                    if(isset($_SESSION['error'])){
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }                    
                ?> 
            </div>         

            <div class="spacer"></div>

            <!-- <div class="form-group">
                <label for="fullname" class="form-label">Tên đầy đủ</label>
                <input id="fullname" name="fullname" type="text" placeholder="VD: Sơn Đặng" class="form-control">
                <span class="form-message"></span>
            </div> -->

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

            <!-- <div class="form-group">
                <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                <input id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu"
                    type="password" class="form-control">
                <span class="form-message"></span>
            </div> -->

            <!-- <button class="form-submit">Đăng nhập</button> -->

            <input class="form-submit" type="submit" value="Đăng nhập" />
            <div class="spacer"></div>

            <div class="form-group">
                <label for="password" class="form-label">Bạn chưa có tài khoản?
                    <a href="register.php"><i class="fa fa-key"></i>Đăng ký</a></label>
                
                <!-- <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control"> -->
                <span class="form-message"></span>
            </div>
        </form>       

    </div>
    <script src="./assets/js/register.js"></script>
    <!-- <script>
        Validator({
            form: '#form-1',
            rules: [
                // Validator.isRequired('#fullname'),
                Validator.isRequired('#email'),
                Validator.isEmail('#email'),
                Validator.isRequired('#password'),
                Validator.minLength('#password'),
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