<?php namespace TestOauthApp\Command\FilePurchase;

use UserFile;

class BuyFileViaCreditCardCommand
{

    public $creditCardTransactionResponse;
    public $userFile;

    /**
     * @param $creditCardTransactionResponse
     * @param UserFile $userFile
     */
    public function __construct($creditCardTransactionResponse, UserFile $userFile)
    {
        $this->creditCardTransactionResponse = $creditCardTransactionResponse;
        $this->userFile = $userFile;
    }

}