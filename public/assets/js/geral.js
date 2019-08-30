function resetForm() {
    document.getElementById("form").reset();
}

function focusOn(idCampo) {
    document.getElementById(idCampo).focus();
}

function confirmar(texto, url) {
    if (confirm(texto)) {
        window.location = url;
    }
}

/**
 * funcao para buscar todos os problemas de acordo com a área selecionada
 */
function findProblemByArea(id) {
    $.get("/ocorrencias/findProblemByArea/"+id, function(data) {
        var strHTML = "";
        $(".sla_prob").html(strHTML);
        for(i = 0; i < data.length; i++) {
            strHTML += "<option value='" + data[i].prob_id + "'>" + data[i].problema + "</option>";
        }
        $("#problema").html(strHTML);
    });
}

/**
 * funcao para buscar todos os operadores de acordo com a área selecionada
 */
function findOperadorByArea(id) {
    $.get("/ocorrencias/findOperadorByArea/"+id, function(data) {
        var strHTML = "";
        for(i = 0; i < data.length; i++) {
            strHTML += "<option value='" + data[i].user_id + "'>" + data[i].nome + "</option>";
        }
        $("#operador").html(strHTML);
    });
}


$("#area").on("change", function() {
    findProblemByArea(this.value);
    findOperadorByArea(this.value);
});

/**
 * funcao para buscar o sla do serviço solicitado
 */
$("#problema").on("change", function() {
    $.get("/ocorrencias/findSlaByProblema/"+this.value, function(data) {
        $(".sla").removeClass("hidden");
        $(".sla_prob").html(data.slas_desc);
    });
});

/**
 * funcao para buscar todas as instituicoes de acordo com o local selecionado
 */
$("#local").on("change", function() {
    $.get("/ocorrencias/findUnidadeByLocal/"+this.value, function(data) {
        var strHTML = "";
        for(i = 0; i < data.length; i++) {
            strHTML += "<option value='" + data[i].inst_cod + "'>" + data[i].inst_nome + "</option>";
        }
        $("#instituicao").html(strHTML);
    });
});

var xFile = 1;
/**
 * Add a new row into table files
 */
$('#add-file').click(function addFileItem(event) {
    event.preventDefault();
    var template = getTemplate('table-files', xFile);
    $('#file-list').append(template);
    xFile++;
});

var getTemplate = function getTemplate(className, reference) {
    return $('tr.' + className + '.remove--X-')
            .get(0)
            .outerHTML
            .replace('table-values ', '')
            .replace(/-X-/g, reference);
};

/**
 * Remove a row from table files
 */
$('#file-list').on("click", ".remove", function removeFileItem(event) {
    event.preventDefault();
    var reference = $(this).attr('data-reference');
    $('#file-list tr.remove-' + reference).remove();
});

$('#form').submit(function() {
    var dados = $(this).serialize();

    $("#resultado").html("<i class='fa fa-refresh fa-spin'></i> Enviando...<span class='sr-only'>Enviando...</span>");

    $.ajax({
        type: "POST", // Tipo de metodo
        url: $(this).attr("action"), //Recebe o valor da action do form
        method: 'POST',
        data: dados,
        success: function (data) {
            $("#resultado").html(data);
        }
    });
    return false;
});

$('#form2').submit(function() {
    var dados = $(this).serialize();

    $("#resultado2").html("<i class='fa fa-refresh fa-spin'></i> Enviando...<span class='sr-only'>Enviando...</span>");

    $.ajax({
        type: "POST", // Tipo de metodo
        url: $(this).attr("action"), //Recebe o valor da action do form
        method: 'POST',
        data: dados,
        success: function (data) {
            $("#resultado2").html(data);
        }
    });
    return false;
});

$('#form3').submit(function() {
    var dados = $(this).serialize();

    $("#resultado3").html("<i class='fa fa-refresh fa-spin'></i> Enviando...<span class='sr-only'>Enviando...</span>");

    $.ajax({
        type: "POST", // Tipo de metodo
        url: $(this).attr("action"), //Recebe o valor da action do form
        method: 'POST',
        data: dados,
        success: function (data) {
            $("#resultado3").html(data);
        }
    });
    return false;
});