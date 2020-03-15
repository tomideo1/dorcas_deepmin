<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AccountingAccount;
use App\Models\User;
use Faker\Generator as Faker;
use Bezhanov\Faker as Faker2;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $gender = $faker->randomElement(['male', 'female']);
    return [
        'uuid'=> $faker->uuid,
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastname,
//        'company_id' => random_int(1,5000),
        'email' => $faker->unique()->email,
        'password' => '$2y$10$algktMFhmp3njIzvPMWZpOWRt3SZY0LBVV/fcToIp0fGPoSxvzUPm',
        'gender' => $gender,
        'phone'=> $faker->phoneNumber,
        'photo_url' => 'https://secure.gravatar.com/avatar/8c1e15d7ba5e47adb2a7995f87fa0359?s=400&d=retro&r=g',
        'updated_at'=> $faker->dateTime,
        'created_at'=> $faker->dateTime,

    ];
});

$factory->define(App\Models\Company::class, function (Faker $faker){
    return [
        'uuid' => $faker->uuid(),
        'plan_id' => random_int(1,3),
        'reg_number' => $faker->randomDigit,
        'name'=> $faker->company,
        'phone' => $faker->phoneNumber,
        'email'=> $faker->email,
        'plan_type' => $faker->randomElement(['monthly','yearly']),
        'access_expires_at'=> $faker->dateTime,
        'updated_at'=> $faker->dateTime,
        'created_at'=> $faker->dateTime,
    ];
});
$factory->define(App\Models\Plan::class, function (Faker $faker){
    return [
        'uuid' => $faker->uuid,
        'name'=>$faker->name,
        'price_monthly' => random_int(10,10000),
        'price_yearly' => random_int(10,100000000),
        'deleted_at' => null,
        'updated_at'=> $faker->dateTime,
        'created_at'=> $faker->dateTime,
    ];
});


$factory->define(\App\Models\Department::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
    $departments  = $faker->randomElement(['Finance', 'Engineering Department','IT Department','Accounting','Administration','Human Resources','Research and Development'
    ,'Sales','Strategy','Operation and Logistics','Strategy','Digital Marketing','Public Relations','Community Business','Business Development','Security']);
    return [
        'uuid'=> $faker->uuid,
//        'company_id' => random_int(2000,4000),
        'name' => $departments,
        'description'=> $faker->sentence,
        'updated_at'=> $faker->dateTime,
        'created_at'=> $faker->dateTime,

    ];
});


$factory->define(\App\Models\Employee::class, function (Faker $faker,$company_id)  {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
    $gender = $faker->randomElement(['male', 'female']);
    $data = [
        'uuid'=> $faker->uuid,
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastname,
        'company_id' => $company_id,
        'gender' => $gender,
        'salary_amount' => $faker->numerify('######'),
        'salary_period' => 'month',
        'job_title' => $faker->jobTitle,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'updated_at'=> $faker->dateTime,
        'created_at'=> $faker->dateTime,
    ];
    return $data;
});

$factory->define(\App\Models\Customer::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
    return [
        'uuid'=> $faker->uuid,
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastname,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'updated_at'=> $faker->dateTime,
        'created_at'=> $faker->dateTime,
    ];
});

$factory->define(\App\Models\ProductCategory::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
    return [
        'uuid'=> $faker->uuid,
        'name' => $faker->department,
        'slug' => $faker->unique()->slug('1'),
        'description' => $faker->text,
        'updated_at'=> $faker->dateTime,
        'created_at'=> $faker->dateTime,
    ];
});

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
    return [
        'uuid'=> $faker->uuid,
        'name' => $faker->productName,
        'unit_price' => '00.00',
        'inventory' => random_int(0,300),
        'updated_at'=> $faker->dateTime,
        'created_at'=> $faker->dateTime,
    ];
});

$factory->define(\App\Models\ProductPrice::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
    return [
        'uuid'=> $faker->uuid,
        'currency' => 'NGN',
        'unit_price' => $faker->numerify('####.##'),
        'updated_at'=> $faker->dateTime,
        'created_at'=> $faker->dateTime,
    ];
});

$factory->define(\App\Models\Partner::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
    return [
        'uuid' => $faker->uuid,
        'name' => $faker->company,
        'slug' => $faker->slug,
        'logo_url' => 'https://static.smetoolkit.ng/images/logok.png',
        'is_verified' => 0,
        'updated_at' => $faker->dateTime,
        'created_at' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\ProductStock::class, function (Faker $faker){
    $action = $faker->randomElement(['add','substract']);
    $comments = $faker->randomElement(['Added to Stock','Initial Stock', 'Available']);
    return [
        'action' => $action,
        'quantity' => $faker->randomDigit,
        'comment' => $comments,
        'updated_at' => $faker->dateTime,
        'created_at' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\Order::class,function (Faker $faker){
    $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
   return [
     'uuid' => $faker->uuid,
     'title' => 'Order'. '#'. $faker->randomDigit. $faker->text(7),
     'description' => $faker->sentence,
     'product_name' => $faker->productName,
     'product_description' => $faker->sentence,
     'quantity' => $faker->randomDigit,
     'unit_price' => $faker->numerify('####.##'),
     'currency' => 'NGN',
     'amount' =>  $faker->numerify('####.##'),
     'due_at' => $faker->dateTime,
     'reminder_on' => $faker->randomElement(['0','1']),
     'updated_at' => $faker->dateTime,
     'created_at' => $faker->dateTime,
   ];
});

$factory->define(AccountingAccount::class,function (Faker $faker,$parent_account_id){
    $account_names = $faker->randomElement(['assets','cash','expenses','liabilities','bank','others','unconfirmed','salaries',
    'rent','sales','revenue','income','liabilities','retained earnings','equity','liability','capital','assets','accounts payable','accounts receivable','depreciation']);
    $entry_type = $faker->randomElement(['debit','credit']);
    if($parent_account_id !== null){
        $data['parent_account_id' ] = $parent_account_id;
//        $data['company_id' ] = $company_id;
    }
    $data = [
        'uuid' => $faker->uuid,
        'name'=>$account_names,
        'entry_type'=>$entry_type,
        'is_visible'=>1,
        'updated_at' => $faker->dateTime,
        'created_at' => $faker->dateTime,

    ];
    return $data;
});

$factory->define(\App\Models\AccountingEntry::class,function (Faker $faker){
    $source_type = $faker->randomElement(['transak','manual']);
    $source_info = $faker->bankAccountNumber .'E-CHANNELS';
    $entry_type = $faker->randomElement(['debit','credit']);
    return [
        'uuid' => $faker->uuid,
        'entry_type'=>$entry_type,
        'currency'=>'NGN',
        'memo'=>$faker->realText(50,4),
        'source_type'=>$source_type,
        'source_info'=>$source_info,
        'updated_at' => $faker->dateTime,
        'created_at' => $faker->dateTime,

    ];
});

$factory->define(\App\Models\Group::class,function (Faker $faker){
    $source_type = $faker->randomElement(['transak','manual']);
    $source_info = $faker->bankAccountNumber .'E-CHANNELS';
    $entry_type = $faker->randomElement(['debit','credit']);
    return [
        'uuid' => $faker->uuid,
        'name'=>$faker->sentence(6),
        'description'=>$faker->text,
        'updated_at' => $faker->dateTime,
        'created_at' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\Team::class,function (Faker $faker){
    $faker->addProvider(new \Bezhanov\Faker\Provider\Team($faker));

    return [
        'uuid' => $faker->uuid,
        'name'=>$faker->team,
        'description'=>$faker->text,
        'updated_at' => $faker->dateTime,
        'created_at' => $faker->dateTime,
    ];
});
$factory->define(\App\Models\CustomerGroup::class,function (Faker $faker,$customers,$groups){
    $faker->addProvider(new \Bezhanov\Faker\Provider\Team($faker));
    $customer_ids = $faker->randomElement($customers);
    $group_ids = $faker->randomElement($groups);

    return [
        'uuid' => $faker->uuid,
        'customer_id'=>$customer_ids,
        'group_id'=>$group_ids,
        'created_at' => $faker->dateTime,
    ];
});
