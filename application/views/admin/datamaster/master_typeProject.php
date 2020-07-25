<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <button data-type="add" class="mb-4 btn btn-outline-dark waves-effect waves-light btn-add">Add Type Project</button>
        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th width="10">No</th>
              <th>Type Project</th>
              <th width="80">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            foreach ($typeProject as $key => $value) { ?>
              <tr>
                <td><?= $i?></td>
                <td><?= $value->type_project?></td>
                <td>
                  <button 
                    data-toggle="tooltip"
                    data-placement="bottom" 
                    title="Edit kategori"
                    data-type="edit"
                    class="btn btn-sm btn-primary btn-edit"
                    data-type-project="<?= $value->type_project?>"
                    data-id="<?= $value->id_type_project?>"
                    style=" cursor: pointer;">
                    <i class="ti-pencil-alt"></i>
                  </button>
                  <button
                    class="btn btn-sm btn-danger btn-delete"
                    data-toggle="tooltip" 
                    data-placement="bottom"
                    title="Delete Kategori"
                    data-id="<?= $value->id_type_project?>"
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

<?php include('modalTypeProject.php');?>