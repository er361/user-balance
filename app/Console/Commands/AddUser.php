<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ub:add-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add user to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->ask('Email');
        $password = $this->ask('Password');
        $passwordConfirm = $this->ask('Password confirmation');

        $validator = $this->getValidator($email, $password, $passwordConfirm);

        if ($validator->fails()) {
            $this->displayErrors($validator);
        } else {
            if (User::whereEmail($email)->exists()) {
                $this->error(sprintf('Email %s already exists', $email));
                return 0;
            }

            User::create([
                'email'    => $email,
                'password' => Hash::make($password),
            ]);
            $this->info('User created successfully');
        }
    }

    /**
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return \Illuminate\Support\Collection
     */
    protected function displayErrors(\Illuminate\Contracts\Validation\Validator $validator
    ): \Illuminate\Support\Collection {
        return collect($validator->errors()->all())->each(fn(string $message) => $this->error($message));
    }

    /**
     * @param mixed $email
     * @param mixed $password
     * @param mixed $passwordConfirm
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidator(
        mixed $email,
        mixed $password,
        mixed $passwordConfirm
    ): \Illuminate\Contracts\Validation\Validator {
        return Validator::make([
            'email'                 => $email,
            'password'              => $password,
            'password_confirmation' => $passwordConfirm,
        ], [
            'email'    => 'email',
            'password' => 'required|confirmed',
        ]);
    }
}
