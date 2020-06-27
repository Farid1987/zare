<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <a href="" class="mb-4 btn btn-outline-dark waves-effect   waves-light">Add User</a>
        <table id="datatable-buttons" class="table table-striped table-bordered" width="100%">
          <thead>
            <tr>
              <th width="10">No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Role</th>
              <th>Alamat</th>
              <th>No Telp</th>
              <th>Kode Pos</th>
              <th>Provinsi</th>
              <th>Kota</th>
              <th width="80">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            foreach ($users as $key => $value) { ?>
              <tr>
                <td><?= $i?></td>
                <td><?= $value->fullname?></td>
                <td><?= $value->email?></td>
                <td><?= $value->role?></td>
                <td><?= $value->address?></td>
                <td><?= $value->phone?></td>
                <td><?= $value->zip_code?></td>
                <td><?= $value->province?></td>
                <td><?= $value->city?></td>
                <td>
                  <?php if ($this->session->userdata("email") != $value->email) { ?>
                    <span data-toggle="tooltip"
                      data-placement="bottom" 
                      title="Edit kategori" >
                      <button 
                        class="btn btn-sm btn-primary btn-edit"
                        style=" cursor: pointer;">
                        <i class="ti-pencil-alt"></i>
                      </button>
                    </span>
                    <button
                      class="btn btn-sm btn-danger btn-delete"
                      data-toggle="tooltip" 
                      data-placement="bottom"
                      title="Delete Kategori"
                      style=" cursor: pointer;">
                      <i class="ti-trash"></i>
                    </button>
                  <?php } ?>
                </td>
              </tr>
            <?php
              $i++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div> <!-- end col -->
</div> <!-- end row -->