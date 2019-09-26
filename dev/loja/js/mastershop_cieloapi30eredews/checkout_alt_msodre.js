/**
 * Atualizar campos conforme a bandeira selecionada
 * 
 * @return void
 */
mastershop_cieloapi30eredews_atualizarBandeira = function (pNumCartao, pBandeiraCodigo, pBandeiraTipo, pPodeSalvar = false)
{
	var elementoQtdCartoesSelecionada = $$('input:checked[type=radio][name="payment[cc_qtd]"]')[0];
	if (typeof(elementoQtdCartoesSelecionada) != 'undefined')
	{
		qtdCartoesSelecionada = elementoQtdCartoesSelecionada.value;
	}
	else
	{
		qtdCartoesSelecionada = 1;
	}

	mastershop_cieloapi30eredews_atualizarBandeirasImagens(pNumCartao, pBandeiraCodigo);
	mastershop_cieloapi30eredews_mostrarEsconderCampos(pBandeiraCodigo, pBandeiraTipo, pNumCartao, qtdCartoesSelecionada, false, pPodeSalvar, false);
}

/**
 * Atualizar imagem da bandeira do cartão conforme status da seleção
 * 
 * @return void
 */
mastershop_cieloapi30eredews_atualizarBandeiraImagem = function (pElemento, pBandeiraCodigo)
{
	var srcHref = pElemento.src;
	var n = srcHref.lastIndexOf('/');
	var nomeImagem = srcHref.substring(n + 1);
	var codigoElemento = pElemento.up().next('input[type=radio]').value;

	if (pBandeiraCodigo == codigoElemento)
	{
		pElemento.up().show();
	}
	else
	{
		pElemento.up().hide();
	}
}

/**
 * Atualizar imagens de todas as bandeiras para um número de cartão conforme bandeira selecionada
 * 
 * @return void
 */
mastershop_cieloapi30eredews_atualizarBandeirasImagens = function (pNumCartao = 0, pBandeiraCodigo = '')
{
	if (pNumCartao == 0)
	{
		$$('.mastershop_cieloapi30eredews_bandeira img').each(
			function (elemento)
			{
				mastershop_cieloapi30eredews_atualizarBandeiraImagem(elemento, pBandeiraCodigo);
			}
		);
	}
	else
	{
		$$('.mastershop_cieloapi30eredews_bandeira.mastershop_cieloapi30eredews_cartao_' + pNumCartao + ' img').each(
			function (elemento)
			{
				mastershop_cieloapi30eredews_atualizarBandeiraImagem(elemento, pBandeiraCodigo);
			}
		);
	}
}

/**
 * Atualizar imagem da bandeira do cartão conforme status da seleção
 * 
 * @return void
 */
mastershop_cieloapi30eredews_atualizarBandeiraImagemCartaoSalvo = function (pElemento, pCartaoChave)
{
	var srcHref = pElemento.src;
	var n = srcHref.lastIndexOf('/');
	var nomeImagem = srcHref.substring(n + 1);
	var chaveElemento = pElemento.up().next('input[type=radio]').value;
	var codigoBandeira = pElemento.getAttribute('bandeira');

	pElemento.src = pElemento.src.replace(nomeImagem, codigoBandeira + (pCartaoChave == chaveElemento ? '_s' : '') + '.png');
}

/**
 * Atualizar imagens de todas as bandeiras para um número de cartão conforme cartão salvo selecionado
 * 
 * @return void
 */
mastershop_cieloapi30eredews_atualizarBandeirasImagensCartoesSalvos = function (pNumCartao = 0, pCartaoChave = '')
{
	if (pNumCartao == 0)
	{
		$$('.mastershop_cieloapi30eredews_salvos div.lista div.lista-item img').each(
			function (elemento)
			{
				mastershop_cieloapi30eredews_atualizarBandeiraImagemCartaoSalvo(elemento, pCartaoChave);
			}
		);
	}
	else
	{
		$$('.mastershop_cieloapi30eredews_salvos.mastershop_cieloapi30eredews_cartao_' + pNumCartao + ' div.lista div.lista-item img').each(
			function (elemento)
			{
				mastershop_cieloapi30eredews_atualizarBandeiraImagemCartaoSalvo(elemento, pCartaoChave);
			}
		);
	}
}

/**
 * Atualizar campos conforme o cartão salvo selecionado
 * 
 * @return void
 */
mastershop_cieloapi30eredews_atualizarCartaoSalvo = function (pNumCartao, pBandeiraCodigo, pCartaoChave = '')
{
	mastershop_cieloapi30eredews_atualizarBandeirasImagensCartoesSalvos(pNumCartao, pCartaoChave);

	$$('.mastershop_cieloapi30eredews_salvos.mastershop_cieloapi30eredews_cartao_' + pNumCartao + ' div.lista-item').each(
		function (elemento)
		{
			elemento.removeClassName('selecao');
		}
	);

	if (pCartaoChave == '')
	{
		$$('.mastershop_cieloapi30eredews_salvos.mastershop_cieloapi30eredews_cartao_' + pNumCartao + ' div.lista-item.ch-novo').each(
			function (elemento)
			{
				elemento.addClassName('selecao');
			}
		);

		var elementoBandeiraSelecionada = $$('input:checked[type=radio][name="payment[cc_' + pNumCartao + '_bandeira]"]')[0];

		if (typeof(elementoBandeiraSelecionada) != 'undefined')
		{
			elementoBandeiraSelecionada.simulate('click');
			return;
		}
	}

	var elementoQtdCartoesSelecionada = $$('input:checked[type=radio][name="payment[cc_qtd]"]')[0];
	if (typeof(elementoQtdCartoesSelecionada) != 'undefined')
	{
		qtdCartoesSelecionada = elementoQtdCartoesSelecionada.value;
	}
	else
	{
		qtdCartoesSelecionada = 1;
	}

	$$('.mastershop_cieloapi30eredews_salvos.mastershop_cieloapi30eredews_cartao_' + pNumCartao + ' div.lista-item.ch' + pCartaoChave).each(
		function (elemento)
		{
			elemento.addClassName('selecao');
		}
	);

	//Por padrão, mostrar campos de cartões de crédito
	mastershop_cieloapi30eredews_mostrarEsconderCampos(pBandeiraCodigo, 'c', pNumCartao, qtdCartoesSelecionada, pCartaoChave, false, pNumCartao > qtdCartoesSelecionada);
}

/**
 * Atualizar os valores das parcelas conforme a quantidade de cartões
 * selecionados para o pagamento
 * 
 * @return void
 */
mastershop_cieloapi30eredews_atualizarParcelasValoresQtd = function (pQtd)
{
	if (typeof(mastershop_cieloapi30eredews_parcelas) == 'undefined')
	{
		return;
	}

	for (numCartao = 1; numCartao <= pQtd; ++numCartao)
	{
		var elemento = $('mastershopcielows15eredews_cc_' + numCartao + '_parcelas');
		if (!elemento)
		{
			return;
		}

		elemento.options.length = 0;

		var opcao = document.createElement('option');
        opcao.text = '';
        opcao.value = '';
        elemento.options.add(opcao);

		if (typeof(mastershop_cieloapi30eredews_parcelas[pQtd]) != 'object')
		{
			continue;
		}

		for (numCartao2 = 0; numCartao2 < mastershop_cieloapi30eredews_parcelas[pQtd].length; ++numCartao2)
		{
			var opcao = document.createElement('option');
			opcao.text = mastershop_cieloapi30eredews_parcelas[pQtd][numCartao2]['texto'];
			opcao.value = mastershop_cieloapi30eredews_parcelas[pQtd][numCartao2]['parcelas'];
			elemento.options.add(opcao);

			if (typeof(mastershop_cieloapi30eredews_parcelasSel) != 'undefined')
			{
				if (mastershop_cieloapi30eredews_parcelas[pQtd][numCartao2]['parcelas'] == mastershop_cieloapi30eredews_parcelasSel[numCartao])
				{
					elemento.options[elemento.options.length - 1].selected = true;
				}
			}
		}
	}

	textoAvista = mastershop_cieloapi30eredews_parcelas[pQtd][0]['texto'];
	textoParcelasMax = mastershop_cieloapi30eredews_parcelas[pQtd][mastershop_cieloapi30eredews_parcelas[pQtd].length - 1]['texto'];

	$$('.mastershop_cieloapi30eredews_salvos .parcelasmax').each(
		function (elemento)
		{
			elemento.innerHTML = textoParcelasMax;
		}
	);
	$$('.mastershop_cieloapi30eredews_salvos .avista').each(
		function (elemento)
		{
			elemento.innerHTML = textoAvista;
		}
	);
}

/**
 * Atualizar campos conforme a quantidade de cartões selecionada para pagamento
 * 
 * @return void
 */
mastershop_cieloapi30eredews_atualizarQtdCartoes = function (pQtd)
{
	//Atualizar imagens conforme quantidade selecionada
	$$('.mastershop_cieloapi30eredews_qtdsel div.lista div.lista-item img').each(
		function (elemento)
		{
			var srcHref = elemento.src;
			var n = srcHref.lastIndexOf('/');
			var nomeImagem = srcHref.substring(n + 1);
			var qtdElemento = elemento.up().next('input[type=radio]').value;

			elemento.src = elemento.src.replace(nomeImagem, qtdElemento + (pQtd == qtdElemento ? '_s' : '') + '.png');
		}
	);

	//Atualizar campos
	var possuiCartoesSalvos = $$('.mastershop_cieloapi30eredews_salvos').length > 0;

	for (numCartao = 1; numCartao <= mastershop_cieloapi30eredews_qtdMaxCartoes; ++numCartao)
	{
		if (numCartao > pQtd)
		{

			mastershop_cieloapi30eredews_mostrarEsconderCampos('', 'c', numCartao, pQtd, '', false, true);
		}
		else
		{
			if (possuiCartoesSalvos)
			{
				var elementoCartaoSalvo = $$('input:checked[type=radio][name="payment[cc_' + numCartao + '_salvo]"]')[0];

				if (typeof(elementoCartaoSalvo) != 'undefined')
				{
					elementoCartaoSalvo.simulate('click');
				}
				else
				{
					//Por padrão, selecionar opção novo cartão e exibir formulário
					$$('input[type=radio][name="payment[cc_' + numCartao + '_salvo]"]').each(
						function (elemento)
						{
							if (elemento.value == '')
							{
								elemento.checked = true;
							}
						}
					)

					mastershop_cieloapi30eredews_atualizarCartaoSalvo(numCartao, '', false);
				}
			}
			else
			{
				var elementoBandeiraSelecionada = $$('input:checked[type=radio][name="payment[cc_' + numCartao + '_bandeira]"]')[0];

				if (typeof(elementoBandeiraSelecionada) != 'undefined')
				{
					elementoBandeiraSelecionada.simulate('click');
				}
				else
				{
					//Por padrão, mostrar campos de cartões de crédito
					mastershop_cieloapi30eredews_mostrarEsconderCampos('', 'c', numCartao, pQtd, false, numCartao > pQtd);
				}
			}
		}
	}

	//Atualizar valores das parcelas
	mastershop_cieloapi30eredews_atualizarParcelasValoresQtd(pQtd);
}

/**
 * Inicializar campos (decidir quais serão exibidos) após carregar o formulário
 * 
 * @return void
 */
mastershop_cieloapi30eredews_inicializarCampos = function()
{
	var elementoQtdCartoesSelecionada = $$('input:checked[type=radio][name="payment[cc_qtd]"]')[0];
	if (typeof(elementoQtdCartoesSelecionada) != 'undefined')
	{
		qtdCartoesSelecionada = elementoQtdCartoesSelecionada.value;
	}
	else
	{
		qtdCartoesSelecionada = 1;
	}

	mastershop_cieloapi30eredews_atualizarQtdCartoes(qtdCartoesSelecionada);
}

/**
 * Mostrar ou esconder campos conforme o tipo e quantidade de cartões selecionado
 * 
 * @returns void
 */
mastershop_cieloapi30eredews_mostrarEsconderCampos = function(
	pBandeiraCodigo,
	pBandeiraTipo,
	pNumCartao,
	pQtdSelecionada,
	pCartaoSalvoCodigo = false,
	pPodeSalvar = false,
	pEsconder = false
)
{
	//Mostrar campos
	if (!pEsconder)
	{
		//Campos de cartões dependentes da quantidade
		if (pQtdSelecionada > 1)
		{
			//Mostrar número do cartão
			$$('.mastershop_cieloapi30eredews_qtd.mastershop_cieloapi30eredews_cartao_' + pNumCartao).each(
				function (elemento)
				{
					elemento.show();
				}
			);
		}
		else
		{
			//Esconder número da posição do cartão
			$$('.mastershop_cieloapi30eredews_qtd.mastershop_cieloapi30eredews_cartao_' + pNumCartao).each(
				function (elemento)
				{
					elemento.hide();
				}
			)
		}

		//Mostrar cartões salvos
		if (pCartaoSalvoCodigo !== false && pCartaoSalvoCodigo != '')
		{
			//Seleção de cartões
			$$('.mastershop_cieloapi30eredews_salvos.mastershop_cieloapi30eredews_cartao_' + pNumCartao).each(
				function (elemento)
				{
					elemento.show();
				}
			);

			//Parcelas
			$$('.mastershop_cieloapi30eredews_parcelas.mastershop_cieloapi30eredews_cartao_' + pNumCartao).each(
				function (elemento)
				{
					if (pBandeiraCodigo != 'discover' && mastershop_cieloapi30eredews_compraNacional)
					{
						elemento.show();
					}
					else
					{
						elemento.hide();
					}
				}
			);

			//Esconder formulário de cartão novo
			$$('.mastershop_cieloapi30eredews_cartao_' + pNumCartao + ':not(.mastershop_cieloapi30eredews_salvos):not(.mastershop_cieloapi30eredews_parcelas):not(.mastershop_cieloapi30eredews_qtd)').each(
				function (elemento)
				{
					elemento.hide();
				}
			);
		}
		else
		//Mostrar campos de formulário para novo cartão
		{
			//Campos dependentes do tipo
			if (pBandeiraTipo != 'b' && pBandeiraTipo != 't')
			//Bandeiras de crédito/débito ou bandeira não selecionada
			{
				$$('.mastershop_cieloapi30eredews_cartao_' + pNumCartao + ':not(.mastershop_cieloapi30eredews_qtd)').each(
					function (elemento)
					{
						elemento.show();
					}
				);

				if (pBandeiraCodigo == 'discover' || !mastershop_cieloapi30eredews_compraNacional)
				{
					$$('.mastershop_cieloapi30eredews_parcelas.mastershop_cieloapi30eredews_cartao_' + pNumCartao).each(
						function (elemento)
						{
							elemento.hide();
						}
					);
				}
			}

			//Opção de salvar dados
			$$('.mastershop_cieloapi30eredews_cartao_' + pNumCartao + ' .mastershop_cieloapi30eredews_salvar').each(
				function (elemento)
				{
					if (pPodeSalvar)
					{
						elemento.show();
					}
					else
					{
						elemento.hide();
					}
				}
			);
		}
	}
	else
	//esconder campos
	{
		$$('.mastershop_cieloapi30eredews_cartao_' + pNumCartao).each(
			function (elemento)
			{
				elemento.hide();
			}
		);
	}
}

/**
 * Salvar quantidade de parcelas selecionada para cada cartão
 * 
 * @return void
 */
mastershop_cieloapi30eredews_salvarParcelas = function (pCampo, pNumCartao)
{
	if (typeof(mastershop_cieloapi30eredews_parcelasSel) != 'undefined')
	{
		mastershop_cieloapi30eredews_parcelasSel[pNumCartao] = pCampo.getValue();
	}
}

/**
 * Adicionar função personalizada para validação da data conforme
 * novos campos do formulário
 * 
 * @return boolean
 */
Validation.add(
	'validar_expiracao',
	'Data de expiração incorreta.',
	function(pValor, pElemento)
	{
		var ccExpMes = pValor;
		var ccExpAno = $(pElemento.id.substr(0,pElemento.id.indexOf('_expiracao')) + '_expiracao_ano').value;
		var tempoAtual = new Date();
		var mesAtual = tempoAtual.getMonth() + 1;
		var anoAtual = tempoAtual.getFullYear();
		if (ccExpMes < mesAtual && ccExpAno == anoAtual)
		{
			return false;
		}

		return true;
	}
);