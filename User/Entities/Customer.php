<?php

declare(strict_types=1);

namespace Modules\User\Entities;

use Carbon\Carbon;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Message\Entities\Chat;
use Modules\Region\Entities\City;
use Modules\Settings\Entities\Block;
use Modules\User\Database\factories\CustomerFactory;
use Modules\User\ModelFilters\CustomerFilter;

/**
 * @property int id
 * @property string email
 * @property string|null full_name
 * @property string password
 * @property string phone
 * @property string address
 * @property int city_id
 * @property City city
 * @property string|null $note
 * @property bool is_confirmed
 * @property array|null contacts
 * @property array email_notify_info
 * @property array sms_notify_info
 * @property bool is_blocked
 * @property string avatar
 * @property Carbon|null created_at
 * @property Carbon|null updated_at
 * @property Carbon|null last_login
 * @property Block block
 */
class Customer extends Model
{
    use HasFactory, Filterable;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'contacts' => 'array',
        'email_notify_info' => 'array',
        'sms_notify_info' => 'array'
    ];

    protected static function newFactory(): CustomerFactory
    {
        return CustomerFactory::new();
    }

    public function getModelFilterClass(): string
    {
        return $this->provideFilter(CustomerFilter::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function block(): Relation
    {
        return $this->morphOne(Block::class, 'blockable');
    }


    public function senders(): MorphMany
    {
      return $this->morphMany(Chat::class,'sender');
    }

    public function recipients(): MorphMany
    {
        return $this->morphMany(Chat::class,'recipient');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function setFullName(?string $full_name): self
    {
        $this->full_name = $full_name;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function setCityId(int $city_id): self
    {
        $this->city_id = $city_id;
        return $this;
    }

    public function setContacts(?array $contacts): self
    {
        $this->contacts = $contacts;
        return $this;
    }

    public function setSmsNotifyInfo(array $sms_notify_info): self
    {
        $this->sms_notify_info = $sms_notify_info;
        return $this;
    }

    public function setEmailNotifyInfo(array $email_notify_info): self
    {
        $this->email_notify_info = $email_notify_info;
        return $this;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;
        return $this;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;
        return $this;
    }

}
