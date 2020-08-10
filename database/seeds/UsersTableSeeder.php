<?php
<<<<<<< HEAD

=======
>>>>>>> b77f818da33c39343a84586a14f26b0a5bde2d9d
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = factory(User::class)->times(50)->make();
<<<<<<< HEAD
        User::insert($users->makeVisible(['password', 'remember_token'])->toArray());
=======
        User::insert($users->makeVisible(['password', 'remember_token'])->toArray())
>>>>>>> b77f818da33c39343a84586a14f26b0a5bde2d9d

        $user = User::find(1);
        $user->name = 'Summer';
        $user->email = 'summer@example.com';
        $user->is_admin = true;
        $user->save();
    }
}
