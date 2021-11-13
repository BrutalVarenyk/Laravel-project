<?php

namespace Tests\Unit\Controllers;

use App\Models\Category;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\OrderStatusesTableSeeder;
use Faker\Guesser\Name;
use Faker\Provider\Address;
use Faker\Provider\Person;
use Faker\Provider\PhoneNumber;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $products;
    protected User $user;

    private function setParameters()
    {
        Role::create(['name' => Config::get('constants.db.roles.customer')]);

        $role = Role::all()->first();

        $category = Category::factory(1)->create()->first();
        Product::factory(3, [
            'category_id' => $category->id,
            'in_stock' => 10,
            ])->create()->each(function ($product){
                Cart::instance('cart')->add(
                    $product->id,
                    $product->title,
                    4,
                    $product->getPrice(),
                );
            });

        $this->products = Product::all();

        $this->user = User::factory(1, ['role_id' => $role->id])->create()->first();

        $this->status = OrderStatus::where('name', '=', Config::get('constants.db.order_statuses.in_process'))->first();

        dd($this->user, $this->products, Cart::instance('cart')->content());
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->setParameters();
//        $request = Request::create(route('lang.order.create'), 'POST',[
//            "name" => $this->user->name,
//            "surname" => $this->user->surname,
//            "phone" => $this->user->phone,
//            "email" => $this->user->email,
//            "country" => Person::regexify('/[A-Z]{1}[a-z]{3,6}/'),
//            "city" => $this->fake_address->city(),
//            "address" => $this->fake_address->address(),
//        ]);
//        dd($request);
        $response = $this->get('/en');

        $response->dump();
    }
}
