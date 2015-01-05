<?php namespace TestOauthApp\Command\FilePurchase;

use TestOauthApp\Command\BaseCommandHandler;
use TestOauthApp\Events\File\CustomerPurchasesFile;
use TestOauthApp\Services\Payment\CreditCardPayment;

class BuyFileViaCreditCardCommandHandler extends BaseCommandHandler
{

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

        $customer = $transactionResponse->getCustomer();

        $customer->raise(new CustomerPurchasesFile($customer, $userFile));

        $this->dispatchEventsFor($customer);

        return TRUE;
    }

}