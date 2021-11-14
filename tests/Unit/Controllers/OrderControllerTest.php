<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\OrdersController;
use App\Http\Requests\CreateOrderRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Order\OrderRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $products;
    protected User $user;
    protected Request $request;
    protected $order;
    protected array $data;

    private function createRequest(
        $method,
        $content,
        $parameters = [],
        $uri = '/en/order',
        $server = ['CONTENT_TYPE' => 'application/x-www-form-urlencoded'],
        $cookies = [],
        $files = []
    ) {
        $request = app()->make(CreateOrderRequest::class);
        return $request->createFromBase(CreateOrderRequest::create($uri, $method, $parameters, $cookies, $files, $server, $content));
    }

    private function setParameters()
    {
        $this->order = new OrdersController();

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
                    1,
                    $product->getPrice(),
                );
            });

        $this->products = Product::all();

        $this->user = User::factory(1, ['role_id' => $role->id, 'balance' => 0])->create()->first();

        $this->be($this->user);

        OrderStatus::create(['name' => Config::get('constants.db.order_statuses.in_process')]);


        $this->data = [
            "name" => $this->user->name,
            "surname" => $this->user->surname,
            "phone" => $this->user->phone,
            "email" => $this->user->email,
            "country" => 'Ukraine',
            "city" => 'Kiev',
            "address" => 'Shevchenka',
        ];

        $this->request = new CreateOrderRequest($this->data);

    }
    /**
     * A basic feature test example.
     * @return void
     */
    public function test_create_if_user_balance_less_than_total()
    {
        $this->setParameters();

        try {
            (new OrderRepository())->create($this->request);
        }catch (\Exception $e) {
            $this->assertEquals(200, $e->getCode());
            $this->assertEquals('Not enough money on balance', $e->getMessage());
        }
    }

//    public function test_create_balance_of_user_after_purchase()
//    {
//        $this->setParameters();
//
//        $balanceAfter = 100;
//        $balanceBefore = Cart::instance('cart')->total() + $balanceAfter;
//        $this->user->update(['balance' => $balanceBefore]);
//
//        $this->assertEquals($balanceBefore, $this->user->balance);
//
//
//        $this->post('/en/order', $this->data);
//
////        $this->assertEquals($balanceAfter, $this->user->balance);
//
////        $request = $this->createRequest('POST', '', $this->data);
////        (new OrderRepository())->create($request);
//
//    }
}
