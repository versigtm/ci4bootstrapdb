
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="mt-5">Model for <span class="text-primary"><?=$selectedTable?></span></h3>
        <p>Save the contents below under <code>App\Models\<?=ucfirst($selectedTable)?>.php</code></p>
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
