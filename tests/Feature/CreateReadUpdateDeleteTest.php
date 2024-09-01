<?php

namespace Tests\Feature;

use App\Models\Users;
use Database\Seeders\UsersSeeder;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Support\Str;

class CreateReadUpdateDeleteTest extends TestCase
{
    public function testInsertManual()
    {
        $users = new Users();
        $users->id = 'users-' . Str::random(16);
        $users->email = 'davidpinarto90@gmail.com';
        $users->password = Hash::make('david');
        $users->full_name = 'david pinarto';

        $result = $users->save(); // true or error

        self::assertTrue($result);
    }

    public function testMassInsert()
    {
        /** akan lebih mudah kalau menggunakan $fillable di Model */
        $usersPayload = [
            [
                'id' => "user-" . Str::random(16),
                'email' => "davidpinarto90@gmail.com",
                'password' => Hash::make('david'),
                'full_name' => 'david pinarto',
            ],
            [
                'id' => "user-" . Str::random(16),
                'email' => "testing@gmail.com",
                'password' => Hash::make('david'),
                'full_name' => 'testing',
            ],
            [
                'id' => "user-" . Str::random(16),
                'email' => "testong@gmail.com",
                'password' => Hash::make('david'),
                'full_name' => 'testong',
            ]
        ];

        foreach ($usersPayload as $userData) {
            $result = Users::create($userData); // object of the Model

            self::assertNotNull($result->id);
            self::assertNotNull($result->email);
            self::assertNotNull($result->password);
            self::assertNotNull($result->full_name);
        }
    }

    public function testSelectAll()
    {
        $this->seed([UsersSeeder::class]);

        $users = Users::all(); // collection

        self::assertCount(3, $users);
    }

    public function testSpecificSelect()
    {
        $this->seed([UsersSeeder::class]);

        $user = Users::where('full_name', '=', 'testong')->first(); // object or null
        // $user = Users::where('full_name', '=', 'testong')->get(); // collection

        self::assertEquals('testong', $user->full_name);
    }

    public function testUpdate()
    {
        $this->seed([UsersSeeder::class]);

        $user = Users::where('full_name', '=', 'david pinarto')->first();  // object of the model
        $user->full_name = 'david update';

        $result = $user->update();

        self::assertTrue($result);
        self::assertEquals('david update', $user->full_name);
    }

    public function testDelete()
    {
        $this->seed([UsersSeeder::class]);

        $user = Users::where('full_name', '=', 'david pinarto')->first();  // object of the model or null

        $result = $user->delete();
        self::assertTrue($result);

        $getUser = Users::where('full_name', '=', 'david pinarto')->first();
        self::assertNull($getUser);
    }
}
