<?php

declare(strict_types=1);

namespace Modules\User\Virtual\Model;

/**
 * @OA\Schema(
 *     title="Permission",
 *     description="Permission model",
 *     @OA\Xml(
 *         name="Permission"
 *     )
 * )
 */
class Permission
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     type="integer",
     *     example=1
     * )
     */
    private int $id;

    /**
     * @OA\Property(
     *      title="display_name",
     *      description="Permission display Name",
     *      type="string",
     *      example={"az": "Bloklanma səbəbinin yaradəlması", "ru": "Создание причины блокировки"}
     * )
     * @var string
     */
    private string $display_name;

    /**
     * @OA\Property(
     *      title="name",
     *      description="Permission name",
     *      type="string",
     *      example="blockReasons-create"
     * )
     * @var string
     */
    private string $name;
}
