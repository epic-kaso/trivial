<?php namespace TestOauthApp\Command\StoragePurchase;

use Auth;
use TestOauthApp\Command\BaseCommandHandler;
use TestOauthApp\Command\FilePurchase\TransactionNotApprovedException;
use TestOauthApp\Events\Storage\BuyStorageTransactionCompleted;
use TestOauthApp\Repository\StorageSpaceRepository;
use TestOauthApp\Services\File\Size;
use TestOauthApp\Services\Payment\CreditCardPayment;

class BuyStorageSpaceViaCreditCardCommandHandler extends BaseCommandHandler
{


    protected $storageSpaceRepo;

    function __construct(StorageSpaceRepository $storageSpaceRepo)
    {
        $this->storageSpaceRepo = $storageSpaceRepo;
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
        $storageSpaceData = Size::Bytes($command->storageSpaceData->size);

        if (!$transactionResponse->isOrderApproved()) {
            throw new TransactionNotApprovedException("Transaction not approved");
        }

        $user = $this->storageSpaceRepo->addStorageSpaceToUser($storageSpaceData, Auth::user());
        $user->raise(new BuyStorageTransactionCompleted($transactionResponse));

        $this->dispatchEventsFor($user);

        return TRUE;
    }

}