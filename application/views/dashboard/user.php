<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="<?= base_url('user') ?>">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="video"></span>
              My Video
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('user/privateVideo') ?>">
              <span data-feather="video-off"></span>
              Video Private
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Uploads</span>
          <a class="d-flex align-items-center text-muted" href="#upload" data-toggle="modal" data-target="#upload">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#upload" data-toggle="modal" data-target="#upload">
              <span data-feather="upload"></span>
              Upload
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>User</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="user"></span>
              <?= $this->session->userdata('name') ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout') ?>">
              <span data-feather="log-out"></span>
              Logout
            </a>
          </li>
        </ul>

      </div>
  </div>
  </nav>

  <!-- Modal -->
  <div class="modal fade" id="upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload Video</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <?= form_open_multipart('user/upload') ?>
          <div class="text-center mx-auto text-secondary mt-3">
            <svg width="10em" height="10em" viewBox="0 0 16 16" class="bi bi-upload" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
              <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
            </svg>
            <div class="card-body">
              <hr>
              <div class="custom-file">
                <input type="file" accept="video/*" class="custom-file-input" name="file_name">
                <label class="custom-file-label text-left">Choose file</label>
              </div>
              <br>
              <button type="submit" class="btn btn-primary mt-3">Upload</button>
            </div>
          </div>
          <?= form_close() ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End modal -->