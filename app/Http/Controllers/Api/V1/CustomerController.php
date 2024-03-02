<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\Api\CustomersFilter;
use App\Http\Controllers\Api\Services\V1\CustomerQuery;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBulkInvoiceRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new CustomersFilter();
        $queryItems = $filter->transform($request);
        $includeInvoices = $request->query('invoices');
        $customers = Customer::where($queryItems);
        if($includeInvoices){
            $customers = $customers->with('invoices');
        }
        return new CustomerCollection($customers->paginate()->appends($request->query()));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    public function bulkStore(StoreBulkInvoiceRequest $request){
        $bulk = collect($request->all())->map(function($arr,$key){
            return Arr::except($arr,['customerId','billedDate',"paidDate"]);
        });

        Invoice::insert($bulk->toArray());

    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer,Request $request)
    {
        $includeInvoices = $request->query('invoices');
        if($includeInvoices){
            $customer = new CustomerResource($customer->load('invoices'));
        }
        return new CustomerResource($customer);

    }




    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
