# 🏗️ BAT - Quản Lý Dự Án

**BAT_QuanLyDuAn** là dự án nhỏ để thực hành bằng **Laravel**, dự án này nhằm quản lý các **dự án**, **nhiệm vụ (task)**, **thành viên**, và **phân quyền người dùng**.

---

## 🚀 Tính năng chính

-   Quản lý công việc
-   Quản lý người dùng
-   Phân quyền (Admin, người dùng thường)
-   Admin giao việc
-   Người dùng xem danh sách công việc của minh
-   Người dùng xem danh sách tất cả công việc

---

## 🛠️ Công nghệ sử dụng

| Thành phần        | Công nghệ       |
| ----------------- | --------------- |
| Framework Backend | Laravel 9.x     |
| CSDL              | MySQL / MariaDB |
| Authentication    | Laravel Sanctum |
| Quản lý package   | Composer        |

---

## ⚙️ Hướng dẫn cài đặt và chạy dự án

### 1️ Clone project

```bash
git clone https://github.com/<your-username>/BAT-QuanLyDuAn.git
cd BAT-QuanLyDuAn
```

### 2 Cài đặt thư viện PHP

```
composer install
```

### 3 Tạo file môi trường

```
cp .env.example .env
```

Sau đó, mở file .env và chỉnh thông tin kết nối database của bạn:

-   DB_DATABASE=BAT_QuanLyDuAn
-   DB_USERNAME=root
-   DB_PASSWORD=

### 4 Tạo database

```
Tạo database trống bat_quanlyduan trong MySQL (hoặc MariaDB).
```

### 5 Chạy migrate và seed data

```
php artisan migrate --seed
```

### 6 Chạy server

```
php artisan serve
```
