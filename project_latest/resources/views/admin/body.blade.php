<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Dashboard</h2>
  </div>
</div>
<section class="no-padding-top no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 col-sm-6">
        <div class="statistic-block block">
          <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title">
              <div class="icon"><i class="icon-user-1"></i></div><strong>Users</strong>
            </div>
            <div class="number dashtext-1">{{ $userCount }}</div>
          </div>
          <div class="progress progress-template">
          <div role="progressbar" style="width: {{ $userCount }}0%;" aria-valuenow="{{ $userCount }}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="statistic-block block">
          <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title">
              <div class="icon"><i class="icon-contract"></i></div><strong>New Posts</strong>
            </div>
            <div class="number dashtext-2">{{ $postCount }}</div>
          </div>
          <div class="progress progress-template">
            <div role="progressbar" style="width: {{ $postCount }}0%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="statistic-block block">
          <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title">
              <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>Approved Post</strong>
            </div>
            <div class="number dashtext-3">{{$userApproved}}</div>
          </div>
          <div class="progress progress-template">
            <div role="progressbar" style="width: {{$userApproved}}0%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3"></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="statistic-block block">
          <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title">
              <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>Pending Post</strong>
            </div>
            <div class="number dashtext-4">{{$userPending}}</div>
          </div>
          <div class="progress progress-template">
            <div role="progressbar" style="width: {{$userPending}}0%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4">
        <div class="stats-with-chart-2 block">
          <div class="title"><strong class="d-block">Credit Sales</strong><span class="d-block">Rejected post</span></div>
          <div class="piechart chart">
            <canvas id="pieChartHome1"></canvas>
            <div class="text"><strong class="d-block">$2.145</strong><span class="d-block">Sales</span></div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="stats-with-chart-2 block">
          <div class="title"><strong class="d-block">Channel Sales</strong><span class="d-block">Lorem ipsum dolor sit</span></div>
          <div class="piechart chart">
            <canvas id="pieChartHome2"></canvas>
            <div class="text"><strong class="d-block">$7.784</strong><span class="d-block">Sales</span></div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="stats-with-chart-2 block">
          <div class="title"><strong class="d-block">Direct Sales</strong><span class="d-block">Lorem ipsum dolor sit</span></div>
          <div class="piechart chart">
            <canvas id="pieChartHome3"></canvas>
            <div class="text"><strong class="d-block">$4.957</strong><span class="d-block">Sales</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>