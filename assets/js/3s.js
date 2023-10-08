// Hiển thị thông báo trong 3 giây và sau đó ẩn nó hoặc chuyển hướng
setTimeout(function() {
    var loginMessage = document.getElementById('loginMessage');
    if (loginMessage) {
        loginMessage.style.display = 'none'; // Ẩn thông báo
    }
    // Chuyển hướng sau khi hiển thị thông báo (nếu cần)
    //window.location.href = 'index.php'; // Thay 'index.php' bằng đường dẫn bạn muốn chuyển hướng
}, 3000); // 3 giây (3000 milliseconds)