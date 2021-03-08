
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="mt-5">Test Datatable</h3>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col">
        

<table class="table table-bordered table-striped table-sm table-responsive dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">

  <thead>
    <tr>
      <th>Select</th>
      <th>clientEmail</th>
      <th>clientName</th>
      <th>vatRegNo</th>
      <th>regNo</th>
      <th>clientAddress</th>
      <th>clientCity</th>
      <th>clientCounty</th>
      <th>clientCountry</th>
      <th>iban</th>
      <th>bank</th>
      <th>flValid</th>
      <th>Actions</th>
    </tr>
  </thead>

  <tbody>

    <?php foreach ($dataTable as $row) : ?>

    <tr>
      <td>X</td>
      <td><?=$row['clientEmail']?></td>
      <td><?=$row['clientName']?></td>
      <td><?=$row['vatRegNo']?></td>
      <td><?=$row['regNo']?></td>
      <td><?=$row['clientAddress']?></td>
      <td><?=$row['clientCity']?></td>
      <td><?=$row['clientCounty']?></td>
      <td><?=$row['clientCountry']?></td>
      <td><?=$row['iban']?></td>
      <td><?=$row['bank']?></td>
      <td><?=$row['flValid']?></td>
      <td>A</td>
    </tr>

    <?php endforeach; ?>

  </tbody>

</table>


      </div>
    </div>
  </div>
