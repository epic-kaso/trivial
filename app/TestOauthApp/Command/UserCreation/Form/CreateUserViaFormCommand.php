<?php namespace TestOauthApp\Command\UserCreation\Form;

class CreateUserViaFormCommand
{
    public $email;
    public $password;
    public $password_confirmation;

    /**
     * @param $email
     * @param $password
     * @param $password_confirmation
     */
    public function __construct($email, $password, $password_confirmation)
    {
        $this->email = $email;
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;
    }

}