/**
 * Copyright (C) MasterShop.Ws - Todos os Direitos Reservados
 * A cópia não autorizada deste arquivo por qualquer mídia é proibida.
 * 
 * Proprietário e Confidencial
 * @author Gabriel Mendes <gabriel@mastershop.ws>
 * @license Este arquivo pode ser modificado e redistribuído, desde que os créditos originais sejam mantidos. Venda proibida.
 * Este software não é gratuito mas se modificado ou redistribuído, deverá ser feito através dos termos da GNU General Public
 * License (GPL v3) como publicada pela Free Software Fundation, na versão 3 da Licença ou qualquer versão posterior.
 */

/**
 * Atualizar o menu suspenso de parcelamento quando um valor for
 * especificado por cartão
 * 
 * @return void
 */
mastershop_cieloapi30eredews_atualizarParcelasValorEspecificado = function (pElemento)
{
	var numCartao = parseInt(pElemento.id.substr(pElemento.id.lastIndexOf('_') - 1, 1));
	var elementoParcelas = $('mastershopcieloapi30eredews_cc_' + numCartao + '_parcelas');

	elementoParcelas.options.length = 0;
	var opcao = document.createElement('option');
		opcao.text = Translator.translate('Aguarde, carregando...');
		opcao.value = '';
		elementoParcelas.options.add(opcao);

	new Ajax.Request(
		mastershop_cieloapi30eredews_parcelasUrl,
		{
			method: 'post',
			parameters:
			{
				valor: mastershop_cieloapi30eredews_valorFormatadoParaNumero(pElemento.value),
				moeda: mastershop_cieloapi30eredews_configMoeda.codigo
			},
			onError: function()
			{
				elementoParcelas.options.length = 0;
			},
            onSuccess: function(pDados)
			{
				try
				{
					resultado = pDados.responseText.evalJSON(true);

					elementoParcelas.options.length = 0;
					var opcao = document.createElement('option');
						opcao.text = '';
						opcao.value = '';
						elementoParcelas.options.add(opcao);

					for (it = 0; it < resultado.length; ++it)
					{
						var opcao = document.createElement('option');
							opcao.text = resultado[it].texto;
							opcao.value = resultado[it].parcelas;
							elementoParcelas.options.add(opcao);

						if (
							typeof(mastershop_cieloapi30eredews_parcelasSel[numCartao]) != 'undefined' &&
							mastershop_cieloapi30eredews_parcelasSel[numCartao] == it + 1
						)
						{
							opcao.selected = true;
						}
					}
				}
				catch (err)
				{
					return;
				}
			}
		}
	);
}

/**
 * Evento ativado ao se modificar o valor cobrado para um cartão específico.
 * Atualizar os outros valores com o montante restante
 * 
 * @return void
 */
mastershop_cieloapi30eredews_atualizarValor = function (pEvento)
{
	var elementoValor = pEvento.srcElement;
	var indiceCartao = parseInt(elementoValor.id.substr(elementoValor.id.lastIndexOf('_') - 1, 1));

	//Validar elemento (para valor mínimo)
	var valorOriginal = elementoValor.readAttribute('valor_original');

	elementoValor.toggleClassName('validar_valor_cartao');
	if (!Validation.validate(elementoValor))
	{
		elementoValor.toggleClassName('validar_valor_cartao');
		elementoValor.value = VMasker.toMoney(valorOriginal, mastershop_cieloapi30eredews_configMoeda);

		return;
	}
	elementoValor.toggleClassName('validar_valor_cartao');

	//Verificar se campo foi modificado
	var valorPorCartao = elementoValor.readAttribute('valor_por_cartao');
	var valorEspecificado = mastershop_cieloapi30eredews_valorFormatadoParaNumero(elementoValor.value);

	if (valorEspecificado != valorPorCartao && valorEspecificado != valorOriginal)
	{
		elementoValor.setAttribute('valor_original', valorEspecificado);
		elementoValor.setAttribute('valor_modificado', true);

		mastershop_cieloapi30eredews_atualizarParcelasValorEspecificado(pEvento.srcElement);
	}
	else
	{
		if (valorEspecificado == valorPorCartao)
		{
			elementoValor.removeAttribute('valor_modificado');

			mastershop_cieloapi30eredews_atualizarParcelasValoresQtd(mastershop_cieloapi30eredews_recuperarQtdSelecionada(), indiceCartao);
		}
		else
		{
			return; //nada modificado
		}
	}

	mastershop_cieloapi30eredews_atualizarValores(indiceCartao);
};

/**
 * Verifica os cartões que não tiveram seus valores especificados manualmente
 * e divide os valores entre eles, atualiza outros campos quando necessário
 * 
 * @return void
 */
mastershop_cieloapi30eredews_atualizarValores = function (pPularIndice = 0)
{
	//Dividir valor restante entre campos não modificados
	var valoresEspecificados = mastershop_cieloapi30eredews_recuperarValoresEspecificados();
	var qtdCartoesSelecionada = mastershop_cieloapi30eredews_recuperarQtdSelecionada();

	if (qtdCartoesSelecionada > 1)
	{
		var valorPorCartao = ((mastershop_cieloapi30eredews_multiTotal - valoresEspecificados.totalEspecificado) / valoresEspecificados.camposNaoEspecificados.length).toFixed(2);

		for (indiceCartao = 1; indiceCartao <= qtdCartoesSelecionada; ++indiceCartao)
		{
			if (pPularIndice > 0 && indiceCartao == pPularIndice)
			{
				continue;
			}

			var elementoValor = $('mastershopcieloapi30eredews_cc_' + indiceCartao + '_valor');

			if (null != elementoValor)
			{
				if (!elementoValor.readAttribute('valor_modificado'))
				{
					elementoValor.value = VMasker.toMoney(valorPorCartao, mastershop_cieloapi30eredews_configMoeda);
					elementoValor.setAttribute('valor_original', valorPorCartao);
				}
				
				if (mastershop_cieloapi30eredews_valorFormatadoParaNumero(elementoValor.value) == elementoValor.readAttribute('valor_por_cartao'))
				{
					mastershop_cieloapi30eredews_atualizarParcelasValoresQtd(mastershop_cieloapi30eredews_recuperarQtdSelecionada(), indiceCartao);
				}
				else
				{
					mastershop_cieloapi30eredews_atualizarParcelasValorEspecificado(elementoValor);
				}
			}
		}
	}
}

mastershop_cieloapi30eredews_recuperarValoresEspecificados = function ()
{
	var qtdCartoesSelecionada = mastershop_cieloapi30eredews_recuperarQtdSelecionada();

	//Verificar campos já modificados
	var totalEspecificado = 0;
	var qtdCamposEspecificados = 0;
	var camposNaoEspecificados = [];

	for (numCartao = 1; numCartao <= qtdCartoesSelecionada; ++numCartao)
	{
		var elementoValor = $('mastershopcieloapi30eredews_cc_' + numCartao + '_valor');

		if (null != elementoValor)
		{
			var valorModificado = elementoValor.readAttribute('valor_modificado');

			if (!valorModificado)
			{
				camposNaoEspecificados.push(numCartao);
			}
			else
			{
				++qtdCamposEspecificados;
				totalEspecificado += parseFloat(mastershop_cieloapi30eredews_valorFormatadoParaNumero(elementoValor.value));
			}
		}
	}

	return {
		'totalEspecificado': totalEspecificado,
		'qtdCamposEspecificados': qtdCamposEspecificados,
		'camposNaoEspecificados': camposNaoEspecificados
	};
}

/**
 * Converter valor formatado de moeda em campo mascarado
 * para valor numérico decimal (float)
 * 
 * @return float
 */
mastershop_cieloapi30eredews_valorFormatadoParaNumero = function (pValor)
{
	return parseFloat(
		pValor.replace(mastershop_cieloapi30eredews_configMoeda.unit, '')
		.replace(mastershop_cieloapi30eredews_configMoeda.delimiter, '')
		.replace(mastershop_cieloapi30eredews_configMoeda.separator, '.')
		.replace(' ', '')
	).toFixed(2); //fixed é reconhecido como string em operações +=
};

/**
 * Adicionar função personalizada para validação do total de valores
 * especificados
 * 
 * @return boolean
 */
Validation.add(
	'validar_valor_cartao',
	'Os valores especificados para cada cartão não completam ou ultrapassam o valor total.',
	function(pValor, pElemento)
	{
		if (typeof(mastershop_cieloapi30eredews_multiTotal) == 'undefined')
		{
			return false;
		}

		var qtdCartoesSelecionada = mastershop_cieloapi30eredews_recuperarQtdSelecionada();
		var total = 0;

		for (numCartao = 1; numCartao <= qtdCartoesSelecionada; ++numCartao)
		{
			var elementoValor = $('mastershopcieloapi30eredews_cc_' + numCartao + '_valor');

			if (null != elementoValor)
			{
				total += parseFloat(mastershop_cieloapi30eredews_valorFormatadoParaNumero(elementoValor.value));
			}
		}

		var resto = mastershop_cieloapi30eredews_multiTotal - total;

		if (mastershop_cieloapi30eredews_configMoeda.codigo != 'BRL')
		{
			resto = (resto * mastershop_cieloapi30eredews_configMoeda.rateBaseToBRL).toFixed(2);
		}

		return resto <= 1 && resto >= -0.02;
	}
);

/**
 * Adicionar função personalizada para validação do total de valores
 * especificados
 * 
 * @return boolean
 */
Validation.add(
	'validar_valor_cartao_minimo',
	'O valor mínimo para o cartão não foi atingido.',
	function(pValor, pElemento)
	{
		var valorMinimo = parseFloat(pElemento.readAttribute('valor_minimo'));

		if (mastershop_cieloapi30eredews_configMoeda.codigo != 'BRL')
		{
			valorMinimo = (valorMinimo / mastershop_cieloapi30eredews_configMoeda.rateBaseToBRL).toFixed(2);
		}

		return parseFloat(mastershop_cieloapi30eredews_valorFormatadoParaNumero(pElemento.value)) >= valorMinimo;
	}
);