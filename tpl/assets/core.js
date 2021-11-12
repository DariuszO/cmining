function ViewHistoryRef(ref)
{
	$("#myModalBox").modal('show');
	$("#loadersref").html('<img src="/tpl/img/loading.gif">');
	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: "ref=" + ref,
		url: "/Dashboard/LoadInfoPartner",
		success: function(data)
		{
			$("#loadersref").html('');
			if(data.error == 'no')
			{
				$("#loadDataParter").html(data.text);
			}
			else
			{
				$("#loadDataParter").html(data.text);
			}
			
		}
	})
}

function withdrawal(num)
{
	$("#btns_"+num).hide();
	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: jQuery("#idCoin_" + num).serialize(),
		url: "/Dashboard/Withdraw",
		success: function(data)
		{
			if(data.error == 'no')
			{
				$("#info_withdraw_"+num).html("<div class='alert alert-success'>"+data.text+"</div>");
				setTimeout(function (){
					$("#info_withdraw_"+num).html('');
					$("#btns_"+num).show();
				}, 3000);
			}
			else
			{
				$("#info_withdraw_"+num).html("<div class='alert alert-danger'>"+data.text+"</div>");
				setTimeout(function (){
					$("#info_withdraw_"+num).html('');
					$("#btns_"+num).show();
				}, 3000);
			}
		}
	})
}


function step1()
{
	var CoinUidOne = $("#step1 :selected").attr("dat");
	
	$("#imgCoin_1").html('<img style="width: 70px;" src="https://www.coinpayments.net/images/coins/'+CoinUidOne+'.png" alt="...">');
	$("#imgCoin_2").html('');
	$("#amount1").val('0');
	$("#amount2").val('0');
	$.ajax({
		type:"POST",
		dataType:"JSON",
		data: "ExchStepOne="+CoinUidOne,
		url: "/Dashboard/Exchange",
		success: function(data){
			if(data.error == 'no')
			{
				$("#step2").html(data.text);
			}
			else
			{
				$("#errorExhange").html('<div class="alert alert-danger">'+data.text+'</div>');
				setTimeout(function (){
					$("#errorExhange").html('')
				}, 3000);
				
			}
		}
	})
	
}


function step2()
{
	var CoinUidTwo = $("#step2 :selected").attr("dat");
	var CoinUidOne = $("#step1 :selected").attr("dat");
	if(CoinUidTwo == 'GHS')
	{
		$("#imgCoin_2").html('<img style="width: 70px;" src="/tpl/img/GHS.png" alt="...">');
	}
	else
	{
		$("#imgCoin_2").html('<img style="width: 70px;" src="https://www.coinpayments.net/images/coins/'+CoinUidTwo+'.png" alt="...">');
	}
	
	$("#step3").show();
	$("#coin_1").html('<b>' + CoinUidOne + '</b>');
	$("#coin_2").html('<b>' + CoinUidTwo + '</b>');
}



	$('#amount1').on('input', function () {
	var amount1 = $("#amount1").val();
	var CoinUidTwo = $("#step2 :selected").attr("dat");
	var CoinUidOne = $("#step1 :selected").attr("dat");
	
	$.ajax({
		type:"POST",
		dataType:"JSON",
		data: "Calc=1&Coin1="+CoinUidOne+"&Coin2="+CoinUidTwo+"&Amount="+amount1,
		url: "/Dashboard/Exchange",
		success: function(data){
			if(data.error == 'no')
			{
				$("#amount2").val(data.text);
			}
			else
			{
				$("#errorExhange").html('<div class="alert alert-danger">'+data.text+'</div>');
				setTimeout(function (){
					$("#errorExhange").html('')
				}, 3000);
			}
		}
	})
	
	

	});



function ExchangeComplite()
{
	var NameCoin_1 = $("#step1 :selected").attr("dat");
	var NameCoin_2 = $("#step2 :selected").attr("dat");
	var AmountCoin_1 = $("#amount1").val();
	
	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: "Coin_1="+NameCoin_1+"&Coin_2="+NameCoin_2+"&AmountCoin_1="+AmountCoin_1+"&ExchangeComplite=true",
		url: "/Dashboard/Exchange",
		success: function(data)
		{
			if(data.error == 'no')
			{
				$("#errorExhange").html('<div class="alert alert-success">'+data.text+'</div>');
				setTimeout(function (){
					$("#errorExhange").html('')
				}, 10000);
			}
			else
			{
				$("#errorExhange").html('<div class="alert alert-danger">'+data.text+'</div>');
				setTimeout(function (){
					$("#errorExhange").html('')
				}, 10000);
			}
		}
	})
	
}


function ResetOnlineOfflineCoin(num)
{
	$.ajax({
        type:"POST",
        dataType: 'JSON',
        data: "coinSet="+num,
        url:"/Dashboard/UserCoins",
        success: function (data) {
        	if(data.error == 'no')
        	{
				
					$('#coin_'+data.Uid).removeClass('offline').addClass('online');
					$('#statusCoin_'+data.Uid).removeClass('offline').addClass('online');
					$('#statusCoin_'+data.Uid).text('Online');
					$('#ButtonCoin_'+data.Uid).hide();
					$('#ButtonCoins_'+data.Uid).html('Включено');

				
			}
			else if(data.error == 'yes')
			{
				alert('Произошла ошибка!!! Обновите страницу и попробуйте еще раз!');
			}
            
        }
    })
}


function Deposit(num)
{
	$("#btnCoin_"+num).hide();
	$("#result_"+num).html('<img src="/tpl/img/loading.gif">');
	$.ajax({
		type: "POST",
		dataType:"JSON",
		data: jQuery("#idCoin_" + num).serialize(),
		url: "/Dashboard/Deposit",
		success: function(data)
				{
					$("#result_"+num).html('');
						if(data.status == 'error')
						{
							$("#btnCoin_"+num).show();
							$("#result_"+num).html('<div class="alert alert-danger">'+data.text+'</div>');
						}
						else
						{
							$("#btnCoin_"+num).hide();
							$("#result_"+num).html('<div class="alert alert-success">'+data.text+'</div>');
						}
				}
	})
}



$(document).ready(function () {
    var select = $('#Miner').val();
    var renderPrice, renderCount, RenderSum,renderSpeed

    renderPrice = $("#"+select+"").find('#Price');
    renderSpeed = $('#Speed').val();
    renderCount = $("#"+select+"").find('#Balance');
	test = $("#"+select+"").find('#OldBalance');
    RenderSum = $("#"+select+"").find('#Cash');

    
    if(select) {
        
        setInterval(function () {
            
			if(select == 'ghs')
			{
				test.val(parseFloat(renderSpeed) + parseFloat(test.val()))
                renderCount.text(parseFloat(test.val()).toFixed(8))
                RenderSum.text(parseFloat(parseFloat(renderCount.text()) * parseFloat(renderPrice.text())).toFixed(8))
			}
			else
			{
				test.val(parseFloat(renderSpeed) + parseFloat(test.val()))
                renderCount.text(parseFloat(test.val()).toFixed(8))
                RenderSum.text(parseFloat(parseFloat(renderCount.text()) * parseFloat(renderPrice.text())).toFixed(8))
			}

        } , 1000)
    }  
});


function SetMine(num)
{
	$.ajax({
        type:"POST",
        dataType: 'JSON',
        data: "id="+num,
        url:"/Dashboard/SetMiner",
        success: function (data) {
        	if(data.status == 'OK')
        	{
				location.reload()
			}
			else
			{
				alert('ОШИБКА!!!');
			}
            
        }
    })
}