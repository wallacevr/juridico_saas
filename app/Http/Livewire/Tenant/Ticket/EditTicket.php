<?php

namespace App\Http\Livewire\Tenant\Ticket;

use Livewire\Component;
use App\Ticket;
use App\Collection;
use App\Product;
use App\TicketProduct;
use App\TicketCollection;
class EditTicket extends Component
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
    public $ticket =[];
    
    public function render()
    {
        $this->collections = Collection::all();
        $this->products = Product::all();
        return view('livewire.tenant.ticket.edit-ticket');
    }
    public function mount(Ticket $ticket){
        $this->collections = Collection::all();
        $this->products = Product::all();
        $this->name = $ticket->name;
        $this->validator = $ticket->validator;
        $this->active = $ticket->active;
        $this->discount_method_id = $ticket->discount_method_id;
        $this->discount = $ticket->discount;
        $this->due_date = $ticket->due_date;
        $this->ticket = $ticket;
    }

    public function update(){
        $this->validate( [
            'name' => 'required',
            'validator' => ['required','unique:tickets,validator,'. $this->ticket->id],
            'discount' => ['required','numeric'],
            'due_date'=>'required'
      
        ]);
        try {

          
            $this->ticket->name = $this->name;
           
            $this->ticket->validator = strtoupper($this->validator);
          
            $this->ticket->active = $this->active;
         
            $this->ticket->discount_method_id = $this->discount_method_id;
           
            $this->ticket->discount = $this->discount;
       
            $this->ticket->due_date = $this->due_date;
            $this->ticket->update();
            $this->ticket->collections()->sync($this->selectedcollections);
            $this->ticket->products()->sync($this->selectedproducts);
  
           
            return redirect()->route('tenant.tickets.index')->with("success", "Ticket created successfully!");
        }
        catch(ValidationException $Error)
        {
          
            return redirect()->back()->withErrors($Error->validator->messages()->messages());
        }
        catch(\Throwable $Error)
        {
           dd($Error);
            return redirect()->back()->withErrors($Error->validator->messages()->messages());
        }

    }
}
