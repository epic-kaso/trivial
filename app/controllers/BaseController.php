<?php

    use Laracasts\Commander\CommanderTrait;
    use Laracasts\Commander\Events\DispatchableTrait;

    class BaseController extends Controller
    {

        use DispatchableTrait, CommanderTrait;

        function __construct()
        {
            $this->beforeFilter(function () {
                Event::fire('clockwork.controller.start');
            });

            $this->afterFilter(function () {
                Event::fire('clockwork.controller.end');
            });
        }


        /**
         * Setup the layout used by the controller.
         *
         * @return void
         */
        protected function setupLayout()
        {
            if (!is_null($this->layout)) {
                $this->layout = View::make($this->layout);
            }
        }

    }
