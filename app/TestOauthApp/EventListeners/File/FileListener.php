<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/5/2015
     * Time: 1:31 PM
     */

    namespace TestOauthApp\EventListeners\File;


    use Laracasts\Commander\Events\EventListener;

    class FileListener extends EventListener
    {

        public function whenCustomerPurchasesFile($event)
        {
            $customer = $event->getCustomer();
            $file = $event->getUserFile();

        }
    }