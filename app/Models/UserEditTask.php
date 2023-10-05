<?php

namespace App\Models;

use App\Enums\SendingServiceEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin Builder
 */
class UserEditTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sending_service',
        'name',
        'email',
        'city',
        'citizenship',
        'password',
        'confirmation_code',
    ];

    public const SENDING_SERVICE_TELEGRAM = SendingServiceEnum::TELEGRAM;

    public const SENDING_SERVICE_MAIL = SendingServiceEnum::EMAIL;

    public const SENDING_SERVICE_SMS = SendingServiceEnum::SMS;

    public const STATUS_SUCCESS = true;

    public const STATUS_NO_SUCCESS = false;

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
