<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = factory(App\Models\Company::class,5)
            ->create()
            ->each(function ($company){
                $cid = $company->id;
                $users = factory(\App\Models\User::class,10)->make();
                $departments = factory(\App\Models\Department::class,5)->make();
                $orders = factory(\App\Models\Order::class,3)->make();
                $customers = factory(\App\Models\Customer::class,3)->make();
                $productCategory = factory(\App\Models\ProductCategory::class,2)->make();
                $products = factory(\App\Models\Product::class,3)->make();
                $accounts  = factory(\App\Models\AccountingAccount::class,3)->make(['parent_account_id'=>null,'company_id'=>$cid]);
                $groups = factory(\App\Models\Group::class,4)->make();
                $teams = factory(\App\Models\Team::class,4)->make();
                $company->users()->saveMany($users);
                $saved_customers = $company->customers()->saveMany($customers);
                $saved_groups = $company->groups()->saveMany($groups);
                $customers_array = array();
                $groups_array  = array();
                foreach ($saved_customers as $saved){
                    $customers_array[] = $saved->id;
                }
                foreach ($saved_groups as $saved){
                    $groups_array[] = $saved->id;
                }
                factory(\App\Models\CustomerGroup::class,4)->create(['customer'=>$customers_array,'groups'=>$groups_array,null]);
                $company->productCategories()->saveMany($productCategory);
                $company->orders()->saveMany($orders);
                $company->products()->savemany($products)
                ->each(function ($products){
                    $products->prices()->saveMany(factory(\App\Models\ProductPrice::class,1)->make());
                    $products->stocks()->saveMany(factory(\App\Models\ProductStock::class,1)->make());
                });
                $company->departments()->saveMany($departments)
                    ->each(function ($department) use ($cid){
                        $department->employees()->saveMany(factory(\App\Models\Employee::class,5)->make(['company_id'=>$cid]));
                    });
                $company->accountingAccounts()->savemany($accounts)->each(function ($account) use ($cid){
                    $account->subAccounts()->saveMany(factory(\App\Models\AccountingAccount::class,2)->make(['parent_account_id'=>$account->id,'company_id'=>$cid]));
                    $account->entries()->saveMany(factory(\App\Models\AccountingEntry::class,2)->make());
                });
                $company->teams()->saveMany($teams);
            });

    }
}
