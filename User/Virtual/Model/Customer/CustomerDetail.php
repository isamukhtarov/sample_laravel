<?php

declare(strict_types=1);

namespace Modules\User\Virtual\Model\Customer;

/**
 * @OA\Schema(
 *     title="Customer Detail",
 *     description="Customer Detail model",
 *     @OA\Xml(
 *         name="Customer Detail"
 *     )
 * )
 */
class CustomerDetail extends Customer
{
    /**
     * @OA\Property(
     *      title="Block reason",
     *      description="Customer block reason",
     *      type="string",
     *      example={"id": 2, "title": {"az": "Sehf bashliq", "ru": "Некорректный заголовок"}, "type": "customer"}
     * )
     */
    private string $block_reason;

    /**
     * @OA\Property(
     *      title="Block description",
     *      description="Customer block description",
     *      type="string",
     *      example="Additional block reason info"
     * )
     */
    private string $block_description;
}
