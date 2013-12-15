<?php

namespace Chesscom\HoneybadgerBundle\EventListener;

use Chesscom\HoneybadgerBundle\Bridge\Honeybadger;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class ShutdownListener
{
    protected $honeybadger;

    public function __construct(Honeybadger $honeybadger)
    {
        $this->honeybadger = $honeybadger;
    }

    public function register(FilterControllerEvent $event)
    {
        register_shutdown_function(array($this, 'onShutdown'));
    }

    public function onShutdown()
    {
        if (!$error = error_get_last()) {
            return;
        }

        $fatal  = array(E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR, E_RECOVERABLE_ERROR);
        if (!in_array($error['type'], $fatal)) {
            return;
        }

        $message   = '[Shutdown Error]: %s';
        $message   = sprintf($message, $error['message']);
        error_log($message.' in: '.$error['file'].':'.$error['line']);

        $this->honeybadger->handleError($error['type'], $error, $error['file'], $error['line']);
    }
}
