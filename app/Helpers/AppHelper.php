<?php

use App\Models\UserModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

CONST PER_PAGE = 10;

function datatableDataProcess(array &$data, array &$params): void
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

    $recordsTotal = 0;
    if(is_array($data))
    {

        $start = $params['start'] ?? 0;
        $length = $params['length'] ?? PER_PAGE;
        $start = (int)$start;
        $length = (int)$length;

        $order = $params['order'][0] ?? null;
        if(isset($order)) {
            $column = $order['column'];
            $dir = $order['dir'];
            $column = $params['columns'][$column]['data'];
            $descending = $dir == "desc";

            $data = collect($data)->sortBy($column, SORT_REGULAR, $descending)->values()->toArray();
        }

        $data = collect($data)->skip($start)->take($length)->filter(
            function($item) use ($params) {
                $search = $params['search']['value'] ?? null;
                if(isset($search)) {
                    foreach($item as $key => $value) {
                        if(is_string($value)) {
                            if(stripos($value, $search) !== false) {
                                break;
                            }
                            $item = null;
                        }
                    }
                }
                if(isset($item)) {
                    $item['select'] = '<input type="checkbox" class="form-check-input" name="id[]" value="'.$item['id'].'">';
                    $item['actions'] = '';
                }

                return $item;
            }
        )->values()->toArray();



        $recordsTotal = count($data);
    }
    else if(is_object($data))
    {
        $recordsTotal = 1;
    }

    $params['recordsFiltered'] = $recordsFiltered;
    $params['recordsTotal'] = $recordsTotal;
}

function apiResponse($data = [], $status = 200, $message = null, array $params = []): JsonResponse
{
    switch($status) {

        case 200:
        case 201:
        case 204:
            $message ??= __('all.success');
        break;

        default:
            $message ??= __('all.unknown_error') ;
    }

    $draw = $params['draw'] ?? 0;

    $data = [
        'data' => $data,
        'draw' => (int)$draw,
        'recordsTotal' => $params['recordsTotal'] ?? 0,
        'recordsFiltered' => $params['recordsFiltered'] ?? 0,
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