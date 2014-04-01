<?php

namespace Uptime;

use DateTime;

class Boottime extends DateTime
{

    protected $time;

    public function __construct($boottime)
    {
        $this->time = (int) $boottime;
        parent::__construct( '@' . $this->time );
    }

    public function __toString()
    {
        return $this->format('Y-m-d H:i:s');
    }

    public function getRaw()
    {
        return $this->time;
    }
}
