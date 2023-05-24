<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{

		public function __construct() 
		{
			$this->authorizeResource(Listing::class, 'listing');
			$this->middleware('auth')->except(['index', 'show']);
		}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
				return inertia(
					'Listing/Index',
					[
						'listings' => Listing::all()
					]
				);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
				// $this->authorize('create', Listing::class);

        return inertia('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
				$request->user()->listings()->create(
						$request->validate([
							'beds' => 'required|integer|min:0|max:20',
							'baths' => 'required|integer|min:0|max:20',
							'area' => 'required|integer|min:20|max:1200',
							'city' => 'required',
							'code' => 'required',
							'street' => 'required',
							'street_nr' => 'required|min:1|max:1000',
							'price' => 'required|integer|min:1000|max:1000000'
						])
				);

				return redirect()->route('listing.index')
				->with('success', 'Listing was created!');
    }

		// public function show($id)
    public function show(Listing $listing)
    {
			// if(Auth::user()->cannot('view', $listing)) {
			// 	abort(403);
			// }
			// $this->authorize('view', $listing);
			//
			return inertia(
				'Listing/Show',
				[
					// 'listing' => Listing::findOrFail($id)
					'listing' => $listing
				]
			);
    }

    public function edit(Listing $listing)
    {
        //
				return inertia(
					'Listing/Edit',
					[
						'listing' => $listing
					]
				);
    }

    public function update(Request $request, Listing $listing)
    {
			//
			$listing->update(
				$request->validate([
					'beds' => 'required|integer|min:0|max:20',
					'baths' => 'required|integer|min:0|max:20',
					'area' => 'required|integer|min:20|max:1200',
					'city' => 'required',
					'code' => 'required',
					'street' => 'required',
					'street_nr' => 'required|min:1|max:1000',
					'price' => 'required|integer|min:100000|max:2000000'
				])
			);

			return redirect()->route('listing.index')
			->with('success', 'Listing was updated!');
    }

    public function destroy(Listing $listing)
    {
				$item = Listing::findOrFail($listing->id);
        
				if($item) {
					
					$item->delete();
					return redirect()->back()->with('success', 'Listing deleted');
				}

    }
}
