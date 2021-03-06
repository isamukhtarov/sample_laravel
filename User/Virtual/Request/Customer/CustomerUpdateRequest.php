<?php

declare(strict_types=1);

namespace Modules\User\Virtual\Request\Customer;


/**
 * @OA\Schema(
 *      title="Update User request",
 *      description="Update User request body data",
 *      type="object",
 *      required={"email", "phone"}
 * )
 */
class CustomerUpdateRequest
{
    /**
     * @OA\Property(
     *      title="full_name",
     *      description="Full Name",
     *      example="Elman Nasirov"
     * )
     *
     * @var string
     */
    public string $full_name;

    /**
     * @OA\Property(
     *      title="phone",
     *      description="Customer phone",
     *      example="994706654341"
     * )
     *
     * @var string
     */
    public string $phone;

    /**
     * @OA\Property(
     *      title="email",
     *      description="Email",
     *      example="elman@mail.ru"
     * )
     *
     * @var string
     */
    public string $email;

    /**
     * @OA\Property(
     *      title="City",
     *      description="Customer city",
     *      example=1
     * )
     *
     * @var int
     */
    public int $city;

    /**
     * @OA\Property(
     *      title="Address",
     *      description="Customer Address",
     *      example="H.Aliyev kuc."
     * )
     *
     * @var string
     */
    public string $address;

    /**
     * @OA\Property(
     *      title="Address",
     *      description="Customer Address",
     *      example="data:image/jpeg;base64,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"
     * )
     *
     * @var string
     */
    public string $avatar;

    /**
     * @OA\Property(
     *      title="Note",
     *      description="Customer Note",
     *      example="Some Note"
     * )
     *
     * @var string
     */
    public string $note;

    /**
     * @OA\Property(
     *      title="Contacts",
     *      description="Customer Contacts",
     *      @OA\Property (type="string", property="phones", example="994556788998"),
     *      @OA\Property (type="string", property="whatsapp", example="994706752134"),
     * )
     *
     * @var array
     */
    public array $contacts;

    /**
     * @OA\Property(
     *      title="Email notification information",
     *      description="Email notification information",
     *      @OA\Property (type="integer", property="mailing",   example=1),
     *      @OA\Property (type="integer", property="sms", example=0),
     *      @OA\Property (type="integer", property="comments", example=1),
     * )
     *
     * @var array
     */
    public array $email_notify_info;

    /**
     * @OA\Property(
     *      title="SMS notification information",
     *      description="SMS notification information",
     *      @OA\Property (type="integer", property="sms", example=0),
     *      @OA\Property (type="integer", property="comments", example=1),
     * )
     *
     * @var array
     */
    public array $sms_notify_info;
}

