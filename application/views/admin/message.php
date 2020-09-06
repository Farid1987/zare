<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th width="10">No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Pesan</th>
              <th width="180">Created At</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            foreach ($message as $key => $value) { ?>
              <tr>
                <td><?= $i?></td>
                <td><?= $value->nama?></td>
                <td><?= $value->email?></td>
                <td><?= $value->pesan?></td>
                <td><?= $value->created_at?></td>
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