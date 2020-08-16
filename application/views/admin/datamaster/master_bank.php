<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <button data-type="add" class="mb-4 btn btn-outline-dark waves-effect waves-light btn-add">Add Bank Account</button>
        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th width="10">No</th>
              <th>Nama Bank</th>
              <th>Rekening</th>
              <th>Atas Nama</th>
              <th width="80">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            foreach ($bank as $key => $value) { ?>
              <tr>
                <td><?= $i?></td>
                <td><?= $value->nama?></td>
                <td><?= $value->rekening?></td>
                <td><?= $value->atas_nama?></td>
                <td>
                  <button 
                    data-toggle="tooltip"
                    data-placement="bottom" 
                    title="Edit Bank"
                    data-type="edit"
                    class="btn btn-sm btn-primary btn-edit"
                    data-nama="<?= $value->nama?>"
                    data-rekening="<?= $value->rekening?>"
                    data-atas-nama="<?= $value->atas_nama?>"
                    data-id="<?= $value->id_bank?>"
                    style=" cursor: pointer;">
                    <i class="ti-pencil-alt"></i>
                  </button>
                  <button
                    class="btn btn-sm btn-danger btn-delete"
                    data-toggle="tooltip" 
                    data-placement="bottom"
                    title="Delete Bank"
                    data-id="<?= $value->id_bank?>"
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

<?php include('modalBank.php');?>