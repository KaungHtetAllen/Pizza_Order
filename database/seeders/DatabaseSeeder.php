<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //admin
        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'phone'=>'09426979396',
            'gender'=>'male',
            'address'=>'Yangon',
            'role'=>'admin',
            'password'=> Hash::make('admin123'),
        ]);

        //user
        User::create([
            'name'=>'user',
            'email'=>'user@gmail.com',
            'phone'=>'09752437332',
            'gender'=>'female',
            'address'=>'Yangon',
            'role'=>'user',
            'password'=> Hash::make('user1234'),
        ]);

        //Categories
        Category::create(['name'=>'Pizza']);
        Category::create(['name'=>'Chicken']);
        Category::create(['name'=>'Burger']);
        Category::create(['name'=>'Pasta']);
        Category::create(['name'=>'Coffee']);
        Category::create(['name'=>'Ice Cream']);
        Category::create(['name'=>'Soft Drinks']);

        //Products
        Product::create(['name'=>'Nepolitan Pizza','category_id'=>'1','description'=>'Traditional Italian pizza with a thin crust, fresh tomatoes, mozzarella cheese, fresh basil, and olive oil','image'=>'6658b13f0d347Neapolitan Pizza.jpg','price'=>'20000','waiting_time'=>'15']);
        Product::create(['name'=>'Margherita Pizza','category_id'=>'1','description'=>'Classic pizza with tomato, mozzarella, and basil, representing the Italian flag colors.','image'=>'6658b20cf188aMargherita Pizza.jpg','price'=>'25000','waiting_time'=>'20']);
        Product::create(['name'=>'Pepperoni Pizza','category_id'=>'1','description'=>'Popular in the US, topped with pepperoni slices.','image'=>'6658b24249747Pepperoni Pizza.jpg','price'=>'20000','waiting_time'=>'20']);
        Product::create(['name'=>'Chicago Deep-Dish Pizza','category_id'=>'1','description'=>'Thick, pie-like crust with a chunky tomato sauce, mozzarella, and various toppings.','image'=>'6658b26fc6148Chicago Deep-Dish Pizza.jpg','price'=>'30000','waiting_time'=>'25']);
        Product::create(['name'=>'New York-Style Pizza','category_id'=>'1','description'=>'Large, thin, and foldable slices with a crispy crust, often topped with tomato sauce and mozzarella.','image'=>'6658b29c633ceNew York-Style Pizza.jpg','price'=>'25000','waiting_time'=>'15']);
        Product::create(['name'=>'Fried Chicken','category_id'=>'2','description'=>'Spicy version from Nashville, Tennessee, typically coated in a cayenne pepper paste.','image'=>'6658b32c14918Fried Chicken.png','price'=>'3000','waiting_time'=>'10']);
        Product::create(['name'=>'Chicken Nuggets','category_id'=>'2','description'=>'Bite-sized pieces of chicken, breaded and fried.','image'=>'6658b36978e1dChicken Nuggets.jpg','price'=>'6000','waiting_time'=>'20']);
        Product::create(['name'=>'Popcorn Chicken','category_id'=>'2','description'=>'Small, bite-sized pieces of chicken, breaded and fried, often served as a snack.','image'=>'6658b39de1342Popcorn Chicken.jpg','price'=>'6000','waiting_time'=>'15']);
        Product::create(['name'=>'Chicken Katsu','category_id'=>'2','description'=>'Japanese-style breaded and fried chicken cutlet, served with tonkatsu sauce.','image'=>'6658b3e0a9977Chicken Katsu.jpg','price'=>'8000','waiting_time'=>'25']);
        Product::create(['name'=>'Beef Burger','category_id'=>'3','description'=>'Classic burger made with a ground beef patty','image'=>'6658b42be58d2Beef Burger.jpg','price'=>'8000','waiting_time'=>'30']);
        Product::create(['name'=>'Cheeseburger','category_id'=>'3','description'=>'Beef burger with added cheese','image'=>'6658b4608f1d2Cheeseburger.jpg','price'=>'10000','waiting_time'=>'30']);
        Product::create(['name'=>'Chicken Burger','category_id'=>'3','description'=>'Made with a grilled or fried chicken patty.','image'=>'6658b49f37098Chicken Burger.jpg','price'=>'6000','waiting_time'=>'15']);
        Product::create(['name'=>'Spaghetti Bolognese','category_id'=>'4','description'=>'Spaghetti with a meat-based tomato sauce.','image'=>'6658b4dc50094Spaghetti.jpg','price'=>'15000','waiting_time'=>'30']);
        Product::create(['name'=>'Macaroni and Cheese','category_id'=>'4','description'=>'Macaroni with a cheesy sauce.','image'=>'6658b517af310Macaroni Pasta.jpg','price'=>'15000','waiting_time'=>'20']);
        Product::create(['name'=>'Lasagna Pasta','category_id'=>'4','description'=>'Layers of pasta with meat, cheese, and tomato sauce, baked.','image'=>'6658b54682446Lasagna pasta.jpg','price'=>'17000','waiting_time'=>'25']);
        Product::create(['name'=>'Americano','category_id'=>'5','description'=>'Espresso diluted with hot water.','image'=>'6658b58894209Americano.jpg','price'=>'3000','waiting_time'=>'15']);
        Product::create(['name'=>'Latte','category_id'=>'5','description'=>'Espresso with steamed milk and a small amount of foam.','image'=>'6658b5ad134eeLatte.jpg','price'=>'3000','waiting_time'=>'15']);
        Product::create(['name'=>'Cappuccino','category_id'=>'5','description'=>'Espresso with equal parts steamed milk and milk foam.','image'=>'6658b5d1c21a0Cappuccino.jpg','price'=>'3000','waiting_time'=>'15']);
        Product::create(['name'=>'Mocha','category_id'=>'5','description'=>'Espresso with chocolate syrup, steamed milk, and whipped cream.','image'=>'6658b5ff77b9cMocha.jpg','price'=>'5000','waiting_time'=>'20']);
        Product::create(['name'=>'Vanilla Ice Cream','category_id'=>'6','description'=>'Vanilla Flavour.','image'=>'6658b6464dc20Vanilla Flavour.jpg','price'=>'2000','waiting_time'=>'10']);
        Product::create(['name'=>'Chocolate Ice Cream','category_id'=>'6','description'=>'Chocolate Flavour.','image'=>'6658b6816895bChocolate Flavour.jpg','price'=>'2000','waiting_time'=>'10']);
        Product::create(['name'=>'Strawberry Ice Cream','category_id'=>'6','description'=>'Strawberry Flavour.','image'=>'6658b6a677cfbStrawberry Flavour.jpg','price'=>'2000','waiting_time'=>'10']);
        Product::create(['name'=>'Mint Choco Chip Ice Cream','category_id'=>'6','description'=>'Mint Choco Flavour.','image'=>'6658b6cb0e2beMint Choco Flavour.jpg','price'=>'2500','waiting_time'=>'10']);
        Product::create(['name'=>'Fanta','category_id'=>'7','description'=>'various flavors such as Orange, Grape, and Pineapple','image'=>'6658b7201461cFanta.jpg','price'=>'1600','waiting_time'=>'5']);
        Product::create(['name'=>'Coca Cola','category_id'=>'7','description'=>'Coca-Cola has a distinctive sweet, caramel-like flavor with hints of vanilla and cinnamon, and a slight tang from citric and phosphoric acids.','image'=>'6658b761c00c7Coca Cola.jpg','price'=>'1600','waiting_time'=>'5']);
        Product::create(['name'=>'Sprite','category_id'=>'7','description'=>'Sprite is known for its crisp, clean, and refreshing lemon-lime taste. It does not contain caffeine, which sets it apart from many other carbonated soft drinks.','image'=>'6658b7a071a20Sprite.jpg','price'=>'1600','waiting_time'=>'5']);
        Product::create(['name'=>'Pepsi','category_id'=>'7','description'=>'Pepsi has a distinctively sweet, caramel-like taste with a slightly citrusy undertone. It is less acidic than its main competitor, Coca-Cola.','image'=>'6658b7e50e3baPepsi.jpg','price'=>'1600','waiting_time'=>'5']);
        Product::create(['name'=>'Coca Cola Code Zero','category_id'=>'7','description'=>'Coca-Cola Zero Sugar aims to mimic the taste of the original Coca-Cola while being free of sugar. It has a robust cola flavor with caramel and vanilla notes, similar to the classic Coke but with artificial sweeteners.','image'=>'6658b81d7bcd8Coca Cola Code Zero.jpg','price'=>'1800','waiting_time'=>'5']);
    }
}
