<?php namespace TestOauthApp\Command\FilePurchase;

use TestOauthApp\Command\BaseCommandHandler;
use TestOauthApp\Events\File\CustomerPurchasesFile;
use TestOauthApp\Services\File\FileDownloadService;
use TestOauthApp\Services\Payment\CreditCardPayment;

class BuyFileViaCreditCardCommandHandler extends BaseCommandHandler
{
    /**
     * @var FileDownloadService
     */
    private $fileDownloadService;

    function __construct(FileDownloadService $fileDownloadService)
    {
        $this->fileDownloadService = $fileDownloadService;
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
        $user = $userFile->user;

        if (!$transactionResponse->isOrderApproved() ||
            ($transactionResponse->getTransactionAmount() < $userFile->getPrice())
        ) {
            throw new TransactionNotApprovedException("Transaction not approved");
        }

        $customer = $transactionResponse->getCustomer();

        $customer->raise(new CustomerPurchasesFile($customer, $userFile));

        $user->handleFilePayment($userFile);

        $this->dispatchEventsFor($customer);

        return $this->fileDownloadService->makeDownloadResponse($userFile, $this->fileDownloadService->download($userFile->getPath()));
    }

}