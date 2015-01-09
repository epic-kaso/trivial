<?php

class DevelopersPageController extends \BaseController {


    function __construct()
    {
        $this->beforeFilter('auth');
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//
	}

    public function getApps(){

    }

    public function postApps(){

    }

    public function deleteApps($hashcode){

    }
}
