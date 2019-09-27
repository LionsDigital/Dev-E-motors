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

mastershop_cieloapi30_desselecionarBandeira = function (pNumCartao)
{
	//Verificar se já há uma bandeira selecionada
	var bandeiraSelecionada = $$('input:checked[type=radio][name="payment[cc_' + pNumCartao + '_bandeira]"]')[0];

	if (typeof(bandeiraSelecionada) != 'undefined')
	{
		var campoNumero = $$('input[name="payment[cc_' + pNumCartao + '_numero]"]')[0];
		if (typeof(campoNumero) != 'undefined')
		{
			campoNumero.removeClassName('com-bandeira');
		}

		bandeiraSelecionada.checked = false;
		return;
	}
}

mastershop_cieloapi30_selecionarBandeira = function (pCampo, pNumCartao)
{
	//Recusar chamada automatizada (onestepcheckout), não chamada no evento keyup do campo
	if (typeof(pCampo) == 'undefined' || typeof(pCampo.value) == 'undefined')
	{
		return pCampo;
	}

	var numeroCc = pCampo.value.replace(/\D/g, '');

	if (typeof(mastershop_cieloapi30_selecaoCc) != 'object')
	{
		return false;
	}

	selecionarCartao = '';

	for (var codigoCartao in mastershop_cieloapi30_selecaoCc)
	{
		var re = new RegExp(mastershop_cieloapi30_selecaoCc[codigoCartao], 'g');

		if (numeroCc.match(re))
		{
			selecionarCartao = codigoCartao
			break;
		}
	}

	//Selecionar bandeira
	if (selecionarCartao == '')
	{
		mastershop_cieloapi30_desselecionarBandeira(pNumCartao);
		mastershop_cieloapi30_atualizarBandeirasImagens(pNumCartao);
		return;
	}

	var bandeiraSelecionar = $$('input[name="payment[cc_' + pNumCartao + '_bandeira]"][value="' + selecionarCartao + '"]')[0];
	if (typeof(bandeiraSelecionar) == 'undefined')
	{
		return;
	}

	if (bandeiraSelecionar.checked)
	{
		return;
	}

	pCampo.addClassName('com-bandeira');

	bandeiraSelecionar.checked = true;
	bandeiraSelecionar.simulate('click');
}

mastershop_cieloapi30_verificarCartaoCompleto = function (pCampo, pNumCartao)
{
	var numero = pCampo.value.replace(/\D+/g, '');

	if (!numero.match(/^\d{14,19}$/))
	{
		mastershop_cieloapi30_desselecionarBandeira(pNumCartao);
		mastershop_cieloapi30_atualizarBandeirasImagens(pNumCartao);
	}
}