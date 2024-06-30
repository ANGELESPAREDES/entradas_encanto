<div class="modal fade" id="actualizar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Actualizar datos:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="frmactualizar"method="POST" onsubmit="return actualizar()">
                    <div class="col-6 ">
                        <div class="form-floating">
                        <input type="text" class="form-control" id="codigoa" name="codigoa">
                            <label for="floatingTextarea">Codigo:</label>
                        </div>
                        </div>
                        <br>
                        <br>                  
                     <div class="col-12" style="display: flex;">
                       <div class="col-6">
                       <div class="form-floating ">
                        <input type="text" class="form-control" id="productoa" name="productoa" style="text-transform: uppercase;">
                        <label for="floatingInput">Productos</label>
                        </div>
                       </div>
                        <br>
                        <div class="col-6">
                        <div class="form-floating ">
                        <input type="text" class="form-control" id="precioa" name="precioa">
                        <label for="floatingInput">Precio:</label>
                        </div>
                        </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </form>
      </div>
    </div>
  </div>
</div>