# Tên đề tài
Website QL Ký Túc Xá
Nhóm: 17
## Hướng dẫn cài đặt
### Window
- Cài Xamp version 7.3.11 (php 7.3.11)
- Clone repo đặt trong thư mục C:/xampp/htdocs/website
- Tạo database mới và import file backup.sql trong folder createdb
- Đổi tên .env.example thành .env
- Sửa thông tin kết nối database
- Cài composer tại https://getcomposer.org/download/
- Mở command gõ composer install
- php artisan key:generate
- php artisan serve
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Database_name
DB_USERNAME=
DB_PASSWORD=
```
### Tài khoản test
```
Sinh viên: sv1@gmail.com - 123456
Cán bộ: cb1@gmail.com - 123456
Admin: admin@gmail.com - 123456
```
