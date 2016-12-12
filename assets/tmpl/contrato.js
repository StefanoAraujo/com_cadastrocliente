var jcadastrocliente = jQuery.noConflict();
var cadastroclientes = 
{{CONTRATOCLIENTE}}

function mostrar(arr) 
{
    var lista = jcadastrocliente('#lista'); // Em cache para não ter $('#lista').append() dentro do loop
    lista.html('');
    var li="";
     // Limpar lisa antes de preencher
    arr.forEach(function (rest) {
        rest.anexo.forEach(function(resta){
            li+='<a href={{HREF}}'+resta.arquivo+'>'+resta.arquivo+'</a>';
        });
        lista.append('<div class="caesb_panel"><div class="caesb_panel_titlebar"><span class="caesb_panel-title">C0ntrato Número '+ rest.cadastrocliente +'/'+ rest.ano +' - ' + rest.empresa + '</span></div><div class="caesb_panel_content"><div id="caesb_error_Wrapper"></div><table class="caesb_panel_table"><tbody><tr><td colspan="2"></td></tr><tr><th style="width: 20%"><label>Número do Processo</label></th><td><span>'+ rest.processo +'</span></td></tr><tr><th style="width: 20%"><label>Objeto</label></th><td><span>'+ rest.objeto +'</span></td></tr><tr><th style="width: 20%"><label>CNPJ/CPF Empresa Contratada</label></th><td><span>' + rest.cpfcnpj + '</</span></td></tr><tr><th style="width: 20%"><label>Empresa Contratada</label></th><td><span>' + rest.empresa + '</</span></td></tr><tr><th style="width: 20%"><label id="enderecosede-lbl" for="enderecosede" class="">Documento(s) anexo(s)</label></th><td><div class="btn-group"><button class="btn" title="IR" name="Button" value="ir" type="button"><span >Selecione</span></button><button class="btn  dropdown-toggle" data-toggle="dropdown"><span class="caret">.</span></button><ul class="dropdown-menu"><li>'+li+'</li></ul></div></td></tr></tbody></table></div></div>');
        li = "";
    });

}


jcadastrocliente(function () {
    jcadastrocliente('#buscaCadastroCliente').on('keyup', function () {
    var busca = this.value;
    var filtrados = cadastroclientes.filter(function (rest) {
        return rest.cadastrocliente.toLowerCase().indexOf(busca) != -1;
    });
     mostrar(filtrados);
    });
    jcadastrocliente('#buscaProcesso').on('keyup', function () {
        var busca = this.value;
        var filtrados = cadastroclientes.filter(function (rest) {
            return rest.processo.toLowerCase().indexOf(busca) != -1;
        });
         mostrar(filtrados);
    });
    jcadastrocliente('#buscaCNPJ').on('keyup', function () {
        var busca = this.value;
        var filtrados = cadastroclientes.filter(function (rest) {
            return rest.cpfcnpj.toLowerCase().indexOf(busca) != -1;
        });
         mostrar(filtrados);
    });
    jcadastrocliente('#buscaAno').on('click', function () {
        var busca = this.value;
        var filtrados = cadastroclientes.filter(function (rest) {
            return rest.ano.toLowerCase().indexOf(busca) != -1;
        });
         mostrar(filtrados);
    });
    jcadastrocliente('#buscaAno').on('click', function () {
        var busca = this.value;
        var filtrados = cadastroclientes.filter(function (rest) {
            return rest.ano.toLowerCase().indexOf(busca) != -1;
        });
         mostrar(filtrados);
    });
    jcadastrocliente('#buscaEmpresa').on('click', function () {
        var busca = this.value;
        var filtrados = cadastroclientes.filter(function (rest) {
            return rest.cpfcnpj.toLowerCase().indexOf(busca) != -1;
        });
         mostrar(filtrados);
    });
    mostrar(cadastroclientes);
});


