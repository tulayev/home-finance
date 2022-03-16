<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RecordController extends Controller
{
    private const INCOME_TYPE = 1;
    private const EXPENSE_TYPE = 2;
    private static $types = [self::INCOME_TYPE, self::EXPENSE_TYPE];

    public function index()
    {
        return Record::with('category')
            ->get();
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'amount' => 'required|digits_between:0,12',
            'type' => 'required|integer',
            'category_id' => 'required',
        ]);

        if (!in_array($request['type'], self::$types)) {
            return response()->json([
                'error' => 'The type does not exist',
            ], Response::HTTP_MISDIRECTED_REQUEST);
        }

        $total = $request['type'] == self::INCOME_TYPE
            ? $request['amount']
            : 0 - $request['amount'];
        if (Record::all()->count() > 0) {
            $total = $request['type'] == self::INCOME_TYPE
                ? Record::all()->last()->total + $request['amount']
                : Record::all()->last()->total - $request['amount'];
        }

        $record = Record::create([
            'amount' => $request['amount'],
            'total' => $total,
            'type' => $request['type'],
            'category_id' => $request['category_id'],
            'user_id' => Auth::user()->id,
            'comment' => $request['comment'],
            'created_at' => $request['created_at'] ?? Carbon::now(),
        ]);

        return response()->json([
            'record' => $record
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $record = Record::findOrFail($id);
        } catch (Exception $ex) {
            return response()->json([
                'error' => 'Record is not found',
            ], Response::HTTP_NOT_FOUND);
        }

        if (!in_array($request['type'], self::$types)) {
            return response()->json([
                'error' => 'The type does not exist',
            ], Response::HTTP_MISDIRECTED_REQUEST);
        }

        $record->update([
            'amount' => $request['amount'],
            'type' => $request['type'],
            'category_id' => $request['category_id'],
            'comment' => $request['comment'],
            'created_at' => $request['created_at'] ?? Carbon::now(),
        ]);

        return response()->json([
            'record' => $record
        ], Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        Record::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
