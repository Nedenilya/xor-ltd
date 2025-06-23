<?php

namespace App\Ship\Parents\Controllers;

use Apiato\Core\Controllers\ApiController as AbstractApiController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class ApiController extends AbstractApiController
{
    use AuthorizesRequests;
}
