<?php

namespace App\Enums;

enum SendingServiceEnum: int
{
    case TELEGRAM = 0;
    case SMS = 1;
    case EMAIL = 2;
}
