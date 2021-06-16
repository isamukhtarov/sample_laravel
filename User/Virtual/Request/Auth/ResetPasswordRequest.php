<?php


namespace Modules\User\Virtual\Request\Auth;

/**
 * @OA\Schema(
 *      title="User reset password request",
 *      description="User reset password body data",
 *      type="object",
 *      required={"old", "password", "password_confirmation"}
 * )
 */
class ResetPasswordRequest
{
    /**
     * @OA\Property(
     *      title="old",
     *      description="Current password",
     *      example="1234rewq"
     * )
     *
     * @var string
     */
    public string $old;

    /**
     * @OA\Property(
     *      title="password",
     *      description="New password",
     *      example="example28"
     * )
     *
     * @var string
     */
    public string $password;

    /**
     * @OA\Property(
     *      title="password confirmation",
     *      description="New password confirmation",
     *      example="example28"
     * )
     *
     * @var string
     */
    public string $password_confirmation;
}
