@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{trans('admin.users')}} </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('admin.home')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('users.index')}}">{{trans('admin.users')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{trans('admin.Address')}}
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
                                <h4 class="card-title"> {{trans('admin.users')}} </h4>
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

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table class="table display nowrap table-striped table-bordered ">
                                        <thead>
                                            <tr>
                                                <th> {{trans('admin.name')}} </th>
                                                <th> {{trans('admin.phone')}} </th>
                                                <th> {{trans('admin.city')}}</th>
                                                <th> {{trans('admin.state')}}</th>
                                                <th> {{trans('admin.address')}}</th>
                                                <th> {{trans('admin.zipcode')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($addresses as $value)
                                            <tr>
                                                <td>{{ $value->first_name }}{{ $value->last_name }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->city }}</td>
                                                <td>{{ $value->state }}</td>
                                                <td>{{ $value->address }}</td>
                                                <td>{{ $value->zipcode }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

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