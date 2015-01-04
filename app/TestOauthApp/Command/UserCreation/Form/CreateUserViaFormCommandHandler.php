<?php namespace TestOauthApp\Command\UserCreation\Form;


use TestOauthApp\Command\BaseCommandHandler;
use TestOauthApp\Repository\UserRepository;

class CreateUserViaFormCommandHandler extends BaseCommandHandler
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle the command.
     *
     * @param object $command
     * @return mixed
     */
    public function handle($command)
    {
        $user = $this->userRepository->createFormUser($command->email, $command->password);
        $this->dispatchEventsFor($user);

        return $user;
    }

}