<?php namespace TestOauthApp\Command\StoragePurchase;

class BuyStorageSpaceViaCreditCardCommand
{
    public $creditCardTransactionResponse;
    public $storageSpaceData;

    /**
     * @param $creditCardTransactionResponse
     * @param $storageSpaceData
     */
    public function __construct($creditCardTransactionResponse, $storageSpaceData)
    {
        $this->creditCardTransactionResponse = $creditCardTransactionResponse;
        $this->storageSpaceData = $storageSpaceData;
    }

}