<div wire:ignore.self class="modal fade" id="modalListaGravacao" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informações sobre a Música</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @if (!empty($listaGravacaoModal))
                    <div class="d-flex h3">
                        <div>
                            @php
                                $proprietario = '';
                            @endphp

                            @if ($listaGravacaoModal->cliente_id)
                                @php
                                    $cliente = $this->buscarUtilizador($listaGravacaoModal->cliente_id);
                                    $fotoUtilizador = $this->buscarFotoPerfil($cliente->id);
                                    $proprietario = $cliente->name;
                                @endphp

                                @if ($fotoUtilizador)
                                    <a href="{{ asset('assets/' . $fotoUtilizador->caminho_arquivo) }}">
                                        <img src="{{ asset('assets/' . $fotoUtilizador->caminho_arquivo) }}"
                                            class="rounded-circle" alt="foto"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                    </a>
                                @else
                                    <img src="{{ asset('assets/img/img_default.jpg') }}" alt="foto"
                                        style="width: 40px; height: 40px; object-fit: cover;">
                                @endif
                                {{ $proprietario }}
                            @elseif($listaGravacaoModal->grupo_id)
                                @php
                                    $proprietario =
                                        $this->buscarGrupo($listaGravacaoModal->grupo_id)->nome . ' (Grupo)';
                                @endphp
                                {{ $proprietario }}
                            @endif
                        </div>
                    </div>

                    <p class="mt-4"><b>Título: </b> {{ $listaGravacaoModal->titulo_audio }}</p>

                    <p> <b>Participação: </b>
                        @php
                            $idGravacao = $listaGravacaoModal->id;
                            $todosParticipantes = $this->buscarParticipantesGravacao($idGravacao);
                            $particEscolhidos = $this->cortarUltimavirgula($todosParticipantes);
                        @endphp

                        {{ $particEscolhidos ? $particEscolhidos : 'Nenhuma' }}
                    </p>

                    <p><b>Estilo:</b>
                        {{ $this->buscarEstilos($listaGravacaoModal->estilo_audio) ? $this->buscarEstilos($listaGravacaoModal->estilo_audio)->tipo : '' }}
                    </p>

                    <p><b>Data da Gravação:</b>
                        {{ $this->formatarDataNormal($listaGravacaoModal->data_gravacao) }}</p>

                    <p><b>Estado:</b>
                        {{ ucwords($listaGravacaoModal->estado_gravacao) }}
                    </p>

                    <p><b>Duração da Gravação: </b> {{ $listaGravacaoModal->duracao }}</p>
                    <p><b>Responsável pelo Agendamento: </b>
                        {{ $this->buscarUtilizador($listaGravacaoModal->responsavel)->name }}
                    </p>

                    <p>
                        @if ($listaGravacaoModal->estado_gravacao == 'gravado')
                            <b>Foi Gravado:</b>
                            {{ $this->formatarData($listaGravacaoModal->updated_at) }} <i
                                class="bi bi-check text-success  "></i>
                        @else
                            @if ($this->buscarUtilizador($idUtilizadorLogado)->tipo_acesso == 1)
                                <b>Concluir Gravação:</b>
                                <button class="btn btn-success" wire:click="concluirAgendamento({{ $idGravacao }})">
                                    Concluir
                                </button>
                            @endif
                        @endif
                    </p>
                @else
                    <p>Nenhuma informação disponível.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('abrirModalListaGravacao', () => {
            var modal = new bootstrap.Modal(document.getElementById('modalListaGravacao'));
            modal.show();
        });
    });
</script>
