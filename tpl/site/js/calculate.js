function SelectCoin()
{
	var Coin = $("#SelectCoin :selected").val();
	var Price = $("#SelectCoin :selected").attr('price'); //Стоимость в биткоинах
	
	
	$("#coinName").text(Coin);
	$("#qqq").text(Coin);
	$("#CountCloud").val('100');
	var CountCloud = $("#CountCloud").val();
	var CountCloud = $("#CountCloud").val();
	var AmountBtc = (CountCloud * PriceCloud);
	$("#CountCryptoBtc").val(parseFloat(AmountBtc).toFixed(8));
	var CountCrypto = AmountBtc / $("#SelectCoin :selected").attr('price');
	$("#CountCrypto").val(parseFloat(CountCrypto).toFixed(8));
	
	
	ChangeCalc(CountCloud, CountCrypto);

}

$(document).ready(function () {
	$('#CountCloud').on('input', function () {
		
		var CountCloud = $("#CountCloud").val();
		var AmountBtc = (CountCloud * PriceCloud);
		$("#CountCryptoBtc").val(parseFloat(AmountBtc).toFixed(8));
		var CountCrypto = AmountBtc / $("#SelectCoin :selected").attr('price');
		//alert(CountCrypto);
		$("#CountCrypto").val(parseFloat(CountCrypto).toFixed(8));
	
		ChangeCalc(CountCloud, CountCrypto);
	});
	
	$('#CountCrypto').on('input', function () {
		var CountCrypto = $("#CountCrypto").val();
		var PriceBtc = $("#SelectCoin :selected").attr('price');
		
		var CountCloud = (CountCrypto * PriceBtc) / PriceCloud;
		
		$("#CountCloud").val(parseFloat(CountCloud).toFixed(2));
		
		
		
		var AmountBtc = (CountCloud * PriceCloud);
		$("#CountCryptoBtc").val(parseFloat(AmountBtc).toFixed(8));
		var CountCrypto = AmountBtc / $("#SelectCoin :selected").attr('price');
		
		
		ChangeCalc(CountCloud, CountCrypto);
	});
	
	
	
});



$(document).ready(function () {
	$("#CountCloud").val('100');
	var CountCloud = $("#CountCloud").val();
	var AmountBtc = (CountCloud * PriceCloud);
	$("#CountCryptoBtc").val(parseFloat(AmountBtc).toFixed(8));
	var CountCrypto = AmountBtc / $("#SelectCoin :selected").attr('price');
	$("#CountCrypto").val(parseFloat(CountCrypto).toFixed(8));
	ChangeCalc(100, CountCrypto);
});



function ChangeCalc(AmountGhs, CountCrypto)
{
	
	$("#HourCoin").html(parseFloat(((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * 3600).toFixed(8));
	$("#HourBtc").html(parseFloat((((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * 3600) * $("#SelectCoin :selected").attr('price')).toFixed(8));
	$("#HourPerc").html(parseFloat((((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * 3600) / CountCrypto * 100).toFixed(4));
	
	$("#DayCoin").html(parseFloat(((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * 86400).toFixed(8));
	$("#DayBtc").html(parseFloat((((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * 86400) * $("#SelectCoin :selected").attr('price')).toFixed(8));
	$("#DayPerc").html(parseFloat((((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * 86400) / CountCrypto * 100).toFixed(4));
	
	$("#WeekCoin").html(parseFloat(((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * (86400 * 7)).toFixed(8));
	$("#WeekBtc").html(parseFloat((((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * (86400 * 7)) * $("#SelectCoin :selected").attr('price')).toFixed(8));
	$("#WeekPerc").html(parseFloat((((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * (86400 * 7)) / CountCrypto * 100).toFixed(4));
	
	
	$("#MothCoin").html(parseFloat(((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * (86400 * 30)).toFixed(8));
	$("#MothBtc").html(parseFloat((((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * (86400 * 30)) * $("#SelectCoin :selected").attr('price')).toFixed(8));
	$("#MothPerc").html(parseFloat((((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * (86400 * 30)) / CountCrypto * 100).toFixed(4));
	
	
	$("#Moth3Coin").html(parseFloat(((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * (86400 * 30 * 3)).toFixed(8));
	$("#Moth3Btc").html(parseFloat((((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * (86400 * 30 * 3)) * $("#SelectCoin :selected").attr('price')).toFixed(8));
	$("#Moth3Perc").html(parseFloat((((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * (86400 * 30 * 3)) / CountCrypto * 100).toFixed(4));
	
	
	$("#YearCoin").html(parseFloat(((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * (86400 * 365)).toFixed(8));
	$("#YearBtc").html(parseFloat((((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * (86400 * 365)) * $("#SelectCoin :selected").attr('price')).toFixed(8));
	$("#YearPerc").html(parseFloat((((PriceCloud * AmountGhs) / (60 * 60 * 24 * Oksup) / $("#SelectCoin :selected").attr('price')) * (86400 * 365)) / CountCrypto * 100).toFixed(4));
}