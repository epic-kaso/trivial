<?php namespace TestOauthApp\Command\UserCreation\Oauth;

use TestOauthApp\Command\BaseCommandHandler;
use TestOauthApp\Repository\UserRepository;

class CreateUserViaOauthServiceCommandHandler extends BaseCommandHandler
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
     * @return void
     */
    public function handle($command)
    {
        $oauthProvider = $command->oauthProvider;
        $code = $command->code;

        $token = $oauthProvider->getOauthService()->requestAccessToken($code);
        $OauthUser = $oauthProvider->getOauthUser($token);

        $user = $this->userRepository->createOauthUser($OauthUser);
        $finalUser = $oauthProvider->makeOauthUser($user, $OauthUser);

        $this->dispatchEventsFor($finalUser);

        return $finalUser;
    }

}