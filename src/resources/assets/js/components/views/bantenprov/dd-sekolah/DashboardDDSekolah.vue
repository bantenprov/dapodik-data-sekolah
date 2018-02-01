<template>
  <div>

    <div class="row">
      <div class="col-md-4 mb-3">
        <div class="card card-media text-white bg-primary">
          <div class="card-body">
            <div class="media">
              <div class="media-body text-truncate">
                <div class="card-body">
                  <dd-sekolah-bar-03></dd-sekolah-bar-03>
                </div><!-- /.card-body -->
              </div>
            </div>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- /col -->
      <div class="col-md-4 mb-3">
        <div class="card card-media text-white bg-success">
          <div class="card-body">
            <div class="media">
              <div class="media-body text-truncate">
                <div class="card-body">
                  <dd-sekolah-pie-03></dd-sekolah-pie-03>
                </div><!-- /.card-body -->
              </div>
            </div>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- /col -->
      <div class="col-md-4 mb-3">
        <div class="card card-media text-white bg-warning">
          <div class="card-body">
            <div class="media">
              <i class="fa fa-calendar fa-card-media-avatar mr-3" aria-hidden="true"></i>
              <div class="media-body text-truncate">
                <h5 class="mt-0">Agenda</h5>
                <span><i class="fa fa-dot-circle-o" aria-hidden="true"></i> 30</span>
              </div>
            </div>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- /col -->
    </div><!-- /.row -->

    <!-- ===================================================================== -->

    <div class="row">

        <div class="col-md-8">

          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart" aria-hidden="true"></i>
              Dapodik Data Sekolah Berdasarkan Wilayah
            </div>
            <div class="card-body">
              <dd-sekolah-bar-01></dd-sekolah-bar-01>
            </div><!-- /.card-body -->
          </div><!-- /.card -->

        </div><!-- /col -->


        <div class="col-md-4">

          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart" aria-hidden="true"></i>
              Dapodik Data Sekolah Berdasarkan Wilayah
            </div>
            <div class="card-body">
              <dd-sekolah-pie-01></dd-sekolah-pie-01>
            </div><!-- /.card-body -->
          </div><!-- /.card -->

        </div><!-- /col -->
      <div class="row">

      </div>
      <div class="col-md-4">

        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-pie-chart" aria-hidden="true"></i>
            Dapodik Data Sekolah Berdasarkan Tahun
          </div>
          <div class="card-body">
            <dd-sekolah-pie-02></dd-sekolah-pie-02>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- /.col -->

      <div class="col-md-8">

        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-bar-chart" aria-hidden="true"></i>
            Dapodik Data Sekolah Berdasarkan Tahun
          </div>
          <div class="card-body">
            <dd-sekolah-bar-02></dd-sekolah-bar-02>
          </div><!-- /.card-body -->
        </div><!-- /.card -->

      </div>
      <div class="col-md-12">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table" aria-hidden="true"></i>
            Table
          </div>
          <div class="card-body">
            <table class="table mb-0">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Date</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Muhammad Ibnu Musa Al-Khawarizmi</td>
                  <td>780–850</td>
                </tr>
                <tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Abu Ali Al-Husein Ibnu Sina</td>
                  <td>986-1037</td>
                </tr>
                  <th scope="row">3</th>
                  <td>Abu Nasir Al-Farabi</td>
                  <td>870-900</td>
                </tr>
              </tbody>
            </table>
          </div><!-- /.card-body -->
        </div><!-- /.card -->

      </div><!-- /col -->
      </div>
    </div><!-- /.row -->

  </div>
</template>

