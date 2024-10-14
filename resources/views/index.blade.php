@php use App\Enums\StatusEnum; @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Check vaccine Status') }}</div>
                    <div class="card-body">
                        <form action="{{url('/')}}" method="post">
                            @csrf
                            <div class="row g-3">
                                <div class="col-sm-11">
                                    <input name="nid" value="{{old('nid')}}" type="text" class="form-control" placeholder="Please Enter You NID Number"
                                           aria-label="City">
                                    @if($errors->has('nid'))
                                        <div class="text-danger">{{ $errors->first('nid') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm">
                                    <button type="submit" class="btn btn-primary">search</button>
                                </div>
                            </div>
                        </form>
                        @if(session('result'))
                            <?php  $result = session('result');?>
                            <div class="container" style="padding-top: 12px!important;">
                                <div class="row g-3 ">
                                    <div class="col-sm-12 justify-content-center">
                                        <div class="alert alert-info" role="alert">
                                            Status: {{$result['status']}}
                                            @if($result['status'] == StatusEnum::NotRegistered)
                                                ; Please do registration process from <a
                                                    href="{{$result['link']}}"
                                                    class="text-warning stretched-link">here</a>
                                            @endif
                                            @if($result['status'] == StatusEnum::Scheduled)
                                                at {{$result['schedule_date']}}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
