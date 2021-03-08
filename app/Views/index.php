
  <!-- Page Content -->
  <div class="container">
    <div class="row mt-4">
      <div class="col-lg-12 text-center">
        <?php if (isset($_SESSION['error'])) : ?>
          <div class="alert alert-danger" role="alert">
            <?=$_SESSION['error']?>
          </div>
        <?php endif;?>
        <h1 class="mt-2">CodeIgniter 4 - DB Tools</h1>
        <p class="lead">Use these tools to generate DB specific files</p>
      </div>
    </div>

    <?php if ($selectedTable == '_no_table') : ?>

      <div class="card mt-4 alert-info">
        <div class="card-body">
          Select a table from the dropdown above to begin.
        </div>
      </div>

    <?php else : ?>

      <div class="card mt-4">
        <div class="card-header">
          <h3>Table Structure - <span class="text-primary"><?=$selectedTable?></span></h3>
        </div>
        <div class="card-body">
          <table class="table table-sm table-bordered">
            <thead class="bg-dark text-white">
              <th>Field</th>
              <th>Type</th>
              <th>Nullable</th>
              <th>Key</th>
              <th>Default</th>
              <th>Comment</th>
              <th>Collation</th>
            </thead>
            <tbody>
              <?php foreach ($fieldsExt as $key=>$value) : ?>
                <?php switch ($value['Key']) {
                    case 'PRI': ?><tr class="bg-info text-white"><?php break;
                    case 'MUL': ?><tr class="bg-secondary text-white"><?php break;
                    default: ?><tr><?php break;
                  }?>
                  <td><strong><?=$value['Field']?></strong></td>
                  <td class="txt-narrow"><?=$value['Type']?></td>
                  <td><?=$value['Null']?></td>
                  <td><?=$value['Key']?></td>
                  <td class="txt-narrow"><?=$value['Default']?></td>
                  <td class="txt-narrow"><?=$value['Comment']?></td>
                  <td class="txt-narrow"><?=$value['Collation']?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card-header">
          <h3>External links - <span class="text-primary"><?=$selectedTable?></span></h3>
        </div>
        <div class="card-body">
          <?php if (empty($foreignKeys)) : ?>
            NONE
          <?php else: ?>
            <table class="table table-sm table-bordered">
              <thead class="bg-dark text-white">
                <th>Key name</th>
                <th>Relationship</th>
              </thead>
              <tbody>
                <?php foreach($foreignKeys as $fk) : ?>
                  <tr>
                    <td><?=$fk->constraint_name?></td>
                    <td><strong><?=$fk->column_name?></strong> references <strong><?=$fk->foreign_table_name.'.'.$fk->foreign_column_name?></strong></td>
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          <?php endif;?>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card-header">
          <h3>Indexes - <span class="text-primary"><?=$selectedTable?></span></h3>
        </div>
        <div class="card-body">
          <?php if (empty($indexes)) : ?>
            NONE
          <?php else: ?>
            <table class="table table-sm table-bordered">
              <thead class="bg-dark text-white">
                <th>Key name</th>
                <th>Type</th>
                <th>Fields</th>
              </thead>
              <tbody>
                <?php foreach($indexes as $idx) : ?>
                  <?php switch ($idx->type) {
                    case 'PRIMARY': ?><tr class="bg-info text-white"><?php break;
                    case 'UNIQUE': ?><tr class="bg-warning"><?php break;
                    default: ?><tr><?php break;
                  }?>
                    <td><strong><?=$idx->name?></strong></td>
                    <td><?=$idx->type?></td>
                    <td><?=implode(',',$idx->fields)?></td>
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          <?php endif;?>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card-header">
          <h3>Insert array - <span class="text-primary"><?=$selectedTable?></span></h3>
        </div>
        <div class="card-body">
          <pre>
$<?=$selectedTable?>_newRec = [
  <?php foreach ($fieldsExt as $key=>$value) :
    if (!in_array($key,['created_at','updated_at','deleted_at'])) : ?>
  '<?=$key?>' => '<?=$value['Default']?>',
  <?php endif;
  endforeach; ?>
];
          </pre>
        </div>
      </div>

      <div class="card mt-4 alert-secondary">
        <div class="card-header">
          <h3>Create Statement - <span class="text-primary"><?=$selectedTable?></span></h3>
        </div>
        <div class="card-body">
          <pre><?=$createStatement?></pre>
        </div>
      </div>

    <?php endif; ?>
  </div>
