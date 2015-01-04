<?php namespace TestOauthApp\Command\UserCreation\Oauth;

use TestOauthApp\OauthServices\OauthServiceInterface;

class CreateUserViaOauthServiceCommand
{

    public $oauthProvider;
    public $code;

    /**
     * @param OauthServiceInterface $oauthProvider
     * @param $code
     * @internal param $oauthService
     */
    public function __construct(OauthServiceInterface $oauthProvider, $code)
    {
        $this->oauthProvider = $oauthProvider;
        $this->code = $code;
    }
}