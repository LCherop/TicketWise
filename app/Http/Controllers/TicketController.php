<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        try {
            $alltickets = Ticket::all();

            $response = [
                'alltickets' => $alltickets,
                'message' => 'Tickets fetched successfully',
                'status' => 200
            ];

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [
                'status'=> 500,
                'error_message' => "Failed to fetch tickets",
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
                'event_id' => 'required',
                'user_id' => 'required',
                'type' => 'required|in:VIP,Regular',
                'quantity' => 'required|numeric|min:1|max:5'
            ]);
            

            // Ensure user does not buy more than 5 tickets:
            $userTicketCount = Ticket::where('user_id',$fields['user_id']);
            
            if($userTicketCount >= 5){
                return response()->json(['message' => 'You can only buy upto 5 tickets'], 422);
    
            }else{
                $ticket = Ticket::create([
                    'event_id' => $fields['event_id'],
                    'user_id' => $fields['user_id'],
                    'type' => $fields['type'],
                ]);
                
                $response = [
                    'ticket' => $ticket,
                    'message' => 'Ticket bought successfully'
                ];
            
                return response()->json($response, 200);
            }
            
        } catch (\Throwable $th) {
            
            $response = [
                'status'=> 500,
                'error_message' => "Failed to buy ticket",
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
            $ticket = Ticket::find($id);
            $response = [
                'ticket' => $ticket,
                'message' => "Ticket fetched",
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [
                'status'=> 500,
                'error_message' => "Failed to fetch ticket details",
                'error' => $th->getMessage(),
            ];

            return response()->json($response, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $ticket = Ticket::find($id);

            if($ticket){
                $ticket->update($request->all());

                $response = [
                    'ticket' => $ticket,
                    'message' => 'Ticket updated successfully'
                ];

                return response()->json($response, 200);
            }else{
                $response = [
                    'status'=> 500,
                    'error_message' => "Ticket not found",
                ];
    
                return response()->json($response, 500);
            }
        } catch (\Throwable $th) {
            $response = [
                'status'=> 500,
                'error_message' => "Failed to update ticket",
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
            Ticket::destroy($id);

            $response = [
                'message' => 'Ticket deleted successfully'
            ];

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [
                'status'=> 500,
                'error_message' => "Failed to delete ticket",
                'error' => $th->getMessage(),
            ];

            return response()->json($response, 500);
        }
    }
}
