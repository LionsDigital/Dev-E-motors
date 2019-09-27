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

//Sobrescrever função da função padrão de revisão da compra
//para limpar dados dos formulários de cartões quando houver erro
if (typeof(Review) != 'undefined')
{
	Review.prototype.nextStep = Review.prototype.nextStep.wrap(
		function (pFuncaoOriginal, pTransporte)
		{
			if (pTransporte)
			{
				var resposta = pTransporte.responseJSON || pTransporte.responseText.evalJSON(true) || {};
				if (!resposta.success)
				{
					//Limpar campos
					$$('input[id^=mastershopcieloapi30_cc_]', 'select[id^=mastershopcieloapi30_cc_]').each(
						function (elemento)
						{
							if (elemento.tagName.toLowerCase() == 'select')
							{
								elemento.options[0].selected = true;
							}
							else
							{
								if (elemento.type.toLowerCase() == 'radio')
								{
									if (elemento.id.indexOf('_qtd_') == -1)
									{
										elemento.checked = false;
									}
								}
								else
								{
									elemento.value = '';
								}
							}
						}
					);

					//Reinicializar formulário
					mastershop_cieloapi30_atualizarBandeirasImagens();
					mastershop_cieloapi30_inicializarCampos();

					//Mudar para seção de pagamento
					if (typeof(checkout) != 'undefined')
					{
						checkout.changeSection('opc-payment');
					}
				}

				return pFuncaoOriginal(pTransporte);
			}
		}
	);
}

//Se a variável de revisão já tiver sido inicializada, sobrescrever o observador
(
	function()
	{
		if (typeof(review) != 'undefined')
		{
			review.onSave = Review.prototype.nextStep.bindAsEventListener(review);
		}
	}
)();