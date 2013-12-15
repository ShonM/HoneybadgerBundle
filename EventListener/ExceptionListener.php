<?php

namespace Chesscom\HoneybadgerBundle\EventListener;

use Chesscom\HoneybadgerBundle\Bridge\Honeybadger;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener
{
    protected $honeybadger;

    protected $ignoredExceptions;

    public function __construct(Honeybadger $honeybadger, array $ignoredExceptions = array())
    {
        $this->honeybadger = $honeybadger;
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

        error_log($exception->getMessage() . ' in: ' . $exception->getFile() . ':' . $exception->getLine());

        $this->honeybadger->handleException($exception);
    }
}
