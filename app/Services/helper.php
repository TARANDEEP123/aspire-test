<?php

use Symfony\Component\Debug\Exception\FatalThrowableError;

/**
 * Success flag for frontend
 * @param string $response
 * @return \Illuminate\Http\JsonResponse
 */
function success ($response = 'Processed')
{
    return response()->json(['success' => true, 'response' => $response]);
}

/**
 * Failure flag for frontend
 * @param string $response
 * @return \Illuminate\Http\JsonResponse
 */
function failure ($response = 'Something went wrong!')
{
    return response()->json(['success' => false, 'response' => $response]);
}
