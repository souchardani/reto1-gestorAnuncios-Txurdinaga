<div style="height: 10px; background: #57aa26"></div>
  <footer class="text-bg-light">
    <div class="container">
      <div class="row">
        <div class="col d-flex align-items-center justify-content-center">
          <p class="lead text-center m-auto p-2">
            Diseñado por el grupo 1 de 2DW3 | <span id="year"></span> &copy;
            ----Todos los derechos reservados
          </p>
        </div>
      </div>
    </div>
  </footer>
<div style="height: 10px; background: #ba007b"></div>
<!-- BOOTSTRAP SCRIPTS -->
<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
></script>
<script>
      //para obtener el año actual
      document.querySelector("#year").textContent = new Date().getFullYear();
</script>
