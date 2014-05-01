<?php

namespace Uptime\System;

interface SystemInterface
{
    public function getUptime();
    public function getBoottime();
}
