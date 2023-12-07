                        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Crear Evento</button>


                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Crear Evento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form form method="post" action="../../negocio/GDirectorio/NDirectorio.php" id="form_datos">
                                  <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nombre</label>
                                    <input type="text" class="form-control"  name="nombre" placeholder="Nombre" id="recipient-name">
                                  </div>
                                  <div class="form-group">
                                    <label for="message-text" class="col-form-label">Descripción</label>
                                    <textarea class="form-control" name="descripcion" placeholder="descripcion" rows="3" id="message-text"></textarea>
                                  </div>

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="crear" class="btn btn-success">Confirmar</button>
                                  </div>
                                </form>
                              </div>

                            </div>
                          </div>
                        </div>