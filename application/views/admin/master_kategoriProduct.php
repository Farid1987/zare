<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <button data-toggle="modal" data-target=".modal-add" class="mb-4 btn btn-outline-dark waves-effect   waves-light">Add Kategori</button>
        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th width="10">No</th>
              <th>Nama Kategori</th>
              <th width="80">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            foreach ($kategori as $key => $value) { ?>
              <tr>
                <td><?= $i?></td>
                <td><?= $value->nama_kategori?></td>
                <td>
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