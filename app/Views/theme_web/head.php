<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CI4 - DBtools</title>

  <!-- Bootstrap core CSS -->
  <link href="/theme_web/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow&display=swap" rel="stylesheet">

  <style type="text/css">
    .scroll {
      max-height: 400px;
      overflow-y: auto;
    }
  </style>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="<?=site_url('/')?>">CI4 DBtools</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?=form_open('',['class'=>'form-inline'],['selectTable'=>'YES'])?>
        <div class="form-group mx-sm-3">
          <select name="table" id="table" class="form-control" onchange="this.form.submit()">
            <?php foreach ($tables as $table) : ?>
              <option value="<?=$table?>"
                <?php if ($table == $selectedTable) echo 'selected'?>
                ><?=$table?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </form>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <?php if ($selectedTable!='_no_table') : ?>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?=site_url('/')?>">Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=site_url('/models')?>">Model</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=site_url('/forms')?>">Form</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=site_url('/datatables')?>">Datatable</a>
            </li>
          </ul>
        <?php endif; ?>
      </div>
    </div>
  </nav>
