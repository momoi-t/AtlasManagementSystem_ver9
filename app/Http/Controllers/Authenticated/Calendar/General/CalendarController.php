<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    public function reserve(Request $request){
        DB::beginTransaction();
        try{
            $getPart = $request->getPart;
            $getDate = $request->getData;
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

    public function delete(Request $request){
        $user = Auth::user();
        $deleteId = $request->input('delete_date');

        $reserveSetting = ReserveSettings::where('setting_reserve', $deleteId)->first();
        if ($reserveSetting) {
            // ユーザーとのリレーション解除（中間テーブルから削除）
            $reserveSetting->users()->detach($user->id);
            // 予約数を１戻す
            $reserveSetting->increment('limit_users');

            return redirect()->back();
        }

        return redirect()->back();
    }
}
