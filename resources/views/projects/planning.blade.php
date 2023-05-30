@extends('projects.show')

@section('tab-content')
<div class="card-header bg-secondary">
    <h4>Planning</h4>
    <div class="nav-wrapper position-relative end-0">
        <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1 bg-secondary" role="tablist">
                <li class="nav-item">
                    <button type="button" class="btn btn-secondary"><a>Overall information</a></button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-secondary"><a>Research Questions</a></button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-secondary">Data Bases</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-secondary">Search String</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-secondary">Search Strategy</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-secondary">Criteria</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-secondary">Quality Assessment</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-secondary">Data Extraction</button>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="card card-frame">
        <div class="card-body">
            This is some text within a card body.
        </div>
    </div>
</div>

@endsection