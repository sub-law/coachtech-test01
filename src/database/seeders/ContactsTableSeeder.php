<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Category;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        Contact::factory()
            ->count(35)
            ->make()
            ->each(function ($contact) use ($categories) {
                $contact->category_id = $categories->random()->id;
                $contact->save();
            });
    }
}
