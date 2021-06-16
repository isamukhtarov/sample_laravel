<?php

declare(strict_types=1);

namespace Modules\User\Virtual\Model;

/**
 * @OA\Schema(
 *     title="Role",
 *     description="Role model",
 *     @OA\Xml(
 *         name="Role"
 *     )
 * )
 */
class Role
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
     *      description="Role display Name",
     *      type="string",
     *      example={"az": "Administator", "ru": "Администратор"}
     * )
     * @var string
     */
    private string $display_name;

    /**
     * @OA\Property(
     *      title="name",
     *      description="Role name",
     *      type="string",
     *      example="admin"
     * )
     * @var string
     */
    private string $name;

    /**
     * @OA\Property(
     *      title="color",
     *      description="Role color",
     *      type="string",
     *      example="#000000"
     * )
     * @var string
     */
    private string $color;
}
