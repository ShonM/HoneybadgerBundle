<?php

namespace Chesscom\HoneybadgerBundle\EventListener;

use Honeybadger\Exception;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener
{
    protected $ignoredExceptions;

    public function __construct(array $ignoredExceptions = array())
    {
        $this->ignoredExceptions = $ignoredExceptions;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        foreach ($this->ignoredExceptions as $ignoredException) {
            if ($exception instanceof $ignoredException) {
                return;
            }
        }

        Exception::handle($exception);
        error_log($exception->getMessage().' in: '.$exception->getFile().':'.$exception->getLine());
    }
}
