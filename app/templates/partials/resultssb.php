          <div class="row mt-3">
            <p class="h5 text-secondary">Current Results</p>
          </div>
          <div class="row d-none" id="alertrow">
            <div class="col-12-lg">
          		<div class="alert alert-danger alert-dismissible fade show" role="alert" id="sbalert">
                <span id="alertmessage"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          		</div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <p class="text-secondary">Results Count: <span class="fw-bold" id="resultslen"></span></p>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <p class="text-secondary">Last Result: <span class="fw-bold" id="resultslast"></span></p>
            </div>
          </div>
          <div class="row mb-1">
            <div class="col-lg-10">
              <button class="btn btn-sm btn-outline-info btn-block" name="refresh" id="resultrefreshbtn" value="1"><i class="bi bi-arrow-clockwise"></i> Refresh</button>
            </div>
          </div>
          <div class="row mb-1">
            <div class="col-lg-10">
              <button class="btn btn-sm btn-outline-danger btn-block" name="reset" id="resultresetbtn" value="1"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
            </div>
          </div>
          <div class="row mb-1">
            <div class="col-lg-10">
              <a class="btn btn-sm btn-outline-primary btn-block" href="/evil/" role="button">Results <i class="bi bi-arrow-right-circle-fill"></i></a>
            </div>
          </div>
