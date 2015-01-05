<?php namespace TestOauthApp\Command\FilePurchase;

use Exception;
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
     * @return void
     */
    public function handle($command)
    {
        $transactionResponse = $command->creditCardTransactionResponse;
        $userFile = $command->userFile;

        try {
            $transactionArray = $this->creditCardPayment->processResponse($transactionResponse);

            dd($transactionArray);
        } catch (Exception $ex) {

        }

    }

}