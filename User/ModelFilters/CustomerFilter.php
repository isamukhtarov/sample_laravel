<?php

namespace Modules\User\ModelFilters;

use Carbon\Carbon;
use Doctrine\DBAL\Event\SchemaEventArgs;
use EloquentFilter\ModelFilter;

class CustomerFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function id(int $id): self
    {
        return $this->where('id', $id);
    }

    public function email(string $emailPart): self
    {
        return $this->where('email', 'LIKE', "%{$emailPart}%");
    }

    public function city(int $id): self
    {
        return $this->related('city', 'city_id', '=', $id);
    }

    /**
     * @param string $from
     * @return CustomerFilter|void
     */
    public function fromR(string $from)
    {
        if (strtotime($from)) {
            $r_from = Carbon::parse($from);
            return $this->whereDate('created_at', '>=', $r_from->format('Y-m-d'));
        }
    }

    /**
     * @param string $to
     * @return CustomerFilter|void
     */
    public function rTo(string $to)
    {
        if (strtotime($to)) {
            $to = Carbon::parse($to);
            return $this->whereDate('created_at', '<=', $to->format('Y-m-d'));
        }
    }

    /**
     * @param string $from
     * @return CustomerFilter|void
     */
    public function fromL(string $from)
    {
        if (strtotime($from)) {
            $r_from = Carbon::parse($from);
            return $this->whereDate('last_login', '>=', $r_from->format('Y-m-d'));
        }
    }

    /**
     * @param string $to
     * @return CustomerFilter|void
     */
    public function lTo(string $to)
    {
        if (strtotime($to)) {
            $to = Carbon::parse($to);
            return $this->whereDate('last_login', '<=', $to->format('Y-m-d'));
        }
    }

    public function confirm(int $status): self
    {
        return $this->where('is_confirmed', '=', $status);
    }

    public function blocked(int $status): self
    {
        return $this->where('is_blocked', '=', $status);
    }
}
