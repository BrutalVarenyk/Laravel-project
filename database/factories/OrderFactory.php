<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Config;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return OrderFactory
     */

    public function configure()
    {
        return $this->afterCreating(function (Order $order) {

            $total = 0;
            $id = [];

            for ($i = 0; $i < rand(1, 3); $i++) {
                $product = Product::query()->whereNotIn('id', $id)->inRandomOrder()->first();
                $id[] = $product->id;

                $quantity = rand(1, 3);

                $order->products()->newPivot([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'single_price' => $product->price
                ])->save();

                $total += $quantity * $product->price;
            }
            $order->update(['total' => $total]);
        });
    }

    public function definition()
    {
        $user = User::query()->inRandomOrder()->first();
        $statuses = Config::get('constants.db.order_statuses');

        return [
            'status_id' => rand(1, count($statuses)),
            'user_id' => $user->id,
            'name' => $this->faker->name,
            'surname' => $this->faker->lastName,
            'phone' => $this->faker->e164PhoneNumber,
            'email' => $this->faker->email,
            'country' => $this->faker->country,
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'total' => $this->faker->randomFloat(2, 4, 100)
        ];
    }
}
