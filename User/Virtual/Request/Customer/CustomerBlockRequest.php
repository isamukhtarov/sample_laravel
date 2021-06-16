<?php

declare(strict_types=1);

namespace Modules\User\Virtual\Request\Customer;

/**
 * @OA\Schema(
 *      title="Block Customer request",
 *      description="Block Customer request body data",
 *      type="object",
 *      required={"reason_id"}
 * )
 */
class CustomerBlockRequest
{
    /**
     * @OA\Property(
     *      title="reason_id",
     *      description="Block Reason id",
     *      example="2"
     * )
     *
     * @var int
     */
    public int $reason_id;

    /**
     * @OA\Property(
     *      title="description",
     *      description="Block Reason additional description",
     *      example="Additional block reason info"
     * )
     *
     * @var string
     */
    public string $description;
}
