<?php

namespace App\Console\Commands;

use App\Actions\CreateUserAccountAction;
use App\Actions\CreateUserAction;
use Illuminate\Console\Command;
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
    public function handle(CreateUserAction $createUserAction, CreateUserAccountAction $createUserAccountAction)
    {
        $email = $this->ask('Email');
        $password = $this->ask('Password');
        $passwordConfirm = $this->ask('Password confirmation');

        $validator = $this->getValidator($email, $password, $passwordConfirm);

        if ($validator->fails()) {
            $this->displayErrors($validator);
        } else {
            try {
                \DB::beginTransaction();
                $user = $createUserAction->execute($email, $password);
                //если нет кошелька создаем пустой (иначе будет ошибка при операциях с балансом)
                if (! $user->account) {
                    $createUserAccountAction->execute($user->id, 0);
                }
                \DB::commit();
            } catch (\Exception $exception) {
                \DB::rollBack();
                $this->error($exception->getMessage());
                return -1;
            }
            $this->info('User created successfully');
        }
        return 0;
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
