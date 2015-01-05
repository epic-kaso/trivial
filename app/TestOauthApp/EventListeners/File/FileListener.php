<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/5/2015
     * Time: 1:31 PM
     */

    namespace TestOauthApp\EventListeners\File;


    use Laracasts\Commander\Events\EventListener;
    use Mail;
    use TestOauthApp\Services\File\FileDownloadService;

    class FileListener extends EventListener
    {
        /**
         * @var FileDownloadService
         */
        private $fileDownloadService;

        function __construct(FileDownloadService $fileDownloadService)
        {
            $this->fileDownloadService = $fileDownloadService;
        }

        public function whenCustomerPurchasesFile($event)
        {
            $customer = $event->getCustomer();
            $file = $event->getUserFile();

            $this->sendFileToUser($file, $customer);
        }

        private function sendFileToUser($file, $customer)
        {
            $path = $this->fileDownloadService->downloadZip($file->getPath(), $file->name);

            Mail::queue('emails.file-purchase',
                ['name' => $customer->getName()], function ($message) use ($customer, $path) {
                    $message->from('no-reply@kaso.co', 'MediaHubb File Purchase');

                    $message->to($customer->getEmail());

                    $message->attach($path);
                });
        }
    }