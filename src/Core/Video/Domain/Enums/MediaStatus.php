<?php

namespace Core\Video\Domain\Enums;

enum MediaStatus: int
{
    case PROCESSING = 0;
    case COMPLETE = 1;
    case PENDING = 2;
}
