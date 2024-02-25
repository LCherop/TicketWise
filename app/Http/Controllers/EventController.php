<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $allevents = Event::all();

            $response = [
                'allevents' => $allevents,
                'message' => 'Events fetched successfully',
                'status' => 200
            ];

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [
                'status'=> 500,
                'error_message' => "Failed to fetch events",
                'error' => $th->getMessage(),
            ];

            return response()->json($response, 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $fields = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'vip_ticket_price' => 'required',
                'regular_ticket_price' => 'required',
                'max_attendees' => 'required',
                'creator_id' => 'required'
            ]);

            $event = Event::where('title',$fields['title'])->first();

            if($event){
                return response([
                    'message' => 'Event already exists!',
                ],500);
            }else{
                $event = Event::create([
                    'title' => $fields['title'],
                    'description' => $fields['description'],
                    'start_date' => $fields['start_date'],
                    'end_date' => $fields['end_date'],
                    'vip_ticket_price' => $fields['vip_ticket_price'],
                    'regular_ticket_price' => $fields['regular_ticket_price'],
                    'max_attendees' => $fields['max_attendees'],
                    'creator_id' => $fields['creator_id']
                ]);
                
                $response = [
                        'event' => $event,
                        'message' => 'Event added successfully'
                    ];
        
                return response()->json($response, 200);
            }

        } catch (\Throwable $th) {
            
            $response = [
                'status'=> 500,
                'error_message' => "Something went wrong",
                'error' => $th->getMessage(),
            ];

            return response()->json($response, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $event = Event::find($id);
            $response = [
                'event' => $event,
                'message' => "Event fetched",
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [
                'status'=> 500,
                'error_message' => "Failed to fetch event details",
                'error' => $th->getMessage(),
            ];

            return response()->json($response, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {
            $event = Event::find($id);

            if($event){
                $event->update($request->all());

                $response = [
                    'event' => $event,
                    'message' => 'Event updated successfully'
                ];

                return response()->json($response, 200);
            }else{
                $response = [
                    'status'=> 500,
                    'error_message' => "Event not found",
                ];
    
                return response()->json($response, 500);
            }
        } catch (\Throwable $th) {
            $response = [
                'status'=> 500,
                'error_message' => "Failed to update event",
                'error' => $th->getMessage(),
            ];

            return response()->json($response, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Event::destroy($id);

            $response = [
                'message' => 'Event deleted successfully'
            ];

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [
                'status'=> 500,
                'error_message' => "Failed to delete event",
                'error' => $th->getMessage(),
            ];

            return response()->json($response, 500);
        }
    }
}
