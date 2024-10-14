@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Vaccine Registration Form') }}</div>

                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif
                        <form action="{{url('vaccine')}}" method="post" class="row g-3">
                            @csrf
                            <div class="col-12 col-lg-6">
                                <label  class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input name="name" value="{{old('name', '')}}" type="text" class="form-control"  placeholder="jhone">
                                @if($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="col-12 col-lg-6">
                                <label  class="form-label">Email <span class="text-danger">*</span></label>
                                <input name="email" value="{{old('email', '')}}" type="email" class="form-control"
                                       placeholder="jhone@exaample.com">
                                @if($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label">NID <span class="text-danger">*</span></label>
                                <input  name="nid" value="{{old('nid', '')}}" type="text" class="form-control"
                                       placeholder="">
                                @if($errors->has('nid'))
                                    <div class="text-danger">{{ $errors->first('nid') }}</div>
                                @endif
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label">Center <span class="text-danger">*</span></label>
                                <select name="center_id" class="form-select" aria-label="Select">
                                    <option >Select</option>
                                    @foreach($centers as $center)
                                        <option @if(old('center_id') == $center->id) selected @endif value="{{$center->id}}">{{$center->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('center_id'))
                                    <div class="text-danger">{{ $errors->first('center_id') }}</div>
                                @endif
                            </div>
                            <div class="col-6 text-start">
                                <a href="{{url('')}}" class="btn btn-close-white">Back to home page</a>
                            </div>
                            <div class="col-6 text-end">
                                <button type="submit" class="btn btn-primary">submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
