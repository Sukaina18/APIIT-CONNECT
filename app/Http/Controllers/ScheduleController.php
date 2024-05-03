<?php

namespace App\Http\Controllers;
use App\Models\Schedule;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ScheduleController extends Controller
{


    public function calendar(){
        return view('home.home.calendar');
    }

    public function getEvents(){
        $schedules=Schedule::all();
        return response()->json($schedules);
    }
    public function deleteEvent($id){
        $schedule=Schedule::findOrFail($id);
        $schedule->delete();

        return response()->json(['message'=>'Event Deleted Successfully']);

    }

    public function updateCalendar(Request $request, $id){

        $schedule=Schedule::findOrFail($id);
        $schedule->update([
            'start'=>Carbon::parse($request->input('start_date'))->setTimeZone('UTC'),
            'end'=>Carbon::parse($request->input('end_date'))->setTimeZone('UTC'),
        ]);

        return response()->json(['message'=>'Event Moved Successfully']);
    }

    public function resize(Request $request, $id){

        $schedule=Schedule::findOrFail($id);

        $newEndDate = Carbon::parse($request->input('end_date'))->setTimezone('UTC');
        $schedule->update(['end'=>$newEndDate,]);

        return response()->json(['message'=>'Event Resized Successfully']);
    }

    public function Calsearch(Request $request){
        $searchKeywords=$request->input('title');
        $matchingEvents=Schedule::where('title','like','%'. $searchKeywords . '%')->get();

        return response()->json($matchingEvents);

    }


    public function schedule()
    {
        return view('home.home.schedule');
    }

    public function add_Schedule(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
            'description' => 'nullable|string',
            'color' => 'nullable|string',
        ]);

        // Create a new schedule instance
        $schedule = new Schedule();
        $schedule->title = $validatedData['title'];
        $schedule->start = $validatedData['start'];
        $schedule->end = $validatedData['end'];
        $schedule->description = $validatedData['description'];
        $schedule->color = $validatedData['color'];

        // Save the schedule
        $schedule->save();

        // Optionally, you can return a response or redirect
        return view('home.home.calendar');


    }



}
