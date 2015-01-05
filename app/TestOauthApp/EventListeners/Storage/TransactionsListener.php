<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/5/2015
     * Time: 12:31 PM
     */

    namespace TestOauthApp\EventListeners\Storage;


    use Laracasts\Commander\Events\EventListener;

    class TransactionsListener extends EventListener
    {

        public function whenBuyStorageTransactionCompleted($event)
        {
            //TODO Log transactions to database
        }
    }