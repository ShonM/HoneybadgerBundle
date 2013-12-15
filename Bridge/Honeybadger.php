<?php

namespace Chesscom\HoneybadgerBundle\Bridge;

use Honeybadger\Honeybadger as BaseHoneyBadger;

class Honeybadger extends BaseHoneyBadger
{
    public function __construct(Config $config)
    {
        parent::__construct($config);
    }
}
