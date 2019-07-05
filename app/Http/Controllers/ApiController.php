<?php

namespace App\Http\Controllers;


use App\Http\Response\ApiResponse;


abstract class ApiController extends Controller
{
    final protected function createSuccessResponse(array $data = []): ApiResponse
    {
        return ApiResponse::success($data);
    }

    final protected function createErrorResponse(string $message, string $code): ApiResponse
    {
        return ApiResponse::error($code, $message);
    }

    final protected function createDeletedResponse(): ApiResponse
    {
        return ApiResponse::deleted();
    }

    final protected function createEmptyResponse(): ApiResponse
    {
        return ApiResponse::empty();
    }
    
    final protected function created(array $data): ApiResponse
    {
        return ApiResponse::created($data);
    }
}
