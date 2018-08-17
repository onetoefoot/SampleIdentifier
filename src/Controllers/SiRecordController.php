<?php

namespace Onetoefoot\Sampleidentifier\Controllers;

use Onetoefoot\Sampleidentifier\Models\SiRecord;
use Carbon\Carbon;
use League\Csv\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Validator;

class SiRecordController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = SiRecord::where('user_id', \Auth::user()->id)->get();
        return view('sampleidentifier::records.index', ["records" => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sampleidentifier::records.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->is('api/records'))
        {
            $record = SiRecord::create($request->all());
            return response()->json($record, 201);
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
        // this is from an api call
        // ArticleResource::withoutWrapping();
        // return new ArticleResource($article);
        if ($id == 'download-all')
        {
            $records = SiRecord::where('user_id', \Auth::user()->id)->get();
            $records = $records->toArray();

            $csv = Writer::createFromFileObject(new \SplTempFileObject());
            $csv->insertOne(['identifier', 'sample', 'session', 'timestamp']);
            $csv->insertAll($records);
            $current_time = Carbon::now()->timestamp;
            $csv->output('sample_identifier-' . $current_time . '.csv');
            die;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $si_record = SiRecord::findOrFail($id);

        return view('sampleidentifier:records.edit', compact('so_record'));
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
        $currentUser = \Auth::user();
        if ($id == 'all')
        {
            $deletedRows = Record::where('user_id', $currentUser->id)->delete();
            return redirect('records')->with('success', __('recordmanagement.deleteAllSuccess'));
        }
         $record = Record::findOrFail($id);

         if ($record->user_id == $currentUser->id)
         {
             $record->save();
             $record->delete();

             return redirect('records')->with('success', __('recordmanagement.deleteSuccess'));
         }

         return back()->with('records', __('recordmanagement.deleteSelfError'));
    }
}
