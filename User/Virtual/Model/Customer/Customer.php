<?php

declare(strict_types=1);

namespace Modules\User\Virtual\Model\Customer;

use DateTime;

/**
 * @OA\Schema(
 *     title="Customer",
 *     description="Customer model",
 *     @OA\Xml(
 *         name="Customer"
 *     )
 * )
 */
class Customer
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
     *      title="Email",
     *      description="Customer email",
     *      type="string",
     *      example="elmin91@mail.ru"
     * )
     */
    private string $email;

    /**
     * @OA\Property(
     *      title="Full Name",
     *      description="User full name",
     *      type="string",
     *      example="Elmin Alizade"
     * )
     */
    private string $full_name;

    /**
     * @OA\Property(
     *      title="Phone",
     *      description="Customer phone",
     *      type="string",
     *      example="994709057886"
     * )
     */
    private string $phone;

    /**
     * @OA\Property(
     *      title="Address",
     *      description="Customer address",
     *      type="string",
     *      example="Example street"
     * )
     */
    private string $address;

    /**
     * @OA\Property(
     *      title="Address",
     *      description="Customer avatar",
     *      type="string",
     *      example="http://current.domain/storage/customer/avatars/215101202122019uJqZdZls-1621405645.jpg"
     * )
     */
    private string $avatar;

    /**
     * @OA\Property(
     *      title="City",
     *      description="Customer city",
     *      type="string",
     *      example={"id": 1, "title": {"az": "Baki", "ru": "Баку"}}
     * )
     */
    private string $city;

    /**
     * @OA\Property(
     *      title="Contacts",
     *      description="Customer contacts",
     *      type="string",
     *      example={"phones": "994556788998", "whatssap": "994706752134"}
     * )
     */
    private string $contacts;

    /**
     * @OA\Property(
     *      title="Note",
     *      description="Customer note",
     *      type="string",
     *      example="Some note"
     * )
     */
    private string $note;

    /**
     * @OA\Property(
     *      title="Email notification info",
     *      description="Customer email notification info",
     *      type="string",
     *      example={"mailing": 1, "sms": 1, "comments": 0}
     * )
     */
    private string $email_notify_info;

    /**
     * @OA\Property(
     *      title="Email notification info",
     *      description="Customer email notification info",
     *      type="string",
     *      example={"sms": 1, "comments": 1}
     * )
     */
    private string $sms_notify_info;

    /**
     * @OA\Property(
     *     title="Last login",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     */
    private DateTime $last_login;

    /**
     * @OA\Property(
     *      title="Customer block status",
     *      description="Customer block status",
     *      type="int",
     *      example=0
     * )
     */
    private int $is_blocked;
}
