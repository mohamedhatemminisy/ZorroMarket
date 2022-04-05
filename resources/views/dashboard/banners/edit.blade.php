@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> {{trans('admin.home')}} </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('banners.index')}}"> {{trans('admin.banners')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item active"> {{trans('admin.edit')}} - {{trans('admin.'.$banner -> type)}}
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
                                <h4 class="card-title" id="basic-layout-form"> {{trans('admin.edit')}} - {{trans('admin.'.$banner -> type)}} </h4>
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
                                    <form class="form" action="{{route('banners.update',$banner -> id)}}" method="POST" enctype="multipart/form-data">
                                        {{ method_field('PUT') }}
                                        @csrf
                                        <input name="id" value="{{$banner -> id}}" type="hidden">
                                        <div class="card-body">
                                            <div class="tab-content">

                                                <div class="mb-3">
                                                    <label for="projectinput2"> {{trans('admin.select_banner_type')}} </label>
                                                    <select name="type" class="form-control">
                                                        <option value="slider" @if($banner -> type == 'slider') selected @endif >{{trans('admin.slider')}} </option>
                                                        <option value="banner" @if($banner -> type == 'banner') selected @endif >{{trans('admin.banner')}} </option>
                                                    </select>
                                                    @error('type')
                                                    <span class="text-danger"> {{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="col form-group">
                                                    <label>@lang('admin.image') </label>
                                                    <p><img style="width:200px;height:200px" src="{{asset($banner->image)}}"></p>

                                                </div>
                                                <div class="col form-group">
                                                    <label>@lang('admin.image') <span class="text-danger">*</span></label>
                                                    <input type="file" name="image" placeholder="@lang('admin.image')" class="form-control">
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1" name="is_active" id="switcheryColor4" class="switchery" data-color="success" checked />
                                                            <label for="switcheryColor4" class="card-title ml-1">{{trans('admin.status')}} </label>
                                                            @error("is_active")
                                                            <span class="text-danger">{{$message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                <i class="ft-x"></i> {{trans('admin.reseat')}}
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> {{trans('admin.create')}}
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