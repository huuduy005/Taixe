<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThanhphosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $province = [
                        ["tenTP" => "AnGiang"],
                        ["tenTP" => "BàRịa-VũngTàu"],
                        ["tenTP" => "BạcLiêu"],
                        ["tenTP" => "BắcKạn"],
                        ["tenTP" => "BắcGiang"],
                        ["tenTP" => "BắcNinh"],
                        ["tenTP" => "Bến Tre"],
                        ["tenTP" => "BìnhDương"],
                        ["tenTP" => "BìnhĐịnh"],
                        ["tenTP" => "BìnhPhước"],
                        ["tenTP" => "BìnhThuận"],
                        ["tenTP" => "Cà Mau"],
                        ["tenTP" => "Hải Dương"],
                        ["tenTP" => "Cao Bằng"],
                        ["tenTP" => "TP.CầnThơ"],
                        ["tenTP" => "TP.ĐàNẵng"],
                        ["tenTP" => "ĐắkLắk"],
                        ["tenTP" => "ĐắkNông"],
                        ["tenTP" => "ĐiệnBiên"],
                        ["tenTP" => "ĐồngNai"],
                        ["tenTP" => "ĐồngTháp"],
                        ["tenTP" => "Gia Lai"],
                        ["tenTP" => "HàGiang"],
                        ["tenTP" => "Hà Nam"],
                        ["tenTP" => "TP.HàNội"],
                        ["tenTP" => "HàTĩnh"],
                        ["tenTP" => "TP.HảiPhòng"],
                        ["tenTP" => "HòaBình"],
                        ["tenTP" => "TP.HồChí Minh"],
                        ["tenTP" => "HậuGiang"],
                        ["tenTP" => "HưngYên"],
                        ["tenTP" => "KhánhHòa"],
                        ["tenTP" => "KiênGiang"],
                        ["tenTP" => "Kon Tum"],
                        ["tenTP" => "Lai Châu"],
                        ["tenTP" => "LàoCai"],
                        ["tenTP" => "LạngSơn"],
                        ["tenTP" => "LâmĐồng"],
                        ["tenTP" => "Long An"],
                        ["tenTP" => "Nam Định"],
                        ["tenTP" => "NghệAn"],
                        ["tenTP" => "NinhBình"],
                        ["tenTP" => "NinhThuận"],
                        ["tenTP" => "PhúThọ"],
                        ["tenTP" => "PhúYên"],
                        ["tenTP" => "QuảngBình"],
                        ["tenTP" => "Quảng Nam"],
                        ["tenTP" => "QuảngNgãi"],
                        ["tenTP" => "QuảngNinh"],
                        ["tenTP" => "QuảngTrị"],
                        ["tenTP" => "SócTrăng"],
                        ["tenTP" => "Sơn La"],
                        ["tenTP" => "TâyNinh"],
                        ["tenTP" => "TháiBình"],
                        ["tenTP" => "TháiNguyên"],
                        ["tenTP" => "ThanhHóa"],
                        ["tenTP" => "ThừaThiên - Huế"],
                        ["tenTP" => "TiềnGiang"],
                        ["tenTP" => "TràVinh"],
                        ["tenTP" => "TuyênQuang"],
                        ["tenTP" => "Vĩnh Long"],
                        ["tenTP" => "VĩnhPhúc"],
                        ["tenTP" => "YênBái"]
                    ];
        DB::table('thanhphos')->delete();
        DB::table('thanhphos')->insert($province);
    }
}
