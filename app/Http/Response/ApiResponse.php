<?php

namespace App\Http\Response;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\JsonResponse;

class ApiResponse extends JsonResponse
{
    /**
     * @param  iterable  $data
     * @param  int  $status
     * @param  array|null  $extraFields
     * @return JsonResponse
     */
    public static function success(
        iterable $data,
        int $status = self::HTTP_OK,
        ?array $extraFields = null
    ): JsonResponse {
        $responseData = self::successDataStructure($data, extraFields: $extraFields);

        return new parent($responseData, $status);
    }

    /**
     * Sending token's response.
     *
     * @param  User  $user
     * @return JsonResponse
     */
    public static function token(User $user): JsonResponse
    {
        return self::created([
            'user'       => $user,
            'token'      => $user->createToken('user')->accessToken->token,
            'type'       => 'bearer',
        ]);
    }

    /**
     * @param  iterable  $data
     * @return JsonResponse
     */
    public static function created(iterable $data): JsonResponse
    {
        return self::success($data, self::HTTP_CREATED);
    }

    /**
     * @return JsonResponse
     */
    public static function updated(): JsonResponse
    {
        return self::success([], self::HTTP_NO_CONTENT);
    }

    /**
     * @return JsonResponse
     */
    public static function deleted(): JsonResponse
    {
        return self::updated();
    }

    /**
     * @param  Builder  $builder
     * @param  int  $paginate
     * @return JsonResponse
     */
    public static function paginate(Builder $builder, int $paginate = 15): JsonResponse
    {
        $paginate = $builder->paginate($paginate);
        return self::success($paginate);
    }

    /**
     * @param  string  $errorMessage
     * @param  iterable|null  $errors
     * @param  int  $status
     * @return JsonResponse
     */
    public static function error(
        string $errorMessage,
        ?iterable $errors = null,
        int $status = self::HTTP_BAD_REQUEST
    ): JsonResponse {
        $responseStructure = self::errorDataStructure($errorMessage, $errors);

        return new parent($responseStructure, $status);
    }

    /**
     * @param  string  $errorMessage
     * @param  iterable|null  $errors
     * @return JsonResponse
     */
    public static function generalError(string $errorMessage, ?iterable $errors = null): JsonResponse
    {
        return self::error($errorMessage, $errors, self::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @param  string|null  $errorMessage
     * @param  iterable|null  $errors
     * @return JsonResponse
     */
    public static function unauthorized(?string $errorMessage = null, ?iterable $errors = null): JsonResponse
    {
        $errorMessage ??= 'Unauthorized!';

        return self::error($errorMessage, $errors, self::HTTP_UNAUTHORIZED);
    }

    /**
     * @param  string|null  $errorMessage
     * @param  iterable|null  $errors
     * @return JsonResponse
     */
    public static function forbidden(?string $errorMessage = null, ?iterable $errors = null): JsonResponse
    {
        $errorMessage ??= 'You do not have permission for this request!';

        return self::error($errorMessage, $errors, self::HTTP_FORBIDDEN);
    }

    /**
     * @param  Validator  $validator
     * @return JsonResponse
     */
    public static function rejection(Validator $validator): JsonResponse
    {
        $messageBag = $validator->getMessageBag();
        $errorMessage = $messageBag->first();

        $errors = $messageBag->toArray();

        return self::error($errorMessage, $errors, self::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @param  string|null  $errorMessage
     * @param  iterable|null  $errors
     * @return JsonResponse
     */
    public static function notFound(?string $errorMessage = null, ?iterable $errors = null): JsonResponse
    {
        $errorMessage ??= 'The requested data could not be found!';

        return self::error($errorMessage, $errors, self::HTTP_NOT_FOUND);
    }

    /**
     * @param  iterable|null  $data
     * @param  iterable|null  $errors
     * @param  string|null  $errorMessage
     * @param  bool  $success
     * @param  array|null  $extraFields
     * @return array
     */
    private static function responseDataStructure(
        ?iterable $data = null,
        ?iterable $errors = null,
        ?string $errorMessage = null,
        bool $success = true,
        ?array $extraFields = null
    ): array {
        $fields = [];
        if (is_array($extraFields)) {
            $fields = array_keys($extraFields);
            extract($extraFields);
        }
        return compact('data', 'errors', 'errorMessage', 'success', ...$fields);
    }

    /**
     * @param  iterable  $data
     * @param  array|null  $extraFields
     * @return array
     */
    private static function successDataStructure(iterable $data, ?array $extraFields = null): array
    {
        return self::responseDataStructure($data, extraFields: $extraFields);
    }

    /**
     * @param  string  $errorMessage
     * @param  iterable|null  $errors
     * @return array
     */
    private static function errorDataStructure(string $errorMessage, ?iterable $errors): array
    {
        return self::responseDataStructure(errors: $errors, errorMessage: $errorMessage, success: false);
    }
}
