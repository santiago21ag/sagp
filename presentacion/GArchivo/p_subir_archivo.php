

<button type="button" class="btn btn-warning mb-2" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Subir Fotografia</button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Subir Fotografia</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form form enctype="multipart/form-data" method="post" action="../../negocio/GArchivo/NArchivo.php" id="form_datos">
                                  <div class="form-group">
                                      <label for="fichero">Nombre</label>
                                      <input name="fichero" type="file" id="fichero" name="fichero" >
                                   </div>
                                    
                                  <div class="form-group">
                                    <label for="message-text" class="col-form-label">Descripción</label>
                                    <textarea class="form-control" name="descripcion" placeholder="descripcion" rows="3" id="message-text"></textarea>
                                  </div>

                                   <div class="form-group">
                                    <label for="message-text" class="col-form-label">Precio</label>
                                    <textarea class="form-control" name="precio" placeholder="precio" rows="3" id="message-text"></textarea>
                                  </div>

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="subir" class="btn btn-success">Confirmar</button>
                                  </div>
                                </form>
                              </div>

                            </div>
                          </div>
                        </div>
