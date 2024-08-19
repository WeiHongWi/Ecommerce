<?php

namespace Database\Seeders;
use App\Models\Vendor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email','vendor@gmail.com')->first();

        $vendor = new Vendor();
        $vendor->banner = 'uploads/vendor_1.jpg';
        $vendor->phone = '09123456';
        $vendor->email = 'arty03333@gmail.com';
        $vendor->address = 'TW Kaohsiung Zuyong';
        $vendor->description = 'Shop description';
        $vendor->user_id = $user->id;
        $vendor->shop_name = "Willy";

        $vendor->save();
    }
}
