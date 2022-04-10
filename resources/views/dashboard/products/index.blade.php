@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> {{trans('admin.products')}} </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> {{trans('admin.home')}} </a>
                            </li>
                            <li class="breadcrumb-item"> {{trans('admin.products')}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> {{trans('admin.products')}} </h4>
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
                            <div class="container">
                                <form action="{{route('product.filter')}}" method="get">
                                    @csrf
                                    <div class="row mb-2">

                                        <div class="col-md-4">
                                            <label>@lang('admin.added_by')</label>
                                            <select name="user_id" class="select2 form-control" id="user_id">
                                                <option value="0">@lang('admin.added_by')</option>
                                                @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>@lang('admin.brands')</label>
                                            <select name="brand_id" class="select2 form-control" id="brand_id">
                                                <option value="0">@lang('admin.select_brand')</option>
                                                @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>@lang('admin.categories')</label>
                                            <select name="category_id" class="select2 form-control" id="category_id">
                                                <option value="0">@lang('admin.select_category')</option>
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>@lang('admin.status')</label>
                                            <select name="is_active" class="select2 form-control">
                                                <option value="null">@lang('admin.status')</option>
                                                <option value="1">@lang('admin.active')</option>
                                                <option value="0">@lang('admin.not_active')</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label>@lang('admin.type')</label>
                                            <select name="featured" class="form-control">
                                                <option value="null">@lang('admin.select_type')</option>
                                                <option value="1">@lang('admin.featured')</option>
                                                <option value="0">@lang('admin.not_featured')</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2 mt-2">
                                            <button type="submit" class="btn btn-success btn-sm">@lang('admin.Filtrer')</button>
                                        </div>

                                    </div>
                                </form>
                            </div>

                                <div class="card-body card-dashboard">
                                    <table class="table display nowrap table-striped table-bordered ">
                                        <thead class="">
                                            <tr>
                                                <th> {{trans('admin.name')}} </th>
                                                <th> {{trans('admin.main_image')}} </th>
                                                <th> {{trans('admin.slug')}} </th>
                                                <th> {{trans('admin.status')}}</th>
                                                <th> {{trans('admin.action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($products)
                                            @foreach($products as $value)
                                            <tr>
                                                <td>{{$value -> name}}</td>

                                                <td><img style="height: 100px; width:100px" src="{{asset($value->main_image)}}"></td>

                                                <td>{{$value -> slug}}</td>
                                                <td>{{$value -> getActive()}}</td>
                                                <td>
                                                    @include('dashboard.components.table-control', ['permission' => 'products', 'name'=>'products', 'value'=>$value])
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                    <div class="justify-content-center d-flex">
                                        {!! $products->appends(Request::except('page'))->render('vendor.pagination.custom') !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@stop