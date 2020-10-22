<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#upload">
        Upload +
      </button>
    </div>
  </div>

  <?php if ($getshare == null) : ?>
    <br><br><br><br><br><br><br><br>
    <div class="text-center text-secondary">
      <svg width="10em" height="10em" viewBox="0 0 16 16" class="bi bi-upload" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
        <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
      </svg>
      <h3 class="text-dark">upload video using the button below</h3>
      <hr>
      <a href="#upload" data-toggle="modal" data-target="#upload">
        <button class="btn btn-primary">Upload</button>
      </a>

    </div>
  <?php endif;
  $i = 0; ?>

  <?php if ($getshare != null) : ?>
    <div class="row">
      <?php foreach ($getshare as $file) : ?>

        <div class="col-sm-4 mb-3">
          <div class="card">
            <div class="card-body">
              <a href="#" class="float-right" data-toggle="modal" data-target="#detailModal<?= $i ?>"><span data-feather="info"></span></a>
              <a href="#">
                <img src="<?= base_url('assets/gambar/play-circle.svg') ?>" class="mx-auto d-block" width="150" height="150">
              </a><br>
              <h5 class="card-title text-center"><?= $file['file_name']; ?></h5>
            </div>
          </div>
        </div>

        <!-- Buka Modal Detail -->
        <div class="modal" id="detailModal<?= $i ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h5 class="font-weight-bold mt-2 mx-2"><?= $file['file_name']; ?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <div class="modal-body container col-11">

                <?php if ($file['email'] == $this->session->userdata('email')) : ?>
                  <?php if ($file['share'] == 0) : ?>
                    <a href="<?= base_url('user/shareOn/' . $file['file_id']) ?>" class="text-decoration-none text-secondary float-right">
                      Share : <button class="btn btn-sm btn-outline-primary">OFF</button>
                    </a>
                    <br><br>
                  <?php endif; ?>
                  <?php if ($file['share'] == 1) : ?>
                    <a href="<?= base_url('user/shareOff/' . $file['file_id']) ?>" class="text-decoration-none text-secondary float-right">
                      Share : <button class="btn btn-sm btn-primary">ON</button>
                    </a>
                    <br><br>
                  <?php endif; ?>
                <?php endif; ?>

                <h5 class="text-center"><i class="fas fa-info-circle"></i> Details</h5>
                <table>
                  <tr>
                    <td>
                      <h6 class="">Type</h6>
                    </td>
                    <td>
                      <h6 class="">:</h6>
                    </td>
                    <td>
                      <h6 class="">.mp4</h6>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h6 class="">Upload</h6>
                    </td>
                    <td>
                      <h6 class="">:</h6>
                    </td>
                    <td>
                      <h6 class=""><?= date('d M Y | H:i', strtotime($file['upload_time'])) ?></h6>
                    </td>
                  </tr>
                </table>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <a class="text-decoration-none" href="<?= base_url('user/delete/' . $file['file_id']); ?>">
                  <button class="btn btn-outline-danger btn-block"><i class="fas fa-trash-alt"></i> Delete</button>
                </a>
                <a class="text-decoration-none" href="<?= base_url('./' . $file['email'] . '/' . $file['file_name']); ?>" download>
                  <button class="btn btn-success btn-block">Download</button>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- Tutup Modal Detail -->
    </div>
  <?php $i++;
      endforeach; ?>
<?php endif; ?>


</main>