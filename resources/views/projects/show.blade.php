@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Project'])

<div class="row mt-4 mx-4">
   <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>
                {{ $project->title }}
                </h4>
            </div>
            <div class="card-body">
            <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill" role="tablist">
                <li class="nav-item">
                    <button type="button" class="btn btn-default"><a 
                    href="{{ route('projects.show', ['id' => $project->id_project, 'tab' => 'overview']) }}">
                    Overview</a></button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn bg-gradient-default"><a 
                    href="{{ route('projects.show', ['id' => $project->id_project, 'tab' => 'planning']) }}">
                    Planning</a></button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn bg-gradient-default">Conducting</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn bg-gradient-default">Reporting</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn bg-gradient-default">Export</button>
                </li>
            </ul>
        </div>  
        </div>
    </div>
</div>

<div class="row mx-4 mx-auto mt-5">
    <div class="col-12">
        <div class="card bg-secondary">
            @yield('tab-content')
        </div>
    </div>
</div>
@endsection
