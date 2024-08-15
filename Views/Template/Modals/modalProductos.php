  <!--=====================================
      MODAL PARA EL INGRESO DE PRODUCTOS
    ======================================-->

  <div class="modal fade" id="modalFormProductos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titleModal">Nuevo Producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formProductos" name="formProductos" class="form-horizontal">

            <input type="hidden" id="idProducto" name="idProducto" value="">

            <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
            <div class="row">
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-6">

                    <label class="control-label">Nombre Producto <span class="required">*</span></label>
                    <input class="form-control" id="txtNombre" name="txtNombre" type="text" onkeyup="mayus(this);" required="">
                  </div>

                  <div class="col-md-6">
                    <label class="control-label">Código <span class="required">*</span></label>
                    <input class="form-control" id="txtCodigo" name="txtCodigo" type="text" onkeyup="mayus(this);" required="">
                    <br>
                    <!--=====================================
                        <div id="divBarCode" class="notblock textcenter">
                            <div id="printCode">
                                <svg id="barcode"></svg> 
                            </div>
                            <button class="btn btn-success btn-sm" type="button" onClick="fntPrintBarcode('#printCode')"><i class="fas fa-print"></i> Imprimir</button>
                        </div>
                         ======================================-->
                  </div>

                  <div class="form-group col-md-3">

                    <label for="listCategoriaColor">Color <span class="required">*</span></label>
                    <select class="form-control select2 valid validText" data-live-search="true" id="listCategoriaColor" name="listCategoriacolor">

                    </select>

                  </div>
                  <div class="form-group col-md-3">

                    <label for="listCategoriaPre">Presentación <span class="required">*</span></label>
                    <select class="form-control select2 valid validText" data-live-search="true" id="listCategoriaPre" name="listCategoriaPre">

                    </select>

                  </div>

                  <div class="form-group col-md-6">

                    <label for="listCategoria">Categoría <span class="required">*</span></label>
                    <select class="form-control select2 valid validText" data-live-search="true" id="listCategoria" name="listCategoria">

                    </select>

                  </div>

                </div>

                <div class="form-group">
                  <label class="control-label">Descripción Producto</label>
                  <textarea class="form-control" id="txtDescripcion" name="txtDescripcion"></textarea>
                </div>

              </div>
              <div class="col-md-4">

                <div class="row">

                  <div class="form-group col-md-6">
                    <label for="listStatus">Estado <span class="required">*</span></label>
                    <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                      <option value="1">Activo</option>
                      <option value="2">Inactivo</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="control-label">Tamaño <span class="required">*</span></label>
                    <input class="form-control" id="txtTamanio" name="txtTamanio" type="text" onkeyup="mayus(this);" required="" placeholder="0">
                  </div>



                </div>

                <div class="row">

                  <div class="form-group col-md-6">
                    <label class="control-label">Precio ( $ )<span class="required">*</span></label>
                    <input class="form-control valid validNumber" id="txtPrecio" name="txtPrecio" type="text" required="" placeholder="$ 0.00 ">
                  </div>


                  <div class="form-group col-md-6">
                    <label class="control-label">Descuento ( % )</label>
                    <input class="form-control valid validNumber" id="txtDescuento" name="txtDescuento" type="text" placeholder="0 %" disabled="">

                    <label class="switch" style="margin-top: 10px;">
                      <input type="checkbox" id="checkProDesc" name="checkProDesc" onclick="checkPorducto()">
                      <span class="slider round"></span>
                    </label>

                  </div>



                </div>
                <div class="tile-footer">
                  <div class="form-group col-md-12">
                    <div id="containerGallery">
                      <span>Agregar foto (440 x 545)</span>
                      <button class="btnAddImage btn btn-info btn-sm" type="button">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                    <hr>
                    <div id="containerImages">
                      <!-- <div id="div24">
                             <div class="prevImage">
                                 <img src="<?= media(); ?>/images/uploads/producto1.jpg">
                             </div>
                             <input type="file" name="foto" id="img1" class="inputUploadfile">
                             <label for="img1" class="btnUploadfile"><i class="fas fa-upload "></i></label>
                             <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')"><i class="fas fa-trash-alt"></i></button>
                         </div>
                         <div id="div24">
                             <div class="prevImage">
                                 <img class="loading" src="<?= media(); ?>/images/loading.svg">
                             </div>
                             <input type="file" name="foto" id="img1" class="inputUploadfile">
                             <label for="img1" class="btnUploadfile"><i class="fas fa-upload "></i></label>
                             <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')"><i class="fas fa-trash-alt"></i></button>
                         </div> -->

                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="form-group col-md-6">
                    <button id="btnActionForm" class="btn btn-primary btn-lg btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
                  </div>
                  <div class="form-group col-md-6">
                    <button class="btn btn-danger btn-lg btn-block" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>


  <!--=====================================
      MODAL PARA APLICAR DESCUENTOS A PRODUCTOS
    ======================================-->

  <div class="modal fade" id="modalProductosDesc" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titleModal">Descuento de productos</h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>

        <div class="modal-body ">
          <div class="tile-body">

            <form id="formProductosDesc" name="formProductosDesc" class="form-horizontal" enctype="multipart/form-data">

              <input type="hidden" id="idproducto" name="idproducto">

              <div class="col-lg-12">
                <div class="form-row ">

                  <div class="form-group col-md-12">

                    <label for="tipoDescuento">Aplicar descuento <span class="required">*</span></label>
                    <select class="form-control" id="tipoDescuento" name="tipoDescuento">
                      <option selected value="">Selleccione...</option>
                      <option value="1">Todos</option>
                      <option value="2">Por producto</option>
                      <option value="3">Por categoria</option>
                    </select>
                  </div>


                  <div class="form-group col-md-12">

                    <label name="categoriaLabel" Style="display:none">Categoria</label>
                    <select class="form-control select2" data-live-search="true" Style="display:none" id="categoriaDesc" name="categoriaDesc">
                      <option selected value="">Selleccione...</option>

                      <?php foreach ($data['categorias'] as $key => $value) : ?>
                        <option value="<?php echo $value['nombre'] ?>"><?php echo $value['nombre'] ?></option>
                      <?php endforeach; ?>

                    </select>
                  </div>

                  <div class="form-group col-md-12">
                    <label name="codigoLabel" Style="display:none">Código </span></label>
                    <input type="text" class="form-control" id="CodigoDesc" name="CodigoDesc" placeholder="ingrese código a buscar" Style="display:none" onkeyup="mayus(this);">
                  </div>

                  <div class="form-group col-md-12">
                    <label name="nombreLabel" Style="display:none" ">Nombre </span></label>
          <input  type=" text" class="form-control" id="nombre" name="nombre" Style="display:none" disabled>
                  </div>

                  <div class="form-group col-md-12">
                    <label>Descuento (%)<span class="required">*</span></label>
                    <input type="text" class="form-control validNumber" id="descuento" name="descuento" placeholder="0 %">
                  </div>
                </div>
                <br>

                <button id="btnActionForm" class="btn btn-primary" type="submit" class="button"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Actualizar</span></button>&nbsp;&nbsp;&nbsp;

                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>


  <!--=====================================
      MODAL PARA VER LOS DATOS DE LOS PRODUCTOS
    ======================================-->

  <div class="modal fade" id="modalViewProducto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header header-primary">
          <h5 class="modal-title" id="titleModal">Datos del Producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td>Codigo:</td>
                <td id="celCodigo"></td>
              </tr>
              <tr>
                <td>Nombre:</td>
                <td id="celNombre"></td>
              </tr>
              <tr>
                <td>Precio:</td>
                <td id="celPrecio"></td>
              </tr>
              <tr>
                <td>Precio Descuento:</td>
                <td id="celPrecioDesc"></td>
              </tr>
              <tr>
                <td>Descuento: %:</td>
                <td id="celDescuento"></td>
              </tr>
              <tr>
                <td>Tamaño:</td>
                <td id="celTamanio"></td>
              </tr>
              <tr>
                <td>Color:</td>
                <td id="celColor"></td>
              </tr>
              <tr>
                <td>Presentación:</td>
                <td id="celPresentacion"></td>
              </tr>
              <tr>
                <td>Categoría:</td>
                <td id="celCategoria"></td>
              </tr>
              <tr>
                <td>Status:</td>
                <td id="celStatus"></td>
              </tr>
              <tr>
                <td>Descripción:</td>
                <td id="celDescripcion"></td>
              </tr>
              <tr>
                <td>Fotos de referencia:</td>
                <td id="celFotos">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>