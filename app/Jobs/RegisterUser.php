<?php

namespace Api\Jobs;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Api\Mail\UserRegistered;
use Api\Repositories\UserProfileRepository;
use Api\Repositories\UserRepository;

class RegisterUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $surname;
    /**
     * @var
     */
    private $email;
    /**
     * @var
     */
    private $password;

    /**
     * Create a new job instance.
     *
     * @param $name
     * @param $surname
     * @param $email
     * @param $password
     */
    public function __construct($name, $surname, $email, $password)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Execute the job.
     * @param UserRepository $userRepository
     * @param UserProfileRepository $userProfileRepository
     * @return EloquentUser $user;
     */
    public function handle(UserRepository $userRepository, UserProfileRepository $userProfileRepository)
    {
        $profileAttributes = [
            'first_name' => $this->name ?? null,
            'last_name' => $this->surname ?? null,
        ];

        $user = $userRepository->register($this->email, $this->password, $this->name, $this->surname);

        $user->profile()->create($profileAttributes);

        return $user;
    }
}
