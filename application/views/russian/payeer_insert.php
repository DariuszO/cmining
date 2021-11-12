<?php
$m_shop = $this->config->item('UidPayeerMerchant'); // id мерчанта
$m_orderid = $LID; // номер счета в системе учета мерчанта
$m_amount = number_format($Amount, 2, '.', ''); // сумма счета с двумя знаками после точки
$m_curr = 'USD'; // валюта счета
$m_desc = base64_encode('Balance for ' . $this->session->Login); // описание счета, закодированное с помощью алгоритма base64
$m_key = $this->config->item('SecretKeyPayeerMerchant');
// Формируем массив для генерации подписи
$arHash = array(
	$m_shop,
	$m_orderid,
	$m_amount,
	$m_curr,
	$m_desc,
	$m_key
);
//$arHash[] = $m_key;
$sign = strtoupper(hash('sha256', implode(':', $arHash)));
?>
<script src="https://code.jquery.com/jquery-latest.min.js"></script>

<form method="post" method="GET" id="formPayeer" action="https://payeer.com/merchant/">
<input type="hidden" name="m_shop" value="<?=$m_shop?>">
<input type="hidden" name="m_orderid" value="<?=$m_orderid?>">
<input type="hidden" name="m_amount" value="<?=$m_amount?>">
<input type="hidden" name="m_curr" value="<?=$m_curr?>">
<input type="hidden" name="m_desc" value="<?=$m_desc?>">
<input type="hidden" name="m_sign" value="<?=$sign?>">
<input type="submit" name="m_process" style="display: none;" value="send" />
</form>

<script>
	document.getElementById("formPayeer").submit();
</script>