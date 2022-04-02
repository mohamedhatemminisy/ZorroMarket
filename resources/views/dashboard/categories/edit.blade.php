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
                            <li class="breadcrumb-item"><a href="{{route('categories.index')}}"> {{trans('admin.categories')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item active"> {{trans('admin.edit')}} - {{$category -> name}}
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
                                <h4 class="card-title" id="basic-layout-form"> {{trans('admin.edit')}} - {{$category -> name}} </h4>
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
                            <div class="container">
                                <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                    @foreach (config('translatable.locales') as $key => $locale)
                                    <li class="nav-item">
                                        <a class="nav-link  @if($key == 0) active @endif" data-toggle="tab" href="{{"#" . $locale}}">@lang('admin.'.$locale)</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @include('dashboard.includes.alerts.success')
                            @include('dashboard.includes.alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{route('categories.update',$category -> id)}}" method="POST" enctype="multipart/form-data">
                                        {{ method_field('PUT') }}
                                        @csrf
                                        <input name="id" value="{{$category -> id}}" type="hidden">
                                        <div class="card-body">
                                            <div class="tab-content">

                                                @foreach (config('translatable.locales') as $key => $locale)

                                                <div class="tab-pane fade show @if($key == 0) active @endif" id="{{$locale}}" role="tabpanel">
                                                    <div class="col form-group">
                                                        <label>@lang('admin.name') (@lang('admin.'.$locale))<span class="text-danger">*</span></label>
                                                        <input type="text" name="{{ $locale.'[name]' }}" id="{{ $locale . '[name]' }}" value="{{old($locale.'.name',$category->translate($locale)->name )}}" placeholder="@lang('admin.name')" class="form-control @error(" $locale.name" ) is-invalid @enderror" value="{{ old($locale.'.name') }}">
                                                        @error("$locale.name" )
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @endforeach
                                                @if($category -> _parent)
                                                <div class="row">
                                                    <div class="col-md-12" id="main_category">
                                                        <div class="form-group ">
                                                            <label for="parent_id"> {{trans('admin.select_category')}} </label>
                                                            <select name="parent_id" class="form-control" id="parent_id">
                                                                <option value="" disabled selected>{{trans('admin.select_category')}}</option>
                                                                @if($categories && $categories -> count() > 0)
                                                                @foreach($categories as $mainCategory)
                                                                <option value="{{$mainCategory -> id }}" @if($mainCategory -> id == $category -> parent_id) selected @endif >{{$mainCategory -> name}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                            @error('parent_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{trans('admin.slug')}}
                                                            </label>
                                                            <input type="text" id="name" class="form-control" placeholder="  " value="{{old('slug',$category->slug )}}" name="slug">
                                                            @error("slug")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
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