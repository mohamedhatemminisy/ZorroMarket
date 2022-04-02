
@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{trans('admin.tests')}} </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('admin.home')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{trans('admin.tests')}}
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
                                    <h4 class="card-title"> {{trans('admin.tests')}} </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
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
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered">
                                            <thead class="">
                                            <tr>
                                                <th>#</th>
                                                <th>{{trans('admin.name')}}</th>
                                                <th>{{trans('admin.price')}}</th>
                                                <th>{{trans('admin.duration')}}</th>
                                                 <th>{{trans('admin.action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($tests )
                                                @foreach($tests as $key => $test)
                                                    <tr>
                                                        <td>{{ $key +1}}</td>
                                                        <td>{{$test ->translate('en')-> name}}</td>
                                                        <td>{{$test -> price}}</td>
                                                        <td>{{$test -> duration}}</td>
                                       
                                                        <td>
                                                        <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                               
                                                                <a href="{{route('tests.edit',$test -> id)}}"
                                                                 class="btn btn-sm btn-clean
                                                                        btn-icon mr-2 " title="@lang('admin.edit')">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>

                                                                   <a href="{{route('tests.show',$test->id)}}"
                                                                   class="btn btn-sm btn-clean
                                                                        btn-icon mr-2 "  title="{{trans('admin.details')}}"><i class="fas fa-eye"></i></a>

                                                                <a href="{{route('tests.delete',$test -> id)}}"
                                                                   class="btn btn-sm btn-clean
                                                                        btn-icon mr-2 "  title="{{trans('admin.delete')}}"><i class="fas fa-trash-alt"></i></a>

                                                            </div>
                                                        </td>
                        
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">
                                        {{ $tests->links('vendor.pagination.custom') }}

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
