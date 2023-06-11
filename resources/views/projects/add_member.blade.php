@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Add Member'])
<div class="card shadow-lg mx-4">
    <div class="container-fluid py-4">
        <p class="card-header pb-0"><h5>Add Member</h5></p>
        <form method="POST" action="{{ route('projects.add_member', $project->id_project) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="emailMemberInput">Email</label>
                <input name="email_member" type="text" class="form-control @error('email_member') is-invalid @enderror" id="emailMemberInput" placeholder="Enter the email">
                @error('email_member')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="levelMemberSelect">Level</label>
                <select class="form-select" id="levelMemberSelect" name="level_member" >
                    <option value="" disabled selected>Select a Level</option>
                    <option value = 2>Viewer</option>
                    <option value = 3>Researcher</option>
                    <option value = 4>Reviser</option>
                </select>
            </div>
            <div class="d-flex align-items-center">
                <button type="submit" class="btn btn-primary btn ms-auto" name="add">Add</button>
            </div>
        </form>   
        
        <table class="table align-items-center justify-content-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Email</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Level</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                        Delete</th>
                </tr>
            </thead>
            <tbody>
                @include('components.alert')
                @foreach ($users_relation as $member)
                    <tr>
                        <td>
                            <div class="d-flex px-2">
                                <div class="my-auto">
                                    <h6 class="mb-0 text-sm">{{ $member->username }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">{{ $member->email }}</p>
                        </td>
                        @if ($member->pivot->level == 1)
                            <td>
                                <p class="text-sm font-weight-bold mb-0">Administrator</p>
                            </td>
                            <td></td>
                        @else
                            <td>
                                <form class="update-member-level-form selectpicker" action="{{ route('projects.update_member_level', ['idProject' => $project->id_project, 'idMember' => $member->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-auto">
                                            <select class="form-select levelMemberSelect2" name="level_member" required>
                                                <option value="2" {{ $member->level_name == 'Viewer' ? 'selected' : '' }}>Viewer</option>
                                                <option value="3" {{ $member->level_name == 'Researcher' ? 'selected' : '' }}>Researcher</option>
                                                <option value="4" {{ $member->level_name == 'Reviser' ? 'selected' : '' }}>Reviser</option>
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('projects.destroy_member', ['idProject' => $project->id_project, 'idMember' => $member->id]) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('layouts.footers.auth.footer')
    </div>
</div>
@endsection
