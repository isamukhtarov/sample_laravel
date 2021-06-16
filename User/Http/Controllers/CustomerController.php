<?php

namespace Modules\User\Http\Controllers;

use http\Url;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Modules\Core\CommandBus\CommandBusInterface;
use Modules\Core\Http\Controllers\ApiController;
use Modules\Settings\Entities\BlockReason;
use Modules\Settings\Transformers\BlockReasonResource;
use Modules\User\Commands\Customer\BlockCustomerCommand;
use Modules\User\Commands\Customer\CreateCustomerCommand;
use Modules\User\Commands\Customer\DeleteCustomerAvatarCommand;
use Modules\User\Commands\Customer\UnblockCustomerCommand;
use Modules\User\Commands\Customer\UpdateCustomerCommand;
use Modules\User\Entities\Customer;
use Modules\Settings\Entities\BlockReason\BlockReasonType;
use Modules\User\Http\Requests\Customer\BlockCustomerRequest;
use Modules\User\Http\Requests\Customer\CustomerStoreRequest;
use Modules\User\Http\Requests\Customer\CustomerUpdateRequest;
use Modules\User\Transformers\Resource\Customer\CustomerDetailResource;
use Modules\User\Transformers\Resource\Customer\CustomerResource;

class CustomerController extends ApiController
{
    private CommandBusInterface $bus;

    public function __construct(CommandBusInterface $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @OA\Get(
     *      tags={"Customer"},
     *      path="/api/customers",
     *      summary="Get customers data",
     *      description="Returns customers data",
     *      @OA\Parameter(
     *          name="perPage",
     *          description="per page value",
     *          in="query",
     *          example="10"
     *      ),
     *     @OA\Parameter(
     *          name="id",
     *          description="Search by id",
     *          in="query",
     *          example="1"
     *      ),
     *     @OA\Parameter(
     *          name="email",
     *          description="Search by email(whole or part of email string)",
     *          in="query",
     *          example="gerry57@example.org"
     *      ),
     *     @OA\Parameter(
     *          name="email",
     *          description="Search by email(whole or part of email string)",
     *          in="query",
     *          example="gerry57@example.org"
     *      ),
     *     @OA\Parameter(
     *          name="city",
     *          description="Search by city id",
     *          in="query",
     *          example="5"
     *      ),
     *     @OA\Parameter(
     *          name="fromR",
     *          description="Search by registration date(from this date)",
     *          in="query",
     *          example="26-05-2021"
     *      ),
     *     @OA\Parameter(
     *          name="rTo",
     *          description="Search by registration date(until this date)",
     *          in="query",
     *          example="01-06-2021"
     *      ),
     *     @OA\Parameter(
     *          name="fromL",
     *          description="Search by last login date(from this date)",
     *          in="query",
     *          example="26-05-2021"
     *      ),
     *     @OA\Parameter(
     *          name="lTo",
     *          description="Search by last login date(until this date)",
     *          in="query",
     *          example="01-06-2021"
     *      ),
     *     @OA\Parameter(
     *          name="confirm",
     *          description="Search by confirm status(flag)",
     *          in="query",
     *          example="1"
     *      ),
     *    @OA\Parameter(
     *          name="blocked",
     *          description="Search by blocked status(status)",
     *          in="query",
     *          example="1"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       )
     * )
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = !empty($request->perPage) ? (int)$request->perPage : 20;
        $customers = Customer::filter($request->all())->paginate($perPage);
        return CustomerResource::collection($customers);
    }

    /**
     * @OA\Post(
     *      tags={"Customer"},
     *      path="/api/customer/create",
     *      operationId="customer-create",
     *      summary="Customer Create",
     *      description="Create customer user return response data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CustomerStoreRequest")
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *       ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation", @OA\JsonContent(ref="#/components/schemas/Customer")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *      )
     * )
     * @param CustomerStoreRequest $request
     * @return JsonResponse
     */
    public function store(CustomerStoreRequest $request): JsonResponse
    {
        $command = new CreateCustomerCommand();
        $this->bus->dispatch($command, $request->all());
        $customer = Customer::with('city:id,title')->findOrFail($command->id);
        return (new CustomerDetailResource($customer))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      tags={"Customer"},
     *      path="/api/customer/{id}/edit",
     *      operationId="customer-data",
     *      summary="Customer Data",
     *      description="Return customer data by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Customer id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *       ),
     *     @OA\Response(
     *          response=404,
     *          description="Not found",
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation", @OA\JsonContent(ref="#/components/schemas/CustomerDetail")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *      )
     * )
     * @param int $id
     * @return JsonResponse|CustomerDetailResource
     */
    public function edit(int $id)
    {
        if (!($customer = Customer::with('block')->find($id)))
            return $this->notFountObjectRespond('Customer', $id);
        return new CustomerDetailResource($customer);
    }

    /**
     * @OA\Put(
     *      tags={"Customer"},
     *      path="/api/customer/{id}/edit",
     *      operationId="customer-edit",
     *      summary="Customer Edit",
     *      description="Edit customer data return response data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Customer id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CustomerUpdateRequest")
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *       ),
     *     @OA\Response(
     *          response=404,
     *          description="Not Found",
     *       ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation", @OA\JsonContent(ref="#/components/schemas/CustomerDetail")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *      )
     * )
     * @param CustomerUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CustomerUpdateRequest $request, int $id): JsonResponse
    {
        if (!(Customer::find($id)))
            return $this->notFountObjectRespond('Customer', $id);

        $command = new UpdateCustomerCommand($id);
        $this->bus->dispatch($command, $request->all());
        return (new CustomerDetailResource($command->customer))->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Post(
     *      tags={"Customer"},
     *      path="/api/customer/{id}/block",
     *      operationId="customer-block",
     *      summary="Customer Block",
     *      description="Block customer data return result message",
     *      @OA\Parameter(
     *          name="id",
     *          description="Customer id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CustomerBlockRequest")
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * @param BlockCustomerRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function block(BlockCustomerRequest $request, int $id): JsonResponse
    {
        if (!($customer = Customer::find($id)))
            return $this->notFountObjectRespond('Customer', $id);

        $command = new BlockCustomerCommand($id);
        $this->bus->dispatch($command, $request->all());
        return response()->json([
            'message' => "Customer with id {$id} blocked successfully"
        ]);
    }

    /**
     * @OA\Post(
     *      tags={"Customer"},
     *      path="/api/customer/{id}/unblock",
     *      operationId="customer-unblock",
     *      summary="Customer Unblock",
     *      description="Unblock customer data return result message",
     *      @OA\Parameter(
     *          name="id",
     *          description="Customer id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function unblock(Request $request, int $id): JsonResponse
    {
        if (!($customer = Customer::find($id)))
            return $this->notFountObjectRespond('Customer', $id);

        if (!$customer->is_blocked && !$customer->block)
            return response()->json([
                'message' => 'Given customer is not blocked'
            ], Response::HTTP_FORBIDDEN);

        $command = new UnblockCustomerCommand($id);
        $this->bus->dispatch($command, $request->all());
        return response()->json([
            'message' => "Customer with id {$id} unblocked successfully"
        ]);
    }

    /**
     * * @OA\Get(
     *      tags={"Customer"},
     *      path="/api/customer/block-reasons",
     *      summary="Customer Block Reasons list",
     *      description="Get customer block reasons data",
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(ref="#/components/schemas/BlockReason")
     *       )
     * )
     */
    public function customerBlockReasons(): AnonymousResourceCollection
    {
        $reasons = BlockReason::query()->where('type', '=', BlockReasonType::CUSTOMER)->get();
        return BlockReasonResource::collection($reasons);
    }

    /**
     * @OA\Post(
     *      tags={"Customer"},
     *      path="/api/customer/{id}/avatar/delete",
     *      operationId="customer-avatar-delete",
     *      summary="Customer avatar delete",
     *      description="Delete customer avatar and return result message",
     *      @OA\Parameter(
     *          name="id",
     *          description="Customer id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       )
     * )
     * @param int $id
     * @return JsonResponse
     */
    public function deleteAvatar(int $id): JsonResponse
    {
        if (!($customer = Customer::find($id)))
            return $this->notFountObjectRespond('Customer', $id);

        if (!$customer->avatar)
            return response()->json([
                'message' => "This customer does not have avatar yet"
            ], Response::HTTP_FORBIDDEN);

        $command = new DeleteCustomerAvatarCommand($id);
        $this->bus->dispatch($command);
        return response()->json([
            'message' => "Customer avatar deleted successfully"
        ]);
    }
}
