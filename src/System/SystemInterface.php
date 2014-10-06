<?php

namespace Uptime\System;

interface SystemInterface
{
    public function getSystem();
    public function getUptime();
    public function getBoottime();
}
