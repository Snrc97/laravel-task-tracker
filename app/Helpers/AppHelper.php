<?php

use App\Models\UserModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

CONST PER_PAGE = 10;

function apiResponse($data = [], $status = 200, $message = null, array $params = []): JsonResponse
{
    $recordsFiltered = 0;
    if(is_array($data))
    {
        $recordsFiltered = count($data);
    }
    else if(is_object($data))
    {
        $recordsFiltered = 1;
    }

    switch($status) {

        case 200:
        case 201:
        case 204:
            $message ??= __('all.success');
        break;



        default:

            $message ??= __('all.unknown_error') ;

    }

    $recordsTotal = 0;
    if(is_array($data))
    {

        $start = (int)$params['start'] ?? 0;
        $length = (int)$params['length'] ?? PER_PAGE;

        $data = collect($data)->skip($start)->take($length)->toArray();
        $recordsTotal = count($data);
    }
    else if(is_object($data))
    {
        $recordsTotal = 1;
    }

    $params['draw'] ??= "1";
    $params['draw'] = (int)$params['draw'];
    $params['draw'] += 1;

    $data = [
        'data' => $data,
        'draw' => $params['draw'],
        'recordsTotal' => $recordsTotal,
        'recordsFiltered' => $recordsFiltered,
        'message' => $message,
        'success' => $status == 200,
        'status' => $status,
    ];
    return response()->json($data, $status);
}

function withValidation(array $data, $rules, callable $next): JsonResponse
{
    $errors = null;
    try {
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $errors = $validator->messages()->toArray();
            if(count($errors) > 0) {
                $errors = collect($errors)->values()->map(fn($error) => $error[0])->toArray();
                $errors = implode(separator: '<br>', array: $errors);
            }
            else
            {
                $errors = null;
            }

        }

    } catch (\Exception $e) {
        $errors = $e->getMessage();
    } finally {
        if ($errors != null) {
            return apiResponse(
                [
                    'message' => $errors,
                ],
                401,
            );
        }

        return $next($data);
    }
}

/**
 *
 * @return UserModel|null
 */
function getUser()
{
    return auth()?->user()?->getModel() ?? null;
}

function authLogout(Request $request = null)
{
    auth()->user()?->tokens()?->delete();
    // auth()->logout();
    $request?->session()?->flush();

}

function bomb(string|object|array|null $err_mess, $tag = '')
{
    if(isset($err_mess))
    {
        $type = gettype($err_mess);
        if ($type == 'object' || $type == 'array') {
            $err_mess = json_encode($err_mess);
        }
        if (!empty($tag)) {
            $err_mess = $tag . ': ' . $err_mess;
        }
    }

    throw new Exception($err_mess ?? "null");
}