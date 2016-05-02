<?php

namespace App\Http\Controllers\Shared;

/**
 * Created by PhpStorm.
 * User: TOAN
 * Date: 01/05/2016
 * Time: 1:21 CH
 */
class Constants
{
    public static $paging_number = 8;

    // format message
    public static $number_result_search = 'Có %d bản ghi';
    public static $msg_insert_successfully = 'Thêm mới %s thành công';
    public static $msg_delete_successfully = 'Xóa %s thành công';
    public static $msg_edit_successfully = 'Sửa %s thành công';

    // Error message
    public static $error_related_delete = "Xóa thất bại do có liên quan đến bảng khác!";

    // table name
    public static $tbl_thanhpho = "tỉnh, thành phố";
    public static $tbl_loaixe = "loại xe";
    public static $tbl_tintuc = "tin tức";
    public static $tbl_loaitin = "loại tin";
    public static $tbl_taikhoan = "tài khoản";
    public static $tbl_tindang = "tin đăng";

    // Admin account
    public static $admin_email = 'admin@taixe.com';

    // Session flash name
    public static $flash_error = "flash_error";
    public static $flash_success = "flash_success";

    // Tên các loại tin
    public  static $tin_tim_xe = "Tìm xe";
    public  static $tin_tim_khach = "Tìm khách";
    public  static $tin_dich_vu = "Dịch vụ";
}