@extends('layouts.app')

@section('title', '| ' . __('Sample Identifier'))

@section('content')

@include('includes.forms.delete-modal')
    <div class="col-md-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <h4 class="c-grey-900 mB-20">
            <i class=""></i> {{ __('Records')}} 
        </h4>
        <table id="dataTable" class="table table-striped table-bordered table-hover user-table" data-toggle="dataTable" data-form="deleteForm">

            <thead>
                <tr>
                    <th>{{ __('Identifier')}}</th>
                    <th>{{ __('Sample')}}</th>
                    <th>{{ __('Session')}}</th>
                    <th>{{ __('Created At')}}</th>
                    <th>{{ __('Operations')}}</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>{{ __('Identifier')}}</th>
                    <th>{{ __('Sample')}}</th>
                    <th>{{ __('Session')}}</th>
                    <th>{{ __('Created At')}}</th>
                    <th>{{ __('Operations')}}</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($records as $record)
                <tr>
                    <td>{{ $record->identifier }}</td>
                    <td>{{ $record->sample }}</td>
                    <td>{{ $record->session }}</td>
                    <td>{{ $record->created_at->format('F d, Y h:ia') }}</td>
                    <td>
                        @include('includes.forms.edit-record', [
                                'route' => route('sampleidentifier.edit', $record->id)
                            ])
                        @include('includes.forms.delete-record', [
                                'route' => route('sampleidentifier.destroy' ,$record->id)
                            ])
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
        <a href="{{ route('sampleidentifier.create') }}" class="btn btn-primary">Add Sample</a>
    </div>

@endsection