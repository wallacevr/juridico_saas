<?php

namespace App\Http\Livewire\Tenant\Ticket;

use Livewire\Component;
use App\Ticket;
use App\Collection;
use App\Product;
use App\TicketProduct;
use App\TicketCollection;
class CreateTicket extends Component
{
    public $collections;
    public $selectedcollections = [];
    public $selectedproducts = [];
    public $products;
    public $name;
    public $validator;
    public $active;
    public $discount_method_id=1;
    public $discount;
    public $due_date;
    public function render()
    {
        $this->collections = Collection::all();
        $this->products = Product::all();
        return view('livewire.tenant.ticket.create-ticket');
    }
    public function store(){
        $this->validate( [
            'name' => 'required',
            'validator' => ['required','unique:tickets'],
            'discount' => ['required','numeric'],
            'due_date'=>'required'
      
        ]);
        try {

            $ticket = new Ticket;
            $ticket->name = $this->name;
           
            $ticket->validator = strtoupper($this->validator);
          
            $ticket->active = $this->active;
         
            $ticket->discount_method_id = $this->discount_method_id;
           
            $ticket->discount = $this->discount;
       
            $ticket->due_date = $this->due_date;
            $ticket->save();
            foreach($this->selectedproducts as $product){
                $ticketproduct = new TicketProduct;
                $ticketproduct->id_ticket = $ticket->id;
                $ticketproduct->id_product = $product;
               
                $ticketproduct->save();
            }
            foreach($this->selectedcollections as $collection){
                $ticketcollection = new TicketCollection;
                $ticketcollection->id_ticket = $ticket->id;
                $ticketcollection->id_collection = $collection;
               
                $ticketcollection->save();
            }
           
            return redirect()->route('tenant.tickets.index')->with("success", "Ticket created successfully!");
        }
        catch(ValidationException $Error)
        {
          
            return redirect()->back()->withErrors($Error->validator->messages()->messages());
        }
        catch(\Throwable $Error)
        {
        
            return redirect()->back()->withErrors($Error->validator->messages()->messages());
        }

    }
}
