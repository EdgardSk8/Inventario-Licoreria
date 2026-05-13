<link rel="stylesheet" href="{{ Vite::asset('resources/css/respaldo/Respaldo.css') }}">
<script src="{{ Vite::asset('resources/js/respaldo/Respaldo.js') }}"></script>

<div class="exportacion p-2">

    <div class="exportacion-body pe-1">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

            <div>
                <h4 class="fw-bold text-white mb-0">
                    <i class="bi bi-database-fill-gear text-primary me-1"></i>
                    Exportaciones
                </h4>

                <small class="text-secondary">
                    Respaldos y exportación completa del sistema.
                </small>
            </div>

        </div>

        <!-- GRID -->
        <div class="row g-3">

            <!-- EXPORTAR -->
            <div class="col-lg-8">

                <div class="card bg-dark border-secondary text-light h-100">

                    <div class="card-header bg-transparent border-secondary fw-semibold">
                        <i class="bi bi-file-earmark-arrow-down text-success me-2"></i>
                        Exportar Sistema
                    </div>

                    <div class="card-body d-flex flex-column gap-3">

                        <!-- FORMATOS -->
                        <div>

                            <label class="form-label fw-semibold small mb-2">
                                Formato de exportación
                            </label>

                            <div class="row g-2">

                                <div class="col-6 col-md-3">
                                    <input class="btn-check" type="radio" name="formato" id="excel" value="excel" checked>

                                    <label class="btn btn-outline-success w-100 py-3" for="excel">
                                        <i class="bi bi-file-earmark-excel d-block fs-4"></i>
                                        Excel
                                    </label>
                                </div>

                                <div class="col-6 col-md-3">
                                    <input class="btn-check" type="radio" name="formato" id="pdf" value="pdf">

                                    <label class="btn btn-outline-danger w-100 py-3" for="pdf">
                                        <i class="bi bi-file-earmark-pdf d-block fs-4"></i>
                                        PDF
                                    </label>
                                </div>

                                <div class="col-6 col-md-3">
                                    <input class="btn-check" type="radio" name="formato" id="csv" value="csv">

                                    <label class="btn btn-outline-warning w-100 py-3" for="csv">
                                        <i class="bi bi-filetype-csv d-block fs-4"></i>
                                        CSV
                                    </label>
                                </div>

                                <div class="col-6 col-md-3">
                                    <input class="btn-check" type="radio" name="formato" id="sql" value="sql">

                                    <label class="btn btn-outline-info w-100 py-3" for="sql">
                                        <i class="bi bi-database d-block fs-4"></i>
                                        SQL
                                    </label>
                                </div>

                            </div>

                        </div>

                        <!-- INFO -->
                        <div class="alert alert-primary mb-0 small">

                            <div><strong>Excel:</strong> cada tabla se exporta en una hoja.</div>
                            <div><strong>PDF:</strong> genera un documento con los registros del sistema.</div>
                            <div><strong>CSV:</strong> exporta los datos en formato separado por comas.</div>
                            <div><strong>SQL:</strong> incluye estructura y datos completos.</div>

                        </div>

                        <!-- BOTON -->
                        <button
                            type="button"
                            class="btn btn-primary w-100"
                            id="btnExportarSistema">

                            <i class="bi bi-download me-1"></i>
                            Exportar Todo

                        </button>

                    </div>

                </div>

            </div>

            <!-- RESTAURAR -->
            <div class="col-lg-4">

                <div class="card bg-dark border-secondary text-light h-100">

                    <div class="card-header bg-transparent border-secondary fw-semibold">
                        <i class="bi bi-arrow-repeat text-warning me-2"></i>
                        Restaurar
                    </div>

                    <div class="card-body d-flex flex-column gap-3">

                        <div class="alert alert-danger small mb-0">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                            Reemplazará los datos actuales.
                        </div>

                        <div class="upload text-center">

                            <i class="bi bi-cloud-arrow-up fs-1 text-primary"></i>

                            <small class="d-block text-secondary mb-3">
                                Selecciona un respaldo
                            </small>

                            <!-- 🔥 FIX PRINCIPAL -->
                            <input
                                type="file"
                                class="form-control"
                                id="archivoSql"
                                accept=".sql,.txt">

                        </div>

                        <button class="btn btn-danger w-100" id="btnImportarSistema">
                            <i class="bi bi-arrow-clockwise me-1"></i>
                            Restaurar
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


    <div class="toast-container position-fixed top-0 end-0 p-3">

        <div id="toastMensaje" class="toast text-bg-success border-0">

            <div class="d-flex">

            <div class="toast-body" id="toastTexto"></div>

                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>

            </div>

        </div>

    </div>