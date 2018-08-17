<?php

namespace Onetoefoot\Sampleidentifier\Controllers\Api;

use Illuminate\Http\Request;
use Onetoefoot\Sampleidentifier\Models\SiRecord;
use Onetoefoot\Sampleidentifier\Controllers\Api\SiRecordResource;
use Onetoefoot\Sampleidentifier\Controllers\Api\SiRecordCollection;
use Carbon\Carbon;

class SiRecordController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SiRecordCollection(SiRecord::where('user_id', \Auth::user()->id)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        $timestamp = Carbon::now()->toDateTimeString();
        foreach($data['data'] as $key => $values) {
            $data['data'][$key]['user_id'] = $request->user()->id;
            $data['data'][$key]['created_at'] = $timestamp;
            $data['data'][$key]['updated_at'] = $timestamp;
        }

        $siRecord = SiRecord::insert($data['data']);
        
        return array('data', array('status' => 'success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SiRecord $siRecord)
    {
        SiRecordResource::withoutWrapping();
        return new SiRecordResource($siRecord);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiRecord $siRecord)
    {
        if ($request->user()->id !== $siRecord->user_id) {
            return response()->json(['error' => 'You can only edit your own records.']);
        }

        $siRecord->update($request->only(['identifier', 'sample', 'session']));

        return new SiRecordResource($siRecord);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiRecord $siRecord)
    {
        $si_record->delete();
        return response()->json(null, 24);
    }
}
