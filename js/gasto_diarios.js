function mostrarAlerta(){
    $('#alerta_add').show()
}

function esconderAlerta(){
    $('#alerta_add').hide()
}


function cadastrarFormulario(f){
    f.preventDefault()
    var valor_input = $(this).serialize()
    $.ajax({
        type: 'POST',
        data: valor_input,
        url:  'cadastrar_despesas.php'
    }).then(sucesso_full, add_fail)
    
    function sucesso_full(dt_return){
        var retornoVariavel = $.parseJSON(dt_return)

        if(retornoVariavel.error == 0){
            mostrarAlerta()
            listaDespesas()
        }
    }
    function add_fail(){
        alert('Falha na aplicação de cadastro de despesas. !!!')
    }
}

function listaDespesas(data_u=1, data_d=false, vtipo=0){
    
    
        let listaHouseFullD = ""
        let lista_de_despesas
        
        let dt_i   = 'data_i='
        let dt_f   = '&data_f='
        let tipo_c = '&vtipo='+vtipo    
            
        if(data_d){   
             dt_i   += data_u
             dt_f   += data_d
        }
        
        let dadosphp = dt_i+dt_f+tipo_c

    $.ajax({
        type: 'POST',
        data: dadosphp,
        url:  'lista.php'
    }).then(loadList, failList)
    
    function loadList(returnL){
        lista_de_despesas = $.parseJSON(returnL)
        if(lista_de_despesas.error_c != 3){

        $.each(lista_de_despesas, function loadListDysplay(obj_f, obj_h){
            
                let icone
                let tipo_g
            
                if(obj_h.tipo == 1){
                icone = "<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-egg-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path d='M14 10a6 6 0 0 1-12 0C2 5.686 5 0 8 0s6 5.686 6 10z'/></svg>"
                tipo_g = 'Comida'
                }
                else if(obj_h.tipo == 2){
                icone = "<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-tools' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M0 1l1-1 3.081 2.2a1 1 0 0 1 .419.815v.07a1 1 0 0 0 .293.708L10.5 9.5l.914-.305a1 1 0 0 1 1.023.242l3.356 3.356a1 1 0 0 1 0 1.414l-1.586 1.586a1 1 0 0 1-1.414 0l-3.356-3.356a1 1 0 0 1-.242-1.023L9.5 10.5 3.793 4.793a1 1 0 0 0-.707-.293h-.071a1 1 0 0 1-.814-.419L0 1zm11.354 9.646a.5.5 0 0 0-.708.708l3 3a.5.5 0 0 0 .708-.708l-3-3z'/><path fill-rule='evenodd' d='M15.898 2.223a3.003 3.003 0 0 1-3.679 3.674L5.878 12.15a3 3 0 1 1-2.027-2.027l6.252-6.341A3 3 0 0 1 13.778.1l-2.142 2.142L12 4l1.757.364 2.141-2.141zm-13.37 9.019L3.001 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z'/></svg>"
                tipo_g = 'Transporte'
                }
                else if(obj_h.tipo == 3){
                icone = "<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-emoji-sunglasses' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/><path fill-rule='evenodd' d='M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM6.5 6.497V6.5h-1c0-.568.447-.947.862-1.154C6.807 5.123 7.387 5 8 5s1.193.123 1.638.346c.415.207.862.586.862 1.154h-1v-.003l-.003-.01a.213.213 0 0 0-.036-.053.86.86 0 0 0-.27-.194C8.91 6.1 8.49 6 8 6c-.491 0-.912.1-1.19.24a.86.86 0 0 0-.271.194.213.213 0 0 0-.036.054l-.003.01z'/><path d='M2.31 5.243A1 1 0 0 1 3.28 4H6a1 1 0 0 1 1 1v1a2 2 0 0 1-2 2h-.438a2 2 0 0 1-1.94-1.515L2.31 5.243zM9 5a1 1 0 0 1 1-1h2.72a1 1 0 0 1 .97 1.243l-.311 1.242A2 2 0 0 1 11.439 8H11a2 2 0 0 1-2-2V5z'/></svg>"
                tipo_g = 'Lazer'
                }
                else if(obj_h.tipo == 4){
                icone = "<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-clipboard-plus' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/><path fill-rule='evenodd' d='M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3zM8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z'/></svg>"
                tipo_g = 'Saúde'
                }
                else if(obj_h.tipo == 5){
                icone = "<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-briefcase-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z'/><path fill-rule='evenodd' d='M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5v1.384l-7.614 2.03a1.5 1.5 0 0 1-.772 0L0 5.884V4.5zm5-2A1.5 1.5 0 0 1 6.5 1h3A1.5 1.5 0 0 1 11 2.5V3h-1v-.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5V3H5v-.5z'/></svg>"
                tipo_g = 'Trabalho'
                }
                else if(obj_h.tipo == 6){
                icone = "<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-journal-code' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path d='M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z'/><path d='M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z'/><path fill-rule='evenodd' d='M8.646 5.646a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L10.293 8 8.646 6.354a.5.5 0 0 1 0-.708zm-1.292 0a.5.5 0 0 0-.708 0l-2 2a.5.5 0 0 0 0 .708l2 2a.5.5 0 0 0 .708-.708L5.707 8l1.647-1.646a.5.5 0 0 0 0-.708z'/></svg>"
                tipo_g = 'Educarção'
                }
                else if(obj_h.tipo == 7){
                icone =  "<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-house-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M8 3.293l6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z'/><path fill-rule='evenodd' d='M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z'/></svg>"  
                tipo_g = 'Casa'
                }
                else if(obj_h.tipo == 8){
                icone = "<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-shield-fill-check' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M8 .5c-.662 0-1.77.249-2.813.525a61.11 61.11 0 0 0-2.772.815 1.454 1.454 0 0 0-1.003 1.184c-.573 4.197.756 7.307 2.368 9.365a11.192 11.192 0 0 0 2.417 2.3c.371.256.715.451 1.007.586.27.124.558.225.796.225s.527-.101.796-.225c.292-.135.636-.33 1.007-.586a11.191 11.191 0 0 0 2.418-2.3c1.611-2.058 2.94-5.168 2.367-9.365a1.454 1.454 0 0 0-1.003-1.184 61.09 61.09 0 0 0-2.772-.815C9.77.749 8.663.5 8 .5zm2.854 6.354a.5.5 0 0 0-.708-.708L7.5 8.793 6.354 7.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z'/></svg>"  
                tipo_g = 'Higiene'
                }
                else{
                icone = "<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-credit-card-2-back-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0V4zm11.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2z'/><path d='M0 11v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1H0z'/></svg>"
                tipo_g = 'Outros'
                }
    
                listaHouseFullD += "<tr id='id_line'>"
                listaHouseFullD += "<th scope='row'>"+obj_h.valor+"</th>"
                listaHouseFullD += "<td>"+obj_h.despesas+"</td>"
                listaHouseFullD += "<td>"+obj_h.data+"</td>"
                listaHouseFullD += "<td title='"+tipo_g+"'>"+icone+"</td>"
                listaHouseFullD += "<td><a href='detalhes.php?dt="+obj_h.id_despesa+"'><svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-folder2-open' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z'/></svg></td>"
                listaHouseFullD += "<td><input type='checkbox' class='cl_ck' value='"+obj_h.id_despesa+"'></a></td>"
                listaHouseFullD += '</tr>'
          })
        }

        $('#id_td_list').html(listaHouseFullD)
    }
    function failList(){
        alert('algo errado na aplicação')
    }
}

function ativarPesquisa(e){
    e.preventDefault()
    
    let valor_um   = $('#dt_inicial').val()
    let valor_dois = $('#dt_final').val()
    let valor_tipo = $('#idTipoSlc').val()
    
    listaDespesas(valor_um, valor_dois, valor_tipo)
    
    
}

function testedeValor(){
    let val_um   = $('#dt_inicial').val()
    let val_dois = $('#dt_final').val()
    
   $('#dt_final').attr('min',val_um)
    
    
}

function marcaTodas(){
    var inputType = $('.cl_ck') 
    if($(this)[0].checked){ 
        $.each(inputType, function(obj_v, obj_ht){
               obj_ht.checked = true
        })
    }
    else{
        $.each(inputType, function(obj_v, obj_ht){
               obj_ht.checked = false
        })
    }
}

function deleteExp(){
    var intens   = $('.cl_ck')
    var contador = $('.cl_ck').length
    $('#id_mc_full')[0].checked = false
    $.each(intens, function(obj_d, html_d){
        contador -= 1
        if(html_d.checked){
            var dados_d = 'deleteE='+html_d.value
            $.ajax({
                type: 'POST',
                data: dados_d,
                url: 'deleteDespesas.php'
            }).then(sucesso_del, fail_del)

            function sucesso_del(dados_d){               
                $(html_d).closest('tr').fadeOut()
            }
            function fail_del(){
                alert('Erro na aplicação !!!')
            }

        }
    })
}
$('#id_cadastrar_despesas').bind('submit', cadastrarFormulario)

$(window).bind('click', esconderAlerta)

$(window).bind('load', listaDespesas)

$('#id_mc_full').bind('change', marcaTodas)

$('#ex_despesas').bind('click', deleteExp)

$('#pesquisa_lista').bind('submit', ativarPesquisa)

$('#dt_inicial').bind('input', testedeValor)

$('#reset_pesquisa').bind('click', listaDespesas)