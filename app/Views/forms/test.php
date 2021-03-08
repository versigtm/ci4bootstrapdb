
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="mt-5">Test Form</h3>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col">
        

<?=form_open('')?>
  <div class="form-row">

    <div class="form-group col-md-6">
      <label for="idClient">idClient</label>
      <input type="number" class="form-control" id="idClient" name="idClient" value="<?=$formData['idClient']?>" step="1">
      <p class="help-block text-danger"><?php if (isset($formErrors['idClient'])) echo "Error idClient"; ?></p>
    </div>

    <div class="form-group col-md-6">
      <label for="user">user</label>
      <input type="text" class="form-control" id="user" name="user" value="<?=$formData['user']?>" maxlength="50">
      <p class="help-block text-danger"><?php if (isset($formErrors['user'])) echo "Error user"; ?></p>
    </div>

    <div class="form-group col-md-6">
      <label for="pass">pass</label>
      <input type="text" class="form-control" id="pass" name="pass" value="<?=$formData['pass']?>" maxlength="70">
      <p class="help-block text-danger"><?php if (isset($formErrors['pass'])) echo "Error pass"; ?></p>
    </div>

    <div class="form-group col-md-6">
      <label for="email">email</label>
      <input type="text" class="form-control" id="email" name="email" value="<?=$formData['email']?>" maxlength="100">
      <p class="help-block text-danger"><?php if (isset($formErrors['email'])) echo "Error email"; ?></p>
    </div>

    <div class="form-group col-md-6">
      <label for="fName">fName *</label>
      <input type="text" class="form-control" id="fName" name="fName" value="<?=$formData['fName']?>" maxlength="100" required="">
      <p class="help-block text-danger"><?php if (isset($formErrors['fName'])) echo "Error fName"; ?></p>
    </div>

    <div class="form-group col-md-6">
      <label for="lName">lName *</label>
      <input type="text" class="form-control" id="lName" name="lName" value="<?=$formData['lName']?>" maxlength="100" required="">
      <p class="help-block text-danger"><?php if (isset($formErrors['lName'])) echo "Error lName"; ?></p>
    </div>

    <div class="form-group col-md-6">
      <label for="phone">phone *</label>
      <input type="text" class="form-control" id="phone" name="phone" value="<?=$formData['phone']?>" maxlength="20" required="">
      <p class="help-block text-danger"><?php if (isset($formErrors['phone'])) echo "Error phone"; ?></p>
    </div>

    <div class="form-group col-md-6">
      <label for="flType">flType</label>
      <select class="form-control" name="flType" id="flType">
        <option value="root" <?php if($formData['flType'] == 'root') echo 'selected' ?>>root</option>
        <option value="admin" <?php if($formData['flType'] == 'admin') echo 'selected' ?>>admin</option>
        <option value="user" <?php if($formData['flType'] == 'user') echo 'selected' ?>>user</option>
      </select>
      <p class="help-block text-danger"><?php if (isset($formErrors['flType'])) echo "Error flType"; ?></p>
    </div>

    <div class="form-group col-md-6">
      <label for="flValid">flValid</label>
      <select class="form-control" name="flValid" id="flValid">
        <option value="P" <?php if($formData['flValid'] == 'P') echo 'selected' ?>>Pending</option>
        <option value="A" <?php if($formData['flValid'] == 'A') echo 'selected' ?>>Active</option>
        <option value="I" <?php if($formData['flValid'] == 'I') echo 'selected' ?>>Inactive</option>
      </select>
      <p class="help-block text-danger"><?php if (isset($formErrors['flValid'])) echo "Error flValid"; ?></p>
    </div>

  </div>

  <button class="btn btn-primary" type="submit">Submit</button>
  
</form>


      </div>
    </div>
  </div>
