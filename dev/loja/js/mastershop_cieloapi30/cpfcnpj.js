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

mastershop_cieloapi30_atualizarCpfCnpj = function (pCampo)
{
	pCampo.removeClassName('validar_cnpj');
	pCampo.removeClassName('validar_cpf');

	delete Validation.methods['validar_cnpj'];
	delete Validation.methods['validar_cpf'];

	var numero = pCampo.value.replace(/\D+/g, '');

	if (validarCnpj(numero))
	{
		pCampo.value = numero.substring(0,2) + '.' + numero.substring(2,5) + '.' + numero.substring(5,8) + '/' + numero.substring(8,12) + '-' + numero.substring(12,14);

		Validation.add('validar_cnpj', 'CNPJ incorreto.', function(pValor){return validarCnpj(pValor,0);});
		pCampo.addClassName('validar_cnpj')
	}
	else
	{
		if (validarCpf(numero))
		{
			pCampo.value = numero.substring(0,3) + '.' + numero.substring(3,6) + '.' + numero.substring(6,9) + '-' + numero.substring(9,11);
		}

		Validation.add('validar_cpf', 'CPF incorreto.', function(pValor){return validarCpf(pValor,0);});
		pCampo.addClassName('validar_cpf');
	}
};

function calcularModulo11(pNumero, pBase = 9)
{
	var baseInicial = 2;
	var baseAtual = 2;
	var numeroInvertido = pNumero.split('').reverse().join('');
	var soma = 0;

	for (it = 0; it < numeroInvertido.length; ++it)
	{
		soma += parseInt(numeroInvertido.substring(it, it + 1)) * baseAtual;
		++baseAtual;

		if (baseAtual > pBase)
		{
			baseAtual = baseInicial;
		}
	}

	var resto = soma % 11;

	if (resto < 2)
	{
		return 0;
	}
	else
	{
		return (11 - resto);
	}
};

function validarCnpj(pCnpj)
{
	var numero = pCnpj.replace(/\D+/g, '');
	if (!numero.match(/^\d{14}$/))
	{
		return false;
	}

	switch (numero)
	{
		case '00000000000000':
		case '11111111111111':
		case '22222222222222':
		case '33333333333333':
		case '44444444444444':
		case '55555555555555':
		case '66666666666666':
		case '77777777777777':
		case '88888888888888':
		case '99999999999999':
			return false;
	}

	var dv1 = calcularModulo11(numero.substring(0,12), 9).toString();
	var dv2 = calcularModulo11(numero.substring(0,12) + dv1, 9).toString();

	return (dv1 + dv2 == numero.substring(12,14));
};

function validarCpf(pCpf)
{
	var numero = pCpf.replace(/\D+/g, '');
	if (!numero.match(/^\d{11}$/))
	{
		return false;
	}

	switch (numero)
	{
		case '00000000000':
		case '11111111111':
		case '22222222222':
		case '33333333333':
		case '44444444444':
		case '55555555555':
		case '66666666666':
		case '77777777777':
		case '88888888888':
		case '99999999999':
			return false;
	}

	var dv1 = calcularModulo11(numero.substring(0,9), 10).toString();
	var dv2 = calcularModulo11(numero.substring(0,9) + dv1, 11).toString();

	return (dv1 + dv2 == numero.substring(9,11));
};
