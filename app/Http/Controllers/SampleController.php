<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSampleRequest;
use App\Http\Requests\UpdateSampleRequest;
use App\Models\Sample;
use App\Services\SampleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SampleController extends Controller
{
    /**
     * @var sampleService
     */

    protected $sampleService;


     /**
     * SampleController Constructor
     *
     * @param SampleService $sampleService
     *
     */
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(SampleService $sampleService)
    {
        $this->sampleService = $sampleService;

        $this->middleware('permission:sample-list|sample-create|sample-edit|sample-delete', ['only' => ['index','show']]);
        $this->middleware('permission:sample-create', ['only' => ['create','store']]);
        $this->middleware('permission:sample-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:sample-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $samples = $this->sampleService->getAll();
        return view('samples.index',compact('samples'))
            ->with('i', (request()->input('page', 1) - 1) * Config::get('constants.paginate'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('samples.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSampleRequest $request)
    {
        $this->sampleService->storeData($request);
        return redirect()->route('samples.index')
                        ->with('success','Sample created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function show(Sample $sample)
    {
        $sample = $this->sampleService->get($sample);
        return view('samples.show', compact('sample'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function edit(Sample $sample)
    {
        return view('samples.edit', compact('sample'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSampleRequest $request, Sample $sample)
    {
        $this->sampleService->updateData($request, $sample);
        return redirect()->route('samples.index')
                        ->with('success','Sample updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sample $sample)
    {
        $this->sampleService->delete($sample);
        return redirect()->route('samples.index')
                        ->with('success','Sample deleted successfully');
    }
}
