<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <button data-type="add" class="mb-4 btn btn-outline-dark waves-effect waves-light btn-add">Add Kategori</button>
        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th width="10">No</th>
              <th>Nama Kategori</th>
              <th>Satuan Harga</th>
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
                <td><?= $value->satuan_harga?></td>
                <td>
                  <button 
                    data-toggle="tooltip"
                    data-placement="bottom" 
                    title="Edit kategori"
                    data-type="edit"
                    class="btn btn-sm btn-primary btn-edit"
                    data-kategori="<?= $value->nama_kategori?>"
                    data-satuan="<?= $value->satuan_harga?>"
                    data-id="<?= $value->id_kategori?>"
                    style=" cursor: pointer;">
                    <i class="ti-pencil-alt"></i>
                  </button>
                  <button
                    class="btn btn-sm btn-danger btn-delete"
                    data-toggle="tooltip" 
                    data-placement="bottom"
                    title="Delete Kategori"
                    data-id="<?= $value->id_kategori?>"
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

<?php include('modalKategoriProduct.php');?>