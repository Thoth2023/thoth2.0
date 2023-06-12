<div class="card-group justify-content-center">
  <div class="card">
    <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
      <h5>Description</h5>
    </div>
    <div class="card-body pt-2">
      <p>{{ $project->description }}</p>
    </div>
  </div>
  <div class="card">
    <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
      <h5>Objectives</h5>
    </div>
    <div class="card-body pt-2">
      <p>{{ $project->objectives }}</p>
    </div>
  </div>
  <div class="card">
    <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
      <h5>Members</h5>
    </div>
    <div class="card-body pt-2">
      <ul>
        @foreach($users_relation as $user)
            <li>
                <span>{{ $user->username }} - {{ $user->level_name }}</span>
            </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>

<div class="card card-frame mt-5">
    <div class="card-group">
        <div class="card">
            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                <h5>Progress of Systematic Review</h5>
            </div>
            <div class="card-body">
                <div class="progress-wrapper">
                    <div class="progress-info">
                        <div class="progress-percentage">
                            <span class="text-sm font-weight-bold">Planning 60%</span>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="progress-wrapper">
                    <div class="progress-info">
                        <div class="progress-percentage">
                            <span class="text-sm font-weight-bold">Import Studies 70%</span>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="progress-wrapper">
                    <div class="progress-info">
                        <div class="progress-percentage">
                            <span class="text-sm font-weight-bold">Study Selection 50%</span>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="progress-wrapper">
                    <div class="progress-info">
                        <div class="progress-percentage">
                            <span class="text-sm font-weight-bold">Quality Assessment 20%</span>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="progress-wrapper">
                    <div class="progress-info">
                        <div class="progress-percentage">
                            <span class="text-sm font-weight-bold">Data Extraction 95%</span>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 95%;"></div>
                    </div>
                </div>
            </div>
        </div>
        @if (!empty($activities))
            <div class="card card-frame">
                <div class="card-body">
                    <ul>
                        @foreach($activities as $activity)
                            <li>
                                <span>{{ $activity->user() }}: {{ $activity->activity }} - {{ $activity->time }} </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
</div>


