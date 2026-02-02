<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin\Admin;
use App\Models\Magasin\Agent;
use App\Models\Magasin\Category;
use App\Models\Magasin\Magasin;
use App\Models\Magasin\Product;
use App\Models\Magasin\SubCategory;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Faker\Factory;
use Intervention\Image\Laravel\Facades\Image;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $faker = Factory::create();

        // dd($faker->randomNumber(2));

    

        Admin::create([
            'name' => 'Ousmane Diallo',
            'email' => 'admin@admin.com',
            'phone' => '770000000',
            'slug' => str_replace('/','',Hash::make(Str::random(2).'admin@admin.com')),
            'password' => Hash::make('password'),
            'confirmation_token' => null,
            'is_active' => 1,
            'code_validation' => null,
            'status' => 1,
        ]);

        Magasin::create([
            'name' => 'Dell Technologies',
            'admin_name' => 'Ousmane Diallo',
            'email' => 'dell@dell.com',
            'phone' => '770000000',
            'slug' => str_replace('/','',Hash::make(Str::random(2).'dell@dell.com')),
            'password' => Hash::make('password'),
            'confirmation_token' => null,
            'is_active' => 1,
            'code_validation' => null,
            'termsService' => 1,
            'logo' => null,
            'visible' => 0
        ]);

        Magasin::create([
            'name' => 'Intel',
            'admin_name' => 'Boubacar Diallo',
            'email' => 'intel@intel.com',
            'phone' => '770000001',
            'slug' => str_replace('/','',Hash::make(Str::random(2).'intel@intel.com')),
            'password' => Hash::make('password'),
            'confirmation_token' => null,
            'is_active' => 1,
            'code_validation' => null,
            'termsService' => 1,
            'logo' => null,
            'visible' => 0
        ]);

        Magasin::create([
            'name' => 'Honda',
            'admin_name' => 'Oumar Diallo',
            'email' => 'honda@honda.com',
            'phone' => '770000002',
            'slug' => str_replace('/','',Hash::make(Str::random(2).'honda@honda.com')),
            'password' => Hash::make('password'),
            'confirmation_token' => null,
            'is_active' => 1,
            'code_validation' => null,
            'termsService' => 1,
            'logo' => null,
            'visible' => 0
        ]);

        Magasin::create([
            'name' => 'Asus ROG',
            'admin_name' => 'Amadou Diallo',
            'email' => 'asus@asus.com',
            'phone' => '770000003',
            'slug' => str_replace('/','',Hash::make(Str::random(2).'asus@asus.com')),
            'password' => Hash::make('password'),
            'confirmation_token' => null,
            'is_active' => 1,
            'code_validation' => null,
            'termsService' => 1,
            'logo' => null,
            'visible' => 0
        ]);

        Magasin::create([
            'name' => 'Yamaha',
            'admin_name' => 'Ramatou Diallo',
            'email' => 'yamaha@yamaha.com',
            'phone' => '770000004',
            'slug' => str_replace('/','',Hash::make(Str::random(2).'yamaha@yamaha.com')),
            'password' => Hash::make('password'),
            'confirmation_token' => null,
            'is_active' => 1,
            'code_validation' => null,
            'termsService' => 1,
            'logo' => null,
            'visible' => 0
        ]);

        Magasin::create([
            'name' => 'IBM',
            'admin_name' => 'Fatoumata Diallo',
            'email' => 'ibm@ibm.com',
            'phone' => '770000005',
            'slug' => str_replace('/','',Hash::make(Str::random(2).'ibm@ibm.com')),
            'password' => Hash::make('password'),
            'confirmation_token' => null,
            'is_active' => 1,
            'code_validation' => null,
            'termsService' => 1,
            'logo' => null,
            'visible' => 0
        ]);

        $categorys = [
            'Collectibles &amp; Art' => 'pocket', 
            'Home &amp; Gardan' => 'home',
            'Sporting Goods' => 'globe',
            'Electronics' => 'monitor',
            'Auto Parts &amp; Accessories' => 'truck',
            'Toys &amp; Hobbies' => 'codesandbox',
            'Fashion' => 'watch',
            'Musical Instruments &amp; Gear' => 'music',
            'Other Categories' => 'grid',
        ];

        $subcategorys = [
            'Collectibles','Antiques','Sports','Art',
        ];

        $magasins = Magasin::all();
        foreach ($magasins as $magasin) {

            foreach ($categorys as $name => $icon) {
                $category = Category::create([
                    'name' => $name,
                    'icon' => $icon,
                    'slug' => str_replace('/','',Hash::make(Str::random(2).$name)),
                    'visible' => 1,
                    'magasin_id' => $magasin->id
                ]);

                foreach ($subcategorys  as $key => $val) {
                    
                    SubCategory::create([
                        'name' => $val,
                        'slug' => str_replace('/','',Hash::make(Str::random(2).$val)),
                        'category_id' => $category->id,
                        'visible' => 1,
                        'magasin_id' => $category->magasin->id
                    ]);
                }
            }
        }   

        // $colors = [
        //     'Bleu','Vert','Rouge','Maron',
        // ];

        // $sizes = [
        //     'XXL','Xl','M','L','S','12','13','12,5'
        // ];
        
        // $magasins = Magasin::all();
        // foreach ($magasins as $magasin) {

        //     foreach ($categorys as $name => $icon) {
        //         $category = Category::create([
        //             'name' => $name,
        //             'icon' => $icon,
        //             'slug' => str_replace('/','',Hash::make(Str::random(2).$name)),
        //             'visible' => 1,
        //             'magasin_id' => $magasin->id
        //         ]);

        //         foreach ($subcategorys  as $key => $val) {
                    
        //             $getsubcategory = SubCategory::create([
        //                 'name' => $val,
        //                 'slug' => str_replace('/','',Hash::make(Str::random(2).$val)),
        //                 'category_id' => $category->id,
        //                 'visible' => 1
        //             ]);

                    
        //             $imageName = '';
        //             if(request()->hasFile($faker->imageUrl))
        //             {
        //                 // $imageName = request()()->file->store('public/Logos');
        //                 $file = request()->file($faker->imageUrl);

        //                 $NameLogo = $faker->name.'-'.$category->magasin->name.'.'. $file->getClientOriginalExtension();
        //                 $imageLogo = Image::read($file);
        //                 // Resize image
        //                 $imageLogo->resize(360, 338, function ($constraint) {
        //                     $constraint->aspectRatio();
        //                 })->save(storage_path('app/public/Products/' . $NameLogo));

        //                 $imageName = 'public/Products'. $NameLogo;
        //             }
                    
        //             for ($i=0; $i < 5; $i++) { 
        //                 Product::create([
        //                     'name' => $faker->name,
        //                     'slug' => str_replace('/','',Hash::make(Str::random(2).$faker->name)),
        //                     'reference' => 'W239JKI',
        //                     'price' => $faker->randomNumber(2),
        //                     'quantity' => 50,
        //                     'qty_alert' => 10,
        //                     'stock' => 50,
        //                     'image' => $imageName,
        //                     'exp_date' => null,
        //                     'colors' => serialize($colors),
        //                     'sizes' => serialize($sizes),
        //                     'desc' => $faker->paragraph,
        //                     'promot' => null,
        //                     'promo_price' => null,
        //                     'visible' => 1,
        //                     'magasin_id' => $getsubcategory->category->magasin->id,
        //                     'sub_category_id' => $getsubcategory->id
        //                 ]);
        //             }
        //         }
        //     }
        // }

        Agent::create([
            'name' => 'Moussa Ba',
            'email' => 'agent@agent.com',
            'phone' => '770000000',
            'slug' => str_replace('/','',Hash::make(Str::random(2).'agent@agent.com')),
            'password' => Hash::make('password'),
            'confirmation_token' => null,
            'is_active' => 1,
            'magasin_id' => 1,
            'code_validation' => null,
            // 'status' => 1,
        ]);

        User::create([
            'name' => 'Ousmane Diallo',
            'email' => 'client@client.com',
            'phone' => '770000000',
            'slug' => str_replace('/','',Hash::make(Str::random(2).'client@client.com')),
            'image' => null,
            'password' => Hash::make('password'),
            'confirmation_token' => null,
            'is_active' => 1,
            'code_validation' => null,
            'termsService' => 1,
        ]);

        User::create([
            'name' => 'Geodril SN',
            'email' => 'geodril@geodril.com',
            'phone' => '770000001',
            'slug' => str_replace('/','',Hash::make(Str::random(2).'geodril@geodril.com')),
            'image' => null,
            'password' => Hash::make('password'),
            'confirmation_token' => null,
            'is_active' => 1,
            'code_validation' => null,
            'termsService' => 1,
        ]);

        User::create([
            'name' => 'Forage FTE SENEGAL',
            'email' => 'fte@fte.com',
            'phone' => '770000002',
            'slug' => str_replace('/','',Hash::make(Str::random(2).'fte@fte.com')),
            'image' => null,
            'password' => Hash::make('password'),
            'confirmation_token' => null,
            'is_active' => 1,
            'code_validation' => null,
            'termsService' => 1,
        ]);

        User::create([
            'name' => 'IDC SN',
            'email' => 'idc@idc.com',
            'phone' => '770000003',
            'slug' => str_replace('/','',Hash::make(Str::random(2).'idc@idc.com')),
            'image' => null,
            'password' => Hash::make('password'),
            'confirmation_token' => null,
            'is_active' => 1,
            'code_validation' => null,
            'termsService' => 1,
        ]);
    }
}
