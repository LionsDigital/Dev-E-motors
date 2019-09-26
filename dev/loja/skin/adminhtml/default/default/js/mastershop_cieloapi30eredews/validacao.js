//Estender a função de validação, para não validar elementos invisíveis
//relacionados aos campos de cartões
Validation.isVisible = Validation.isVisible.wrap(
	function (pFuncaoOriginal, pElemento)
	{
		if (pElemento.id.indexOf('mastershopcieloapi30eredews') !== -1)
		{
			var qtdSelecionada = $$('input:checked[type=radio][name="payment[cc_qtd]"]')[0];
			if (typeof(qtdSelecionada) == 'undefined')
			{
				return false;
			}

			qtdSelecionada = qtdSelecionada.value;

			var partesNome = pElemento.id.split('_');
			return parseInt(partesNome[2]) <= qtdSelecionada;
		}
		else
		{
			return pFuncaoOriginal(pElemento);
		}
	}
);

//Estender a função de atualização de formas de pagamento
//Atualizar os totais ao selecionar parcelas com desconto/juros ou mudar a forma de pagamento
AdminOrder.prototype.changePaymentData = AdminOrder.prototype.changePaymentData.wrap(
	function (pFuncaoOriginal, pEvento)
	{
		var elemento = Event.element(pEvento);

		if (elemento.method == 'mastershopcieloapi30eredews')
		{
			this.loadArea(['totals'], true, this.getPaymentData(elemento.method));
		}
		else
		{
			pFuncaoOriginal(pEvento);
		}
	}
);

AdminOrder.prototype.switchPaymentMethod = AdminOrder.prototype.switchPaymentMethod.wrap(
	function (pFuncaoOriginal, pMetodo)
	{
		pFuncaoOriginal(pMetodo);
		this.loadArea(['totals'], true);
	}
);