<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Holiday;
use Yajra\DataTables\DataTables;

class HolidayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createHoliday(Request $request)
    {
        $insert = new Holiday();
        $insert->name = $request->input('holiday_name');
        $insert->start_date = date('Y-m-d H:i:s', strtotime($request->input('start_date') . '00:00:00'));
        $insert->end_date = date('Y-m-d H:i:s', strtotime($request->input('end_date') . '23:59:59'));
        $holidayOrderCount = Holiday::all();
        $holidaycount = count($holidayOrderCount);
        $insert->order_in_year = $holidaycount + 1;
        $insert->delete_holiday = 0;
        $insert->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function editHoliday(Request $request)
    {
        $model = Holiday::where('id', $request->input('id_holiday'))->first();
        $data = [];
        $data['name'] = $model->name;
        $data['start_date'] = date('d-m-Y', strtotime($model->start_date));
        $data['end_date'] = date('d-m-Y', strtotime($model->end_date));
        return response()->json([
            'success' => 1,
            'data' => $data
        ]);
    }

    public function updateHoliday(Request $request)
    {
        $update = Holiday::where('id', $request->input('id_holiday'))->first();
        $update->name = $request->input('holiday_name');
        $update->start_date = date('Y-m-d H:i:s', strtotime($request->input('start_date') . '00:00:00'));
        $update->end_date = date('Y-m-d H:i:s', strtotime($request->input('end_date') . '23:59:59'));
        $update->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function softDeleteHol(Request $request)
    {
        $mar = Holiday::where('id', $request->input('id_holiday'))->first();
        $mar->delete_holiday = 1;
        $mar->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $mar->save();
        return response()->json([
            'success' => 1
        ]);
    }

    public function readHoliday()
    {
        return view('holidays.tableholiday', [
            'title' => 'Public Holidays',
            'title_menu' => 'Holidays'
        ]);
    }

    public function getHoliday()
    {
        $data = Holiday::where('delete_holiday', 0)->get();
        return Datatables::of($data)
        ->addColumn('name', function ($data) {
            return $data->name;
        })
        ->addColumn('start_date', function ($data) {
            return date('D, d m Y', strtotime($data->start_date));
        })
        ->addColumn('end_date', function ($data) {
            return date('D, d m Y', strtotime($data->end_date));
        })
        ->addColumn('order_in_year', function ($data) {
            return $data->order_in_year;
        })
        ->addColumn('action', function ($data) {
            return
            '<button class="btn btn-icon btn-warning for-update" data-id="'.$data->id.'">
                <i class="fa-regular fa-pen-to-square"></i>
            </button>
            <button class="btn btn-icon btn-danger for-delete" data-id="'.$data->id.'">
                <i class="fa-regular fa-trash-can"></i>
            </button>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
