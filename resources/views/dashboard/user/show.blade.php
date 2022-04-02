
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
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">@lang('admin.home')</a>
                                </li>
                                <li class="breadcrumb-item active">{{trans('admin.users')}}
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

                            
                                

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        
                                    
                                    <div class="col form-group">
 
                                        <label>@lang('admin.name') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $user->name }}</p>
                                
                                    </div>

                                    <div class="col form-group">
 
                                        <label>@lang('admin.email') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $user->email }}</p>
                                
                                    </div>
                                       
                                    
                                    <div class="col form-group">

                                        <label>@lang('admin.phone') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $user->phone }}</p>                                   
                                     </div>

                                    <div class="col form-group">
 
                                        <label>@lang('admin.id_number') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $user->id_number }}</p>
                                
                                    </div>

                                    <div class="col form-group">
 
                                        <label>@lang('admin.birthrate') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $user->birthrate  }}</p>
                                
                                    </div>

                                    <div class="col form-group">
 
                                        <label>@lang('admin.age') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $user->age  }}</p>
                                
                                    </div>

                                    <div class="col form-group">
 
                                        <label>@lang('admin.gender') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $user->gender  }}</p>
                                
                                    </div>

                                    <div class="col form-group">
 
                                        <label>@lang('admin.country') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">
                                        @php
                                        $country = App\Models\Country::find( $user->nationality);
                                        @endphp
                                        {{  $country->name  }}
                                    </p>
                                
                                    </div>

                                    <div class="col form-group">
 
                                        <label>@lang('admin.ID_image') </label>
                                        <p><img src="{{asset($user->ID_image)}}"></p>
                                
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
