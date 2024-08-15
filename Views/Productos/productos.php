<?php 
    headerAdmin($data); 
    getModal('modalProductos',$data);
?>
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-box"></i> <?= $data['page_title'] ?>
              <?php if($_SESSION['permisosMod']['w']){ ?>
               
                <button class="btn btn-primary btn-sm" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Nuevo</button>
                <!--  <button class="btn btn-secondary btn-sm" type="button" onclick="openModalDesc();" ><i class="fas fa-plus-circle"></i> Aplicar Desc.</button>-->

                <?php } ?> 

             
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/productos"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableProductos">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Código</th>
                          <th>Nombre</th>
                          <th>Categoria</th>
                          <th>Tamaño</th>
                          <th>Precio</th>
                          <th>Estado</th> 
                          <th>Acciones</th>
                        </tr>
                      </thead>
        
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </main>
<?php footerAdmin($data); ?>
    