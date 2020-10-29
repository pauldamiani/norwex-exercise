<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Orders;

class CustomerListController extends Controller
{
    public function index() {

        $customerData = new \stdClass();
        $customers = Customer::all();

        foreach($customers as $customerKey => $customer) {
            $customerOrders = Orders::where('customerid', $customer->customerid)->get();

            $customerStatus = $customer->customerstatusid;
            $customerName = $customer->name;

            $orderTotal = 0;
            $lastThreeMonths = 0;

            $orderCount = count($customerOrders);
            
            foreach($customerOrders as $orderKey => $order) {

                $orderDate = $order->createddatetime;
                $latestOrderDate = date_create('1900-01-01');
                
                // Check if the current orders date is newer than the latest
                // order date recorded
                if($latestOrderDate->diff($orderDate)->days > 0) {
                    $latestOrderDate = $orderDate->format('Y-m-d');
                }

                // Check if the current orders date is within the last
                // 3 months and if it is complete - if so, add the order
                // total to the running total
                //
                // This will be used to check if the customer has spent
                // more than $200 in the last 3 months
                if($orderDate >= date('Y-m-d', strtotime('-3 months', strtotime(date("Y-m-d")))) && $order->orderstatus == 'complete') {
                    $lastThreeMonths += $order->ordertotal;
                }

                // Check if the current orders date is within the last
                // 12 months
                //
                // This will be used to check if the customer has made
                // an order in the last 12 months
                if($orderDate >= date('Y-m-d', strtotime('-12 months', strtotime(date("Y-m-d"))))) {
                    $madeOrderThisYear = 1;
                } else {
                    $madeOrderThisYear = 0;
                }

                $orderTotal += $order->ordertotal;
            }

            // Add the data to a new class to be sent to the view
            $customerData->$customerKey = new \stdClass();
            $customerData->$customerKey->name = $customerName;
            $customerData->$customerKey->orderCount = $orderCount;
            $customerData->$customerKey->customerStatus = $customerStatus;
            $customerData->$customerKey->latestOrderDate = $latestOrderDate;
            $customerData->$customerKey->lastThreeMonths = $lastThreeMonths;
            $customerData->$customerKey->madeOrderThisYear = $madeOrderThisYear;
            $customerData->$customerKey->orderTotal = $orderTotal;
        }

        // Return the customerList view with the customer data set
        return view('customerList')->with('customers', $customerData);
    }
}
