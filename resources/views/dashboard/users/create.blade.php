@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">{{trans('admin.home')}} </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">

                                    {{trans('admin.users')}} </a>
                            </li>
                            <li class="breadcrumb-item active">{{trans('admin.create_user')}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form"> {{trans('admin.create_user')}} </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @include('dashboard.includes.alerts.success')
                            @include('dashboard.includes.alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body">
                                <form class="form" action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{trans('admin.name')}}</label>
                                            <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="{{trans('admin.name')}}">

                                            @if ($errors->has('name'))
                                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{trans('admin.email')}}</label>
                                            <input value="{{ old('email') }}" type="email" class="form-control" name="email" placeholder="{{trans('admin.email')}}">
                                            @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">{{trans('admin.phone')}}</label>
                                            <input value="{{ old('phone') }}" type="text" class="form-control" name="phone" placeholder="{{trans('admin.phone')}}">
                                            @if ($errors->has('phone'))
                                            <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">{{trans('admin.password')}}</label>
                                            <input value="{{ old('password') }}" type="password" class="form-control" name="password" placeholder="{{trans('admin.password')}}">
                                            @if ($errors->has('password'))
                                            <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>


                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                <i class="ft-x"></i> {{trans('admin.reset')}}
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> {{trans('admin.save')}}
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>

@stop