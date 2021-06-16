<?php

declare(strict_types=1);

namespace Modules\User\Commands\Customer;

use Illuminate\Http\UploadedFile;
use Modules\Core\CommandBus\Command;

class CustomerCommand extends Command
{
    public int $id;
    public string $email;
    public ?string $full_name = null;
    public string $phone;
    public ?string $avatar = null;
    public ?int $city = null;
    public array $contacts = [];
    public ?string $note = null;
    public ?string $address = null;
    public array $email_notify_info;
    public array $sms_notify_info;
}
