<?php

namespace App\Http\Controllers;

use App\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\BidRequest;
use App\Load;
use Auth;

class BidController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Load $load, BidRequest $request)
    {
         
        /**
         * first check if a user has not already made a bid for the shipment
         */
        $slug = uniqid().Auth::user()->organisation;
        $bidFromUser = $load->bidFromUser(auth()->user())->first();          
        if($bidFromUser){
            abort(401, 'You already placed a bid for this consignment');
        }
         $bid =$load->bids()->create(array_merge($request->all(), [
                                                                    'slug' =>$slug, 
                                                                    'user_id' => Auth::user()->id,
                                                                ]));
       
       return response()->json(null, 200);  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bid  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Bid $bid)
    {
        $bids = $bid->bidable->bids()->get();
        $bid = $bid->load(['bidder','bidable']);

        return view('bid.show', compact('bid','bids'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function edit(Bid $bid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bid $bid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Load $load)
    {
        $load->bidFromUser(auth()->user())->delete();       
        return response()->json(null, 200);
    }

    /**
     * Find total number of bids
     */

    public function TotalBids(Load $load){

        $bids = $load->bids()->get();
        $bidFromUser = $load->bidFromUser(auth()->user())->first();       
        $response = [
            'bidings' =>$bids->load(['bidder']),
            'numberOfBids' => $load->numberOfBids(),
            'userHasBid' => $bidFromUser ? true : false,
            'canBid' => $load->usercanBidShipment(auth()->user()),
            'userCanSeeBidder' => $load->userCanSeeBidder(auth()->user()),
        ];
        return $response;

    }
}
