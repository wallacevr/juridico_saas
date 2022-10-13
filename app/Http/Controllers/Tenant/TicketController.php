<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ticket;
use App\Collection;
use App\Product;
class TicketController extends Controller
{
    //
        // Return all Tickets
        public function index()
        {

            $search = request('q');
            if (!empty($search)) {
    
                $tickets = Ticket::orWhere([
                    ['name', 'like', '%' . $search . '%']
                ])->orWhere(
                    [['validator', 'like', '%' . $search . '%']]);
    
            } else {
                $tickets = Ticket::query();
                
            }
    
            return view('tenant.tickets.index', [
                'tickets' => $tickets->paginate(25),'q'=>$search
            ]);
        
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('tenant.tickets.create');
    }

           // Show the Ticket edit form
    public function edit(Ticket $ticket)
    {
        return view('tenant.tickets.edit',compact('ticket'));
    }

    // Update a Ticket
    public function update(Request $request, Ticket $ticket)
    {
      
    }

    

    // Delete a Ticket
    public function destroy(Ticket $ticket)
    {
        if (!$ticket->delete()) {
            return redirect()->route('tenant.tickets.index')->with("error", "Error deleting ticket.");
        }
       
        return redirect()->route('tenant.tickets.index')->with("success", "Product deleted successfully");
   
    
    }
}
