 <div class="modal-body">
                        <div class="row">
                          <div class="col-xs-12 col-sm-6 ">
                            <div class="form-group">
                              	<label for="form-field-select-3">Documento Cliente</label>
                              		<div class="input-group">
                               			<span class="input-group-addon">
                               			<i class="ace-icon fa fa-bank"></i>
                               			</span>
                    						<input type="number" name="TxtDocumento" id="TxtDocumento" class="input-large" placeholder="Documento" style="text-transform:uppercase;">
                              		</div>
                            </div>
                            
                         <div id="MsjError"></div>
                            <div class="form-group">
                              <label for="form-field-select-3">Nombres</label>

                              <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="ace-icon fa fa-user"></i>
                                </span>
                        <input type="text" autocomplete="off" name="TxtNombre" id="TxtNombre" class="input-large" placeholder="Nombre del Cliente" style="text-transform:uppercase;">
                              </div>
                            </div>
                             <div class="form-group">
                              <label for="form-field-select-3">Apellidos</label>

                              <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="ace-icon fa fa-user"></i>
                                </span>
                        <input type="text" autocomplete="off" name="TxtApellido" id="TxtApellido" class="input-large" placeholder="Apellidos del Cliente" style="text-transform:uppercase;">
                              </div>
                            </div>
                          </div>

                      <div class="col-xs-12 col-sm-6 ">
                      <div class="form-group">
                              <label for="form-field-select-3">Celular</label>

                              <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="ace-icon fa fa-mobile-phone"></i>
                                </span>

                <input name="TxtCelular" class="form-control input-mask-phone" type="text" id="form-field-mask-2" />
                              </div>
                            
                     </div>
                     
                             <div class="form-group">
                             
                              <label for="form-field-select-3">Ciudad</label>
                             
                          <div class="col-md-12 col-sm-12">
                        <!-- <select class="" name="TxtCiudad" data-placeholder="Seleccionar..."> -->
            <select required="true" class="chosen-select input-xxlarge" name="TxtCiudad" id="TxtCiudad" data-placeholder="Seleccionar...">
                                <option value="">Seleccionar...</option>
                                <?php
$sql ="SELECT Id_Ciudad, Nom_Ciudad FROM t_ciudades order by Nom_Ciudad ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SelectId_Ciudad=$row['Id_Ciudad'];
      $SelectNom_Ciudado=$row['Nom_Ciudad'];             
      echo ("<option value='".$SelectId_Ciudad."'>".utf8_encode($SelectNom_Ciudado)."</option>");
 }
}
        
?>
                                  
                        </select>
                              </div>
                            
                            </div>
                              <div class="form-group">
                              <label for="form-field-select-3">E-mail</label>

                              <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="ace-icon fa fa-envelope"></i>
                                </span>
              <input type="email" name="TxtCorreo" required="true" class="input-large" placeholder="Dirección de Cliente" >
                              </div>
                            
                            </div>
                    
                          </div>

                          <div class="form-group">
                 <label for="form-field-select-3">Dirección</label>
                  <input type="text" name="TxtDireccion" class="form-control" placeholder="Dirección de Envío">
                </div>

                          </div>              
                <div style="display: none;" class="row">
                	<div class="col-sm-12 col-xs-12 col-md-12">
                		<div class="col-sm-4 col-md-4">
                			<label>Fecha de Nacimiento</label>
                		</div>
                		<div class="col-sm-8 col-xs-8 col-md-8">
                			<label for="form-field-select-3">Día</label>
                			<select name="Fechadia">
                				<option value="">Día</option>
                				<?php 
                					for ($i=1; $i <32 ; $i++) { 
                						echo("<option value='".$i."'>".$i."</option>");
                					}
                				 ?>
                			</select>
                			<label for="form-field-select-3">Mes</label>
                			<select name="Fechames">
                				<option value="">Mes</option>
                				<?php 
                					for ($i=1; $i <13 ; $i++) { 
                						echo("<option value='".$i."'>".$i."</option>");
                					}
                				 ?>
                			</select>
                			<label for="form-field-select-3">Año</label>
                			<select name="Fechaano">
                				<option value="">Año</option>
                				<?php 
                					for ($i=1919; $i <2020 ; $i++) { 
                						echo("<option value='".$i."'>".$i."</option>");
                					}
                				 ?>
                			</select>
                		</div>
                    </div>
                </div>
 
                        </div>