
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="mt-5">Form for table <span class="text-primary"><?=$selectedTable?></span></h3>
        <p>Save the code below to the view you want to display the form.</p>
        <p>It is assumed that the values for each field are being sent to the view in the array <code>$formData</code> and the validation errors in <code>$formErrors</code></p>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col scroll">
        <div class="card bg-light">
          <div class="card-body">
            <pre><code><?=$code?></code></pre>
          </div>
        </div>
      </div>
    </div>
  </div>
