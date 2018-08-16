@extends('layouts.app')

@section('title', '| ' . __('Edit Sample') )

@section('content')
            <div class="container masonry-item col-md-8 profile">
                <div class="bgc-white p-20 bd">
                    <h4 class="c-grey-900">
                        <i class=""></i> {{ __('Add Sample') }} 
                        <a href="{{ route('sampleidentifier.index') }}" class="form-a-link pl-4 pull-right c-grey-700">{{__('Cancel')}}</a>
                    </h4>
                    <div class="mT-30">

                        <form method="POST" action=" {{route('sampleidentifier.update', ['id' => $si_records->id])}} " accept-charset="UTF-8">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-group{{ $errors->has('identifier') ? ' has-error' : '' }}">
                                @include('includes.forms.field-text', [
                                    'fieldName' => 'identifier', 'displayName' => __('Identifier'),
                                    'iconClass' => 'ti-control-record',
                                    'old' => old('identifier', $si_records->identifier), 'required' => 'required'
                                ])
                                @include('includes.forms.validation', ['fieldname' => 'identifier'])
                            </div>

                            <div class="form-group{{ $errors->has('sample') ? ' has-error' : '' }}">
                                @include('includes.forms.field-text', [
                                    'fieldName' => 'sample', 'displayName' => __('Sample'),
                                    'iconClass' => 'ti-control-record',
                                    'old' => old('sample', $si_records->sample), 'required' => 'required'
                                ])
                                @include('includes.forms.validation', ['fieldname' => 'sample'])
                            </div>

                            <div class="form-group{{ $errors->has('session') ? ' has-error' : '' }}">
                                @include('includes.forms.field-text', [
                                    'fieldName' => 'session', 'displayName' => __('Session'),
                                    'iconClass' => 'ti-control-record',
                                    'old' => old('session', $si_records->session), 'required' => 'required'
                                ])
                                @include('includes.forms.validation', ['fieldname' => 'session'])
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                        </form>

                    </div>
                </div>
            </div>

@endsection