<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 1:27 PM
     */

    namespace TestOauthApp\Command;


    use Laracasts\Commander\CommandHandler;
    use Laracasts\Commander\Events\DispatchableTrait;

    abstract class BaseCommandHandler implements CommandHandler
    {
        use DispatchableTrait;
    }