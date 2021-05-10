<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('service.index');
    }

    public function allServices()
    {
        $services = Service::latest()->get();
        
        return response()->json($services);
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
    public function store(StoreServiceRequest $request)
    {
        if ($request->hasFile('image')) 
        {
            $image = request()->file('image');
            $imageName = $image->getClientOriginalName();
            $path ='/uploads/'.$imageName;
                // storing an image
                $image->move(public_path('/uploads'), $imageName);

                $service = Service::create([
                    'name' => $request->input('name'),
                    'first_trait' => $request->input('first_trait'),
                    'second_trait' => $request->input('second_trait'),
                    'third_trait' => $request->input('third_trait'),
                    'status' => $request->input('status'),
                    'image' => $path,
                ]);
                
            $service = Service::where('id', $service->id)->first();
            return response()->json($service);
        }  
    }

    public function updateService(UpdateServiceRequest $request)
    {
        $service = Service::find($request->id);

        if ($request->hasFile('image')) 
        {
            $image = request()->file('image');
            $imageName = $image->getClientOriginalName();
            $path ='/uploads/'.$imageName;
                // storing an image
                $image->move(public_path('/uploads'), $imageName);

                $service->update([
                    'name' => $request->input('name'),
                    'first_trait' => $request->input('first_trait'),
                    'second_trait' => $request->input('second_trait'),
                    'third_trait' => $request->input('third_trait'),
                    'status' => $request->input('status'),
                    'image' => $path,
                ]);
                
            $service = Service::where('id', $service->id)->first();
            return response()->json($service);
        }
        else {
            $service->update([
                'name' => $request->input('name'),
                'first_trait' => $request->input('first_trait'),
                'second_trait' => $request->input('second_trait'),
                'third_trait' => $request->input('third_trait'),
                'status' => $request->input('status'),
            ]);
            
            $service = Service::where('id', $service->id)->first();
            return response()->json($service);
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::find($id)->delete();
        return response()->json(['message' => 'Service has been Deleted.']);
    }
}
