<div class="pagination justify-content-center pt-5">
    <div class="col d-flex justify-content-around">
        <div class="pagination-next">
            @if ($pagina_atual > 1 && count($this->todasActividadesUtl) > 0)
                <a class="btn btn-light text-primary border" href="{{ '?pagina=' . $pagina_atual - 1 }}">
                    <span class="mr-2"><i class="bi bi-arrow-left-circle-fill"></i> <b>Voltar</b> </span>
                </a>
            @endif
        </div>

        <div class="pagination-previous">
            @if ($pagina_atual < $total_paginas && count($this->todasActividadesUtl) > 0)
                <a class="btn btn-light text-primary border" href="{{ '?pagina=' . $pagina_atual + 1 }}">
                    <span class="mr-2"> <b>Ver mais</b> <i class="bi bi-arrow-right-circle-fill"></i></i></span>
                </a>
            @endif
        </div>
    </div>
</div>
