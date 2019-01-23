<?php
echo '
  <script>
    window.setTimeout(function(){
      window.location.href = "'.base_url().'usuario";}, 2500);
  </script>
';
?>
<div class="row">
  <br><br><br><br>
  <div class="col s10 m10 l10 ">
    <center>
      <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-blue-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div><div class="gap-patch">
            <div class="circle"></div>
          </div><div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
      <div>
        <h3 class="red-text text-darken-2">
          Cerrando Session
        </h3>

      </div>
    </center>
  </div>
</div>
