<?php

namespace RafflePrizes\exceptions;

class NotFoundHttpException extends \Exception
{
    protected $message = '404 Not Found';
}