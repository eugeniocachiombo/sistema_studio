
var pathname = window.location.pathname;
var partes = pathname.split('/');
var caminho = partes[1];
var indice = 0;

if (caminho.length > 1) {
    if (partes[2] == "agendar" || partes[2] == "adicionar" || partes[2] == "criar" || partes[3] == "clientes") {
        indice = 0;
        $("#" + caminho + "-nav").addClass("show");
        $("#" + caminho + "-nav").addClass("active");
        $("." + caminho + "-nav").removeClass("collapsed");
        $("#" + caminho + "-nav a:eq(" + indice + ")").addClass("active");
    }
    else if (partes[2] == "listar" || partes[3] == "atendentes") {
        indice = 1;
        $("#" + caminho + "-nav").addClass("show");
        $("#" + caminho + "-nav").addClass("active");
        $("." + caminho + "-nav").removeClass("collapsed");
        $("#" + caminho + "-nav a:eq(" + indice + ")").addClass("active");
    }
    else if (partes[2] == "concluir" || partes[3] == "todos") {
        indice = 2;
        $("#" + caminho + "-nav").addClass("show");
        $("#" + caminho + "-nav").addClass("active");
        $("." + caminho + "-nav").removeClass("collapsed");
        $("#" + caminho + "-nav a:eq(" + indice + ")").addClass("active");
    }
}
