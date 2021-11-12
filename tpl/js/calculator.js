function calculator() { 
	var plan = $("#percent").val();
	var deposit = $("#deposit").val();
	var percent = [[152.5], [210], [225], [560], [2000], [400], [1000]];
	var minMoney = [10, 1001, 2000, 1000, 200, 40000, 3000];
	var maxMoney = [250, 3000, 45000, 40000, 20000, 45000, 25000];
	var totalPercent;
	if (plan == "plan_1") {
		if (deposit < minMoney[0]) {
			$("#deposit").val(minMoney[0]);
			deposit = minMoney[0];
		}
		if (deposit > maxMoney[0]) {
			$("#deposit").val(maxMoney[0]);
			deposit = maxMoney[0];
		}
		totalPercent = percent[0][0];
		$("#roi").html((percent[0][0]).toFixed(2));
		$("#profit").html(((totalPercent / 100) * deposit).toFixed(2));
	};
	if (plan == "plan_2") {
		if (deposit < minMoney[1]) {
			$("#deposit").val(minMoney[1]);
			deposit = minMoney[1];
		}
		if (deposit > maxMoney[1]) {
			$("#deposit").val(maxMoney[1]);
			deposit = maxMoney[1];
		}
		totalPercent = percent[1][0];
		$("#roi").html((percent[1][0]).toFixed(2));
		$("#profit").html(((totalPercent / 100) * deposit).toFixed(2));
	};
	if (plan == "plan_3") {
		if (deposit < minMoney[2]) {
			$("#deposit").val(minMoney[2]);
			deposit = minMoney[2];
		}
		if (deposit > maxMoney[2]) {
			$("#deposit").val(maxMoney[2]);
			deposit = maxMoney[2];
		}
		totalPercent = percent[2][0];
		$("#roi").html((percent[2][0]).toFixed(2));
		$("#profit").html(((totalPercent / 100) * deposit).toFixed(2));
	};
	if (plan == "plan_4") {
		if (deposit < minMoney[3]) {
			$("#deposit").val(minMoney[3]);
			deposit = minMoney[3];
		}
		if (deposit > maxMoney[3]) {
			$("#deposit").val(maxMoney[3]);
			deposit = maxMoney[3];
		}
		totalPercent = percent[3][0];
		$("#roi").html((percent[3][0]).toFixed(2));
		$("#profit").html(((totalPercent / 100) * deposit).toFixed(2));
	};
	if (plan == "plan_5") {
		if (deposit < minMoney[4]) {
			$("#deposit").val(minMoney[4]);
			deposit = minMoney[4];
		}
		if (deposit > maxMoney[4]) {
			$("#deposit").val(maxMoney[4]);
			deposit = maxMoney[4];
		}
		totalPercent = percent[4][0];
		$("#roi").html((percent[4][0]).toFixed(2));
		$("#profit").html(((totalPercent / 100) * deposit).toFixed(2));
	};
	if (plan == "plan_6") {
		if (deposit < minMoney[5]) {
			$("#deposit").val(minMoney[5]);
			deposit = minMoney[5];
		}
		if (deposit > maxMoney[5]) {
			$("#deposit").val(maxMoney[5]);
			deposit = maxMoney[5];
		}
		totalPercent = percent[5][0];
		$("#roi").html((percent[5][0]).toFixed(2));
		$("#profit").html(((totalPercent / 100) * deposit).toFixed(2));
	};
	if (plan == "plan_7") {
		if (deposit < minMoney[6]) {
			$("#deposit").val(minMoney[6]);
			deposit = minMoney[6];
		}
		if (deposit > maxMoney[6]) {
			$("#deposit").val(maxMoney[6]);
			deposit = maxMoney[6];
		}
		totalPercent = percent[6][0];
		$("#roi").html((percent[6][0]).toFixed(2));
		$("#profit").html(((totalPercent / 100) * deposit).toFixed(2));
	};
	if (plan == "plan_8") {
		if (deposit < minMoney[7]) {
			$("#deposit").val(minMoney[7]);
			deposit = minMoney[7];
		}
		if (deposit > maxMoney[7]) {
			$("#deposit").val(maxMoney[7]);
			deposit = maxMoney[7];
		}
		totalPercent = percent[7][0];
		$("#roi").html((percent[7][0]).toFixed(2));
		$("#profit").html(((totalPercent / 100) * deposit).toFixed(2));
	};
}

(function($) {
	$(document).ready(function() {
		calculator();
		$("#percent").change(function(){
			var plan = $("#percent").val();
			var minMoney = [10, 1001, 2000, 1000, 200, 40000, 3000];
			if (plan == "plan_1") { $("#deposit").val(minMoney[0]); };
			if (plan == "plan_2") { $("#deposit").val(minMoney[1]); };
			if (plan == "plan_3") { $("#deposit").val(minMoney[2]); };
			if (plan == "plan_4") { $("#deposit").val(minMoney[3]); };
			if (plan == "plan_5") { $("#deposit").val(minMoney[4]); };
			if (plan == "plan_6") { $("#deposit").val(minMoney[5]); };
			if (plan == "plan_7") { $("#deposit").val(minMoney[6]);	};
			calculator();
		});
	});
} )( jQuery );