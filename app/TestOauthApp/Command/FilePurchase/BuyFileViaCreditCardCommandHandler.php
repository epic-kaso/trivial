<?php namespace TestOauthApp\Command\FilePurchase;

use TestOauthApp\Command\BaseCommandHandler;
use TestOauthApp\Services\Payment\CreditCardPayment;

class BuyFileViaCreditCardCommandHandler extends BaseCommandHandler
{


    /**
     * @var CreditCardPayment
     */
    private $creditCardPayment;

    function __construct(CreditCardPayment $creditCardPayment)
    {
        $this->creditCardPayment = $creditCardPayment;
    }


    /**
     * Handle the command.
     *
     * @param object $command
     * @return mixed|void
     * @throws TransactionNotApprovedException
     */
    public function handle($command)
    {
        $transactionResponse = CreditCardPayment::newInstance($command->creditCardTransactionResponse);
        $userFile = $command->userFile;

        if (!$transactionResponse->isOrderApproved() ||
            ($transactionResponse->getTransactionAmount() < $userFile->getPrice())
        ) {
            throw new TransactionNotApprovedException("Transaction not approved");
        }
    }

}