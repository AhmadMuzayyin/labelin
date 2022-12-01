window.onbeforeunload = function () {
	return "";
}

function range(awal, akhir) {
  	return Array(akhir - awal + 1).fill().map((_, idx) => awal + idx);
}

function getfilledEachColumn(ts,s,e) {
	var st = Array.from({length:30}, (v, i) => i * 50); //mulai dari 0, untuk index naekin 1
	var en = Array.from({length:30}, (v, i) => i * 50 + 50); //mulai dari 0, untuk index naekin 1

	for (var i = s; i < e; i++) {
		fetchnilaieachcolumn(ts,st[i],en[i]);		
	}
}

function detectClassRunningOut() {
	if ($('#countdownkolom').hasClass('runningout')) {
		$('#countdownkolom').removeClass('runningout');
	}
}

$(".switchnya").click(function(){
	const Toast = Swal.mixin({
	  toast: true,
	  position: 'top-start',
	  showConfirmButton: false,
	  timer: 3000,
	  timerProgressBar: true,
	  didOpen: (toast) => {
	    toast.addEventListener('mouseenter', Swal.stopTimer)
	    toast.addEventListener('mouseleave', Swal.resumeTimer)
	  }
	})
	if (this.checked) {
		$("body").addClass("dark");
		console.log("Nyala");

		Toast.fire({
		  type: 'success',
		  title: 'Mode Gelap Aktif'
		});
	} else {
		$("body").removeClass("dark");
		console.log("Mati");
		Toast.fire({
		  type: 'error',
		  title: 'Mode Gelap Tidak Aktif'
		});
	}
});

$("#logoutlink").click(function(e){
	e.preventDefault(); // <--- prevent form from submitting
	Swal.fire({
	  title: 'Yakin ingin Logout?',
	  text: "Anda dapat mengulang test ini nanti dan mulai dari awal.",
	  type: "question",
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Ya'
	}).then((result) => {
	  if (result.value) {
	  	var tbiduser = $('#tbiduser').val();
		var tbusername = $('#tbusername').val();
      	var tbstatus = 'BM'; //Tidak Mengerjaaakan
        $.ajax({
            type : "POST",
            url  : baseUrl + "/peserta/Peserta_Controller/update_status",
            dataType : "JSON",
            data : {tbiduser:tbiduser,tbusername:tbusername,tbstatus:tbstatus},
            success: function(data){
            }
        });
        window.location.href = baseUrl + "Verification/logoutkeun";//--- submit for prmogrammatically
        Swal.fire({
		  title: 'Mohon Tunggu',
		  html: 'Logout sukses, harap tunggu.',
		  type: 'success',
		  timer: 50000,
		  timerProgressBar: true,
		  allowOutsideClick: false,
		  didOpen: () => {
		    Swal.showLoading()
		    timerInterval = setInterval(() => {
		  	    
		    }, 1000)
		  },
		  willClose: () => {
		    clearInterval(timerInterval)
		  }
		});		    
	  }
	})
});

$("#logoutlinkoke").click(function(e){
	var tbiduser = $('#tbiduser').val();
	var tbusername = $('#tbusername').val();
	e.preventDefault(); // <--- prevent form from submitting
	Swal.fire({
	  title: 'Yakin ingin Logout?',
	  text: "Silahkan logout jika sudah selesai.",
	  type: "question",
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Ya'
	}).then((result) => {
	  if (result.value) {
	  	var tbiduser = $('#tbiduser').val();
		var tbusername = $('#tbusername').val();
      	var tbstatus = 'DONE'; //Selesai Mengerjaaakan
        $.ajax({
            type : "POST",
            url  : baseUrl + "/peserta/Peserta_Controller/update_status",
            dataType : "JSON",
            data : {tbiduser:tbiduser,tbusername:tbusername,tbstatus:tbstatus},
            success: function(data){
            }
        });
	  	Swal.fire('Logout Sukses','Test diakhiri, silahkan klik OK','success').then(function() {
          window.location.href = baseUrl + "Verification/logoutkeun";//--- submit for prmogrammatically
        });
	    
	  }
	})
});


var barisny = range(1, 1500); // array sampe 1500 (untuk baris jawaban list)
var index = -1; //baris
var max = $(barisny).length;

var status = 'Mengerjakan';
var jenissoal = 'S0JL'; //INITIALIZE JENIS SOAL ANGKA
var soalke = '1';

var interval;

var columnsoalcheckpoint = Array.from({length:31}, (v, i) => i * 50); //mulai dari 0, untuk index naekin 1
$(document).ready(function(){
	$('#startbuttontest').click(function(){
		$('.soaltest').attr('hidden','true');
		$('.barisss').attr('hidden','true');
		$('.barispilihan').attr('hidden','true');
		$('#scorechartgraph').css("display","none");
		if (jenissoal == 'S0JL') {
			var tbiduser = $('#tbiduser').val();
        	var tbusername = $('#tbusername').val();
        	$(document).attr("title", "Soal Angka");
        	var tbstatus = 'SM'; //seddang mengerjakkan
			$('#jenissoalnya').text('Soal Angka - Kolom 1');
			$('.soalke1').removeAttr('hidden');
			$('.listsoalke1').removeAttr('hidden');
			$('.gambarpetunjuk').css('display','none');
			$('#countdownkolom').css('display','unset');
            $.ajax({
                type : "POST",
                url  : baseUrl +"/peserta/Peserta_Controller/update_status",
                dataType : "JSON",
                data : {tbiduser:tbiduser,tbusername:tbusername,tbstatus:tbstatus},
                success: function(data){
                	
                }
            });
            index++;
		}

		if(jenissoal == 'S1JL') {
			$('#jenissoalnya').text('Soal Huruf - Kolom 1');
			$('.soalke11').removeAttr('hidden');
			$('.listsoalke501').removeAttr('hidden');
			$('#countdownkolom').css('display','unset');
			$(document).attr("title", "Soal Huruf");
		}

		if (jenissoal == 'S2JL') {
			$('#jenissoalnya').text('Soal Simbol - Kolom 1');
			$('.soalke21').removeAttr('hidden');
			$('.listsoalke1001').removeAttr('hidden');
			$('#countdownkolom').css('display','unset');
			$(document).attr("title", "Soal Simbol");
		}
		
		$('.tabelsoal').removeAttr('hidden');
		$('.brieftext').css('display','none');
		$(this).css('display','none');

		$('.barisnya' + barisny[index]).removeAttr('hidden');
		$('#judulcard').text('Soal '+ barisny[index]);
		$( "#countdownkolom" ).removeClass("break");
		status = 'Mengerjakan';
		runTimer();
		$('#scoreresultLeft').css('display','none');
		$('#scoreresultRight').css('display','none');
	});



	$('#menjelangendbutton').click(function(){
		forceHide();
		$('#loader').css('display','none');
		var tbnilai1 = $('#tbnilaiS0JL').val();
        var tbnilai2 = $('#tbnilaiS1JL').val();
        var tbnilai3 = $('#tbnilaiS2JL').val();
        var tbnilaiS0JLcorrect = $('#tbS0JLcorrect').val();
        var tbnilaiS0JLwrong = $('#tbS0JLwrong').val();
        var tbnilaiS0JLanswered = $('#tbS0JLanswered').val();
        var tbnilaiS0JLnotanswered = $('#tbS0JLnotanswered').val();
        var tbnilaiS1JLcorrect = $('#tbS1JLcorrect').val();
        var tbnilaiS1JLwrong = $('#tbS1JLwrong').val();
        var tbnilaiS1JLanswered = $('#tbS1JLanswered').val();
        var tbnilaiS1JLnotanswered = $('#tbS1JLnotanswered').val();
        var tbnilaiS2JLcorrect = $('#tbS2JLcorrect').val();
        var tbnilaiS2JLwrong = $('#tbS2JLwrong').val();
        var tbnilaiS2JLanswered = $('#tbS2JLanswered').val();
        var tbnilaiS2JLnotanswered = $('#tbS2JLnotanswered').val();
        var tbperformances0jl = $('#tbperformanceS0JL').val();
        var tbperformances1jl = $('#tbperformanceS1JL').val();
        var tbperformances2jl = $('#tbperformanceS2JL').val();
        var tbiduser = $('#tbiduser').val();
        var tbusername = $('#tbusername').val();
        $.ajax({
            type : "POST",
            url  : baseUrl + "peserta/Peserta_Controller/simpan_nilai",
            dataType: "JSON",
            data : {tbnilai1:tbnilai1 , tbnilai2:tbnilai2, tbnilai3:tbnilai3, tbnilaiS0JLcorrect:tbnilaiS0JLcorrect, tbnilaiS0JLwrong:tbnilaiS0JLwrong, tbnilaiS0JLanswered:tbnilaiS0JLanswered, tbnilaiS0JLnotanswered:tbnilaiS0JLnotanswered,tbnilaiS1JLcorrect:tbnilaiS1JLcorrect, tbnilaiS1JLwrong:tbnilaiS1JLwrong, tbnilaiS1JLanswered:tbnilaiS1JLanswered, tbnilaiS1JLnotanswered:tbnilaiS1JLnotanswered, tbnilaiS2JLcorrect:tbnilaiS2JLcorrect, tbnilaiS2JLwrong:tbnilaiS2JLwrong, tbnilaiS2JLanswered:tbnilaiS2JLanswered, tbnilaiS2JLnotanswered:tbnilaiS2JLnotanswered, tbperformances0jl:tbperformances0jl, tbperformances1jl:tbperformances1jl,tbperformances2jl:tbperformances2jl, tbiduser:tbiduser,tbusername:tbusername},
            success: function(data){
            }
        });
        var tbstatus = 'DONE'; //Selesai Mengerjaaakan
        $.ajax({
            type : "POST",
            url  : baseUrl + "peserta/Peserta_Controller/update_status",
            dataType : "JSON",
            data : {tbiduser:tbiduser,tbusername:tbusername,tbstatus:tbstatus},
            success: function(data){
            }
        });
        $('#scorechartgraph').css("display","none");
        $("#logoutlink").css("display", "none");
        $("#logoutlinkoke").css("display", "unset");
        $(document).attr("title", "Test Selesai");
        $('#scoreresultLeft').css('display','none');
		$('#scoreresultRight').css('display','none');
        $('#judulcard').text('Test Telah Selesai');
		$('#jenissoalnya').text('Anda bisa logout sekarang');
		$('.brieftext').css('display','block');
		$('.brieftext').text('Anda Bisa Logout sekarang dengan mengklik ikon di pojok kanan atas.');
		$(this).css('display','none');

	});
});

var nilaiArrayS0JLcorrect = [];
var nilaiArrayS1JLcorrect = [];
var nilaiArrayS2JLcorrect = [];
var nilaiArrayS0JLcorrectmultiply = [];
var nilaiArrayS1JLcorrectmultiply = [];
var nilaiArrayS2JLcorrectmultiply = [];
var nilaiArrayS0JLwrong = [];
var nilaiArrayS1JLwrong = [];
var nilaiArrayS2JLwrong = [];
var countArrayS0JLanswered = [];
var countArrayS1JLanswered = [];
var countArrayS2JLanswered = [];
var countArrayS0JLnotanswered = [];
var countArrayS1JLnotanswered = [];
var countArrayS2JLnotanswered = [];
var performancescoreS0JL = [];
var performancescoreS1JL = [];
var performancescoreS2JL = [];

function fetchnilaieachcolumn(js,start,end) {
	var datasoal = Array();
	var datajawaban = Array();
	var x = start;
	var e = end;
	var xpure = 0;
	var epure = 50;
	let correctscorepercolumn = 0;
	let correctscoremultiplypersoaltotal = 0;
	let wrongscorepercolumn = 0;
	let answeredcorepercolumn = 0;
	let notansweredcorepercolumn = 0;
	var jenissoal = js;
	$('table.tabledijawab > tbody > tr').slice(x,e).each(function(o){
	    tds0 = $(this).find('td');
		datajawaban[o] = $(tds0[0]).text();
	});

	//collect data soal
	$("table.soalny > tbody > tr.barisss").slice(x,e).each(function(i, v){
	  datasoal[i] = Array();
	  	$(this).children('td').each(function(ii, vv){
	    	datasoal[i][ii] = $(this).text();
	  	}); 
	});

	
	do {
		//make sure the jawaban we got ada pada salah satu index array yang mana berisi 4 value (im make it comparison or 'make sure it was included')
		if(datajawaban[xpure]){ //pastikan value ada
			answeredcorepercolumn++;
	        if(!datasoal[xpure].includes(datajawaban[xpure])){ //adding not includes operand
				correctscorepercolumn++;
				correctscoremultiplypersoaltotal+=2;
			}
			if(datasoal[xpure].includes(datajawaban[xpure])){ //adding not includes operand
				wrongscorepercolumn++;
			}
	    }
	    if (!datajawaban[xpure]){
	    	notansweredcorepercolumn++;
	    }
	    xpure++;
	}
	while(xpure < epure);


	if (jenissoal == "S0JL") {
		nilaiArrayS0JLcorrect.push(correctscorepercolumn);
		nilaiArrayS0JLwrong.push(wrongscorepercolumn);
		countArrayS0JLnotanswered.push(notansweredcorepercolumn);
		countArrayS0JLanswered.push(answeredcorepercolumn);
		nilaiArrayS0JLcorrectmultiply.push(correctscoremultiplypersoaltotal);
		$("#tbS0JLcorrect").val(nilaiArrayS0JLcorrect);
		$("#tbS0JLwrong").val(nilaiArrayS0JLwrong);
		$("#tbS0JLanswered").val(countArrayS0JLanswered);
		$("#tbS0JLnotanswered").val(countArrayS0JLnotanswered);
	} else if (jenissoal == "S1JL") {
		nilaiArrayS1JLcorrect.push(correctscorepercolumn);
		nilaiArrayS1JLwrong.push(wrongscorepercolumn);
		countArrayS1JLnotanswered.push(notansweredcorepercolumn);
		countArrayS1JLanswered.push(answeredcorepercolumn);
		nilaiArrayS1JLcorrectmultiply.push(correctscoremultiplypersoaltotal);
		$("#tbS1JLcorrect").val(nilaiArrayS1JLcorrect);
		$("#tbS1JLwrong").val(nilaiArrayS1JLwrong);
		$("#tbS1JLanswered").val(countArrayS1JLanswered);
		$("#tbS1JLnotanswered").val(countArrayS1JLnotanswered);
	} else {
		nilaiArrayS2JLcorrect.push(correctscorepercolumn);
		nilaiArrayS2JLwrong.push(wrongscorepercolumn);
		countArrayS2JLnotanswered.push(notansweredcorepercolumn);
		countArrayS2JLanswered.push(answeredcorepercolumn);
		nilaiArrayS2JLcorrectmultiply.push(correctscoremultiplypersoaltotal);
		$("#tbS2JLcorrect").val(nilaiArrayS2JLcorrect);
		$("#tbS2JLwrong").val(nilaiArrayS2JLwrong);
		$("#tbS2JLanswered").val(countArrayS2JLanswered);
		$("#tbS2JLnotanswered").val(countArrayS2JLnotanswered);
	}
}

function nextquest(jawab){
	
	if (index == 499 || index == 999 || index == 1499){
		status = 'Break';
		//console.log('Status: Break');
		//console.log(index);
	}
	index++;
	
	console.log(index + '(Telah Dikerjakan)');
	$('table.tabledijawab > tbody > tr.barisdijawab' + index + ' > td.answered').text(jawab);
	if ($('table.tabledijawab > tbody > tr.barisdijawab' + index + ' > td.answered').text() == '') {
		console.log( index + ' failed');
	}
	$('.soaltest').attr('hidden','true');
	$('.barisss').attr('hidden','true');
	$('.barispilihan').attr('hidden','true');
	$('.barisnya' + barisny[index]).removeAttr('hidden');
	$('.listsoalke' + barisny[index]).removeAttr('hidden');
	$('#judulcard').text('Soal ' + barisny[index]);
	

	//put the selected radio to table
	console.log('table.tabledijawab > tbody > tr:nth-child(' + index + ') > td.answered? also selector' + index + ':checked');


	if (index < columnsoalcheckpoint[1] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Angka - Kolom 1');
		$('.soalke1').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[1]) {
			runTimer();
			//console.log('Restarted')
			detectClassRunningOut();
		}
		soalke = '1';
	} else if (index < columnsoalcheckpoint[2] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Angka - Kolom 2');
		$('.soalke2').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[1]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '2';
	} else if (index < columnsoalcheckpoint[3] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Angka - Kolom 3');
		$('.soalke3').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[2]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '3';
	} else if (index < columnsoalcheckpoint[4] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Angka - Kolom 4');
		$('.soalke4').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[3]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '4';
	} else if (index < columnsoalcheckpoint[5] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Angka - Kolom 5');
		$('.soalke5').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[4]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '5';
	} else if (index < columnsoalcheckpoint[6] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Angka - Kolom 6');
		$('.soalke6').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[5]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '6';
	} else if (index < columnsoalcheckpoint[7] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Angka - Kolom 7');
		$('.soalke7').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[6]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '7';
	} else if (index < columnsoalcheckpoint[8] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Angka - Kolom 8');
		$('.soalke8').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[7]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '8';
	} else if (index < columnsoalcheckpoint[9] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Angka - Kolom 9');
		$('.soalke9').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[8]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '9';
	} else if (index < columnsoalcheckpoint[10] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Angka - Kolom 10');
		$('.soalke10').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[9]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '10';
	} else if (index == 500 && status=='Break') {
		jenissoal = 'S1JL';
		$('.barispilihan').attr('hidden','true');
		$('#loader').css('display','block');
		$('#judulcard').text('Mengumpulkan Hasil');
		$('#jenissoalnya').text('Mohon Menunggu');
		$('.tabelsoal').attr('hidden','true');
		$('.soaltest').attr('hidden','true');
		$('.barisss').attr('hidden','true');
		getfilledEachColumn('S0JL',0,10);
		clearInterval(interval);
		setTimeout(function(){
			index = 500;
			$('#loader').css('display','none');
			$('#jenissoalnya').text('Hasil Pengerjaan Soal Angka');
			$('.brieftext').css('display','block');
			$('.brieftext').text('Berikut adalah hasil pengerjaan');
			$('#scorechartgraph').css("display","block");
			$('.soalke10').attr('hidden','true');

			$('#menjelangendbutton').css('display','none');

			$('#startbuttontest').css('display','block');
			$('#judulcard').text('Soal Angka Selesai');
			$('.tabelsoal').attr('hidden','true');
			$( "#countdownkolom" ).addClass("break");
			$( "#countdownkolom" ).text("jeda");
			
			//saat tepat sekali user ngisi soal pas waktu dah deket, pastikan soal selanjutnya ga keliatan [kode ini hanya sesaat, soon it will be implemented (for debugging purpose)]
			forceHide();

			
			detectClassRunningOut();
			clearInterval(interval);
			fetchNilai('S0JL');
		},5000);

	} else if (index < columnsoalcheckpoint[11] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Huruf - Kolom 1');
		$('.soalke11').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[10]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '11';
	} else if (index < columnsoalcheckpoint[12] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Huruf - Kolom 2');
		$('.soalke12').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[11]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '12';
	} else if (index < columnsoalcheckpoint[13] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Huruf - Kolom 3');
		$('.soalke13').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[12]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '13';
	} else if (index < columnsoalcheckpoint[14] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Huruf - Kolom 4');
		$('.soalke14').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[13]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '14';
	} else if (index < columnsoalcheckpoint[15] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Huruf - Kolom 5');
		$('.soalke15').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[14]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '15';
	} else if (index < columnsoalcheckpoint[16] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Huruf - Kolom 6');
		$('.soalke16').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[15]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '16';
	} else if (index < columnsoalcheckpoint[17] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Huruf - Kolom 7');
		$('.soalke17').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[16]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '17';
	} else if (index < columnsoalcheckpoint[18] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Huruf - Kolom 8');
		$('.soalke18').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[17]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '18';
	} else if (index < columnsoalcheckpoint[19] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Huruf - Kolom 9');
		$('.soalke19').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[18]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '19';
	} else if (index < columnsoalcheckpoint[20] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Huruf - Kolom 10');
		$('.soalke20').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[19]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '20';
	} else if (index == 1000 && status=='Break') {

		jenissoal = 'S2JL';
		$('.barispilihan').attr('hidden','true');
		$('#loader').css('display','block');
		$('#judulcard').text('Mengumpulkan Hasil');
		$('#jenissoalnya').text('Mohon Menunggu');
		$('.tabelsoal').attr('hidden','true');
		$('.soaltest').attr('hidden','true');
		$('.barisss').attr('hidden','true');
		getfilledEachColumn('S1JL',10,20);
		clearInterval(interval);
		setTimeout(function(){
			index = 1000;
			$('#loader').css('display','none');
			$('#jenissoalnya').text('Hasil Pengerjaan Soal Huruf');
			$('.brieftext').css('display','block');
			$('.brieftext').text('Berikut adalah hasil pengerjaan');
			$('#scorechartgraph').css("display","block");
			$('.soalke20').attr('hidden','true');
			
			$('#menjelangendbutton').css('display','none');

			$('#startbuttontest').css('display','block');
			$('#judulcard').text('Soal Huruf Selesai');
			$('.tabelsoal').attr('hidden','true');
			$( "#countdownkolom" ).addClass("break");
			$( "#countdownkolom" ).text("jeda");

			//saat tepat sekali user ngisi soal pas waktu dah deket, pastikan soal selanjutnya ga keliatan [kode ini hanya sesaat, soon it will be implemented (for debugging purpose)]
			forceHide();

			
			detectClassRunningOut();
			clearInterval(interval);
			fetchNilai('S1JL');
			},3000);
	} else if (index < columnsoalcheckpoint[21] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Simbol - Kolom 1');
		$('.soalke21').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[20]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		$('#startbuttontest').css('display','none');
		soalke = '21';
	} else if (index < columnsoalcheckpoint[22] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Simbol - Kolom 2');
		$('.soalke22').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[21]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '22';
	} else if (index < columnsoalcheckpoint[23] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Simbol - Kolom 3');
		$('.soalke23').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[22]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '23';
	} else if (index < columnsoalcheckpoint[24] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Simbol - Kolom 4');
		$('.soalke24').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[23]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '24';
	} else if (index < columnsoalcheckpoint[25] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Simbol - Kolom 5');
		$('.soalke25').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[24]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '25';
	} else if (index < columnsoalcheckpoint[26] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Simbol - Kolom 6');
		$('.soalke26').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[25]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '26';
	} else if (index < columnsoalcheckpoint[27] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Simbol - Kolom 7');
		$('.soalke27').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[26]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '27';
	} else if (index < columnsoalcheckpoint[28] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Simbol - Kolom 8');
		$('.soalke28').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[27]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '28';
	} else if (index < columnsoalcheckpoint[29] && status=='Mengerjakan') {
		$('#jenissoalnya').text('Soal Simbol - Kolom 9');
		$('.soalke29').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[28]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '29';
	} else if (index < columnsoalcheckpoint[30] && status=='Mengerjakan'){
		$('#jenissoalnya').text('Soal Simbol - Kolom 10');
		$('.soalke30').removeAttr('hidden');
		
		if (index == columnsoalcheckpoint[29]) {
			runTimer();
			//console.log('Restarted');
			detectClassRunningOut();
		}
		soalke = '30';
	} else {
		$('.barispilihan').attr('hidden','true');
		$('#loader').css('display','block');
		$('#judulcard').text('Mengumpulkan Hasil');
		$('#jenissoalnya').text('Mohon Menunggu');
		$('.tabelsoal').attr('hidden','true');
		$('.soaltest').attr('hidden','true');
		$('.barisss').attr('hidden','true');
		getfilledEachColumn('S2JL',20,30);
		clearInterval(interval);
		setTimeout(function(){
			$('#loader').css('display','none');
			$('#jenissoalnya').text('Hasil Pengerjaan Soal Simbol');
			$('.brieftext').css('display','block');
			$('.brieftext').text('Berikut adalah hasil pengerjaan');
			$('#scorechartgraph').css("display","block");
			$('.soalke30').attr('hidden','true');
			
			$('#menjelangendbutton').css('display','block');
			$('#judulcard').text('Soal Simbol Selesai');
			$('.tabelsoal').attr('hidden','true');
			$( "#countdownkolom" ).addClass("break");
			$( "#countdownkolom" ).text("jeda");

			//saat tepat sekali user ngisi soal pas waktu dah deket, pastikan soal selanjutnya ga keliatan [kode ini hanya sesaat, soon it will be implemented (for debugging purpose)]
			forceHide();
			
			detectClassRunningOut();
			clearInterval(interval);
			fetchNilai('S2JL');
		},3000);
	}

	//console.log(index + ' Selesai');
	//console.warn('Soal ke :' + soalke);
	//console.warn('Jenis Soal :' + jenissoal);
}

function refreshQuest() {
	$('.barisnya' + barisny[index]).removeAttr('hidden');
	$('.listsoalke' + barisny[index]).removeAttr('hidden');
	$('#judulcard').text('Soal ' + barisny[index]);
}

function pindahKolom() {
	$('.soaltest').attr('hidden','true');
	$('.barisss').attr('hidden','true');
	$('.barispilihan').attr('hidden','true');
	if (soalke == '1') 
	{
		index = columnsoalcheckpoint[1];				
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Angka - Kolom 2');
		$('.soalke2').removeAttr('hidden');
		
		soalke = '2';
	} else if (soalke == '2') {
		index = columnsoalcheckpoint[2];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Angka - Kolom 3');
		
		$('.soalke3').removeAttr('hidden');
		soalke = '3';
	} else if (soalke == '3') {
		index = columnsoalcheckpoint[3];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Angka - Kolom 4');
		
		$('.soalke4').removeAttr('hidden');
		soalke = '4';
	} else if (soalke == '4') {
		index = columnsoalcheckpoint[4];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Angka - Kolom 5');
		
		$('.soalke5').removeAttr('hidden');
		soalke = '5';
	} else if (soalke == '5') {
		index = columnsoalcheckpoint[5];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Angka - Kolom 6');
		
		$('.soalke6').removeAttr('hidden');
		soalke = '6';
	} else if (soalke == '6') {
		index = columnsoalcheckpoint[6];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Angka - Kolom 7');
		
		$('.soalke7').removeAttr('hidden');
		soalke = '7';
	} else if (soalke == '7') {
		index = columnsoalcheckpoint[7];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Angka - Kolom 8');
		
		$('.soalke8').removeAttr('hidden');
		soalke = '8';
	} else if (soalke == '8') {
		index = columnsoalcheckpoint[8];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Angka - Kolom 9');
		
		$('.soalke9').removeAttr('hidden');
		soalke = '9';
	} else if (soalke == '9') {
		index = columnsoalcheckpoint[9];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Angka - Kolom 10');
		
		$('.soalke10').removeAttr('hidden');
		soalke = '10';
	} else if (soalke == '10') {
		index = columnsoalcheckpoint[10];
		jenissoal = 'S1JL';
		$('#loader').css('display','block');
		$('#judulcard').text('Mengumpulkan Hasil');
		$('#jenissoalnya').text('Mohon Menunggu');
		$('.tabelsoal').attr('hidden','true');
		$('.soaltest').attr('hidden','true');
		$('.barisss').attr('hidden','true');
		getfilledEachColumn('S0JL',0,10);
		clearInterval(interval);
		setTimeout(function(){
			$('#loader').css('display','none');
			$('#jenissoalnya').text('Hasil Pengerjaan Soal Angka');
			$('.brieftext').css('display','block');
			$('.brieftext').text('Berikut adalah hasil pengerjaan');
			$('#scorechartgraph').css("display","block");
			$('.soalke10').attr('hidden','true');

			$('#startbuttontest').css('display','block');
			$('#judulcard').text('Soal Angka Selesai');
			$('.tabelsoal').attr('hidden','true');
			$( "#countdownkolom" ).addClass("break");
			$( "#countdownkolom" ).text("jeda");

			//saat tepat sekali user ngisi soal pas waktu dah deket, pastikan soal selanjutnya ga keliatan [kode ini hanya sesaat, soon it will be implemented (for debugging purpose)]
			forceHide();
			
			detectClassRunningOut();
			clearInterval(interval);
			fetchNilai('S0JL');
			},3000);
		soalke = '11';
	} else if (soalke == '11') {
		index = columnsoalcheckpoint[11];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Huruf - Kolom 2');
		
		$('.soalke12').removeAttr('hidden');
		soalke = '12';
	} else if (soalke == '12') {
		index = columnsoalcheckpoint[12];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Huruf - Kolom 3');
		
		$('.soalke13').removeAttr('hidden');
		soalke = '13';
	} else if (soalke == '13') {
		index = columnsoalcheckpoint[13];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Huruf - Kolom 4');
		
		$('.soalke14').removeAttr('hidden');
		soalke = '14';
	} else if (soalke == '14') {
		index = columnsoalcheckpoint[14];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Huruf - Kolom 5');
		
		$('.soalke15').removeAttr('hidden');
		soalke = '15';
	} else if (soalke == '15') {
		index = columnsoalcheckpoint[15];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Huruf - Kolom 6');
		
		$('.soalke16').removeAttr('hidden');
		soalke = '16';
	} else if (soalke == '16') {
		index = columnsoalcheckpoint[16];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Huruf - Kolom 7');
		
		$('.soalke17').removeAttr('hidden');
		soalke = '17';
	} else if (soalke == '17') {
		index = columnsoalcheckpoint[17];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Huruf - Kolom 8');
		
		$('.soalke18').removeAttr('hidden');
		soalke = '18';
	} else if (soalke == '18') {
		index = columnsoalcheckpoint[18];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Huruf - Kolom 9');
		
		$('.soalke19').removeAttr('hidden');
		soalke = '19';
	} else if (soalke == '19') {
		index = columnsoalcheckpoint[19];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Huruf - Kolom 10');
		
		$('.soalke20').removeAttr('hidden');
		soalke = '20';
	} else if (soalke == '20') {
		index = columnsoalcheckpoint[20];
		jenissoal = 'S2JL';
		$('#loader').css('display','block');
		$('#judulcard').text('Mengumpulkan Hasil');
		$('#jenissoalnya').text('Mohon Menunggu');
		$('.tabelsoal').attr('hidden','true');
		$('.soaltest').attr('hidden','true');
		$('.barisss').attr('hidden','true');
		getfilledEachColumn('S1JL',10,20);
		clearInterval(interval);
		setTimeout(function(){
			$('#loader').css('display','none');
			$('#jenissoalnya').text('Hasil Pengerjaan Soal Huruf');
			$('.brieftext').css('display','block');
			$('.brieftext').text('Berikut adalah hasil pengerjaan');
			$('#scorechartgraph').css("display","block");
			$('.soalke20').attr('hidden','true');

			$('#startbuttontest').css('display','block');
			$('#judulcard').text('Soal Huruf Selesai');
			$('.tabelsoal').attr('hidden','true');
			$("#countdownkolom").addClass("break");
			$("#countdownkolom").text("jeda");

			//saat tepat sekali user ngisi soal pas waktu dah deket, pastikan soal selanjutnya ga keliatan [kode ini hanya sesaat, soon it will be implemented (for debugging purpose)]
			forceHide();

			detectClassRunningOut();
			clearInterval(interval);
			fetchNilai('S1JL');
			},3000);
		soalke = '21';
	} else if (soalke == '21') {
		index = columnsoalcheckpoint[21];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Simbol - Kolom 2');
		
		$('.soalke22').removeAttr('hidden');
		soalke = '22';
	} else if (soalke == '22') {
		index = columnsoalcheckpoint[22];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Simbol - Kolom 3');
		
		$('.soalke23').removeAttr('hidden');
		soalke = '23';
	} else if (soalke == '23') {
		index = columnsoalcheckpoint[23];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Simbol - Kolom 4');
		
		$('.soalke24').removeAttr('hidden');
		soalke = '24';
	} else if (soalke == '24') {
		index = columnsoalcheckpoint[24];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Simbol - Kolom 5');
		
		$('.soalke25').removeAttr('hidden');
		soalke = '25';
	} else if (soalke == '25') {
		index = columnsoalcheckpoint[25];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Simbol - Kolom 6');
		
		$('.soalke26').removeAttr('hidden');
		soalke = '26';
	} else if (soalke == '26') {
		index = columnsoalcheckpoint[26];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Simbol - Kolom 7');
		
		$('.soalke27').removeAttr('hidden');
		soalke = '27';
	} else if (soalke == '27') {
		index = columnsoalcheckpoint[27];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Simbol - Kolom 8');
		
		$('.soalke28').removeAttr('hidden');
		soalke = '28';
	} else if (soalke == '28') {
		index = columnsoalcheckpoint[28];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Simbol - Kolom 9');
		
		$('.soalke29').removeAttr('hidden');
		soalke = '29';
	} else if (soalke == '29') {
		index = columnsoalcheckpoint[29];
		runTimer();
		refreshQuest();
		$('#jenissoalnya').text('Soal Simbol - Kolom 10');
		
		$('.soalke30').removeAttr('hidden');
		soalke = '30';
	} else if (soalke == '30') {
		index = columnsoalcheckpoint[30];
		$('#loader').css('display','block');
		$('#judulcard').text('Mengumpulkan Hasil');
		$('#jenissoalnya').text('Mohon Menunggu');
		$('.tabelsoal').attr('hidden','true');
		$('.soaltest').attr('hidden','true');
		$('.barisss').attr('hidden','true');
		getfilledEachColumn('S2JL',20,30);
		clearInterval(interval);
		setTimeout(function(){
			$('#loader').css('display','none');
			$('#jenissoalnya').text('Hasil Pengerjaan Soal Simbol');
			$('.brieftext').css('display','block');
			$('.brieftext').text('Berikut adalah hasil pengerjaan');
			$('#scorechartgraph').css("display","block");
			$('.soalke30').attr('hidden','true');
			
			$('#menjelangendbutton').css('display','block');
			$('#judulcard').text('Soal Simbol Selesai');
			$('.tabelsoal').attr('hidden','true');
			$( "#countdownkolom" ).addClass("break");
			$( "#countdownkolom" ).text("jeda");

			//saat tepat sekali user ngisi soal pas waktu dah deket, pastikan soal selanjutnya ga keliatan [kode ini hanya sesaat, soon it will be implemented (for debugging purpose)]
			forceHide();

			detectClassRunningOut();
			clearInterval(interval);
			fetchNilai('S2JL');
		},3000);
	} else {
		alert('Error 32104-21: cantumkan kode report ini saat melapor')
		console.log('something wrong?');
	}
	//console.log('Index :' + index);
	//console.warn('Soal ke :' + soalke);
	//console.warn('Jenis Soal :' + jenissoal);
}


function runTimer() {
	clearInterval(interval);
	var timernya = "1:01";
	interval = setInterval(function() {
		var timer = timernya.split(':');
		//by parsing integer, I avoid all extra string processing
		var minutes = parseInt(timer[0], 10);
		var seconds = parseInt(timer[1], 10);
		--seconds;
		minutes = (seconds < 0) ? --minutes : minutes;
		seconds = (seconds < 0) ? 59 : seconds;
		seconds = (seconds < 10) ? '0' + seconds : seconds;
		//minutes = (minutes < 10) ?  minutes : minutes;
		$('#countdownkolom').html(minutes + ':' + seconds);
		if (minutes < 0) {
			clearInterval(interval);
		}

		if ((minutes <= 0) && (seconds <= 10)) {
			$( "#countdownkolom" ).addClass( "runningout" );
		}
		//check if both minutes and seconds are 0
		if ((seconds <= 0) && (minutes <= 0)){
			if (status == 'Break') {
				clearInterval(interval);	
			} else {
				$('#countdownkolom').removeClass('runningout');
				//console.log('Clearing running out');
				clearInterval(interval);
				pindahKolom();
			}
		};
		timernya = minutes + ':' + seconds;
	}, 1000);
}

function forceHide() {
	$('.soaltest').attr('hidden','true');
	$('.barisss').attr('hidden','true');
}

var chartLabels = ['Kolom 1', 'Kolom 2', 'Kolom 3', 'Kolom 4', 'Kolom 5', 'Kolom 6', 'Kolom 7', 'Kolom 8', 'Kolom 9', 'Kolom 10'];
var lineChart
var scalesOptions = {
			xAxes: [
			{
				gridLines:
				{
					display: false
				}
			}],
			yAxes: [
			{
				gridLines:
				{
					color: '#eff3f6',
					drawBorder: false,
				},
			}]
		};


function fetchNilai(jsnya) {
	var js = jsnya;

	$('#score-chart').remove(); // this is my <canvas> element
	$('#scorechartgraph').append('<canvas id="score-chart" style="max-height: 50vh; width: auto;"></canvas>');

	if (js == 'S0JL') {
		var datasoal = Array();
		var datajawaban = Array();
		var gadijawab = 0;
		var salah = 0;
		var benar = 0;
		var nilai = 0;
		var status = [];
		//collect data jawaban fro kolom 2
		$('table.tabledijawab > tbody > tr').slice(0,500).each(function(o){
		    tds0 = $(this).find('td');
				datajawaban[o] = $(tds0[0]).text();
		});

		//collect data soal
		$("table.soalny > tbody > tr.barisss").slice(0,500).each(function(i, v){
		  datasoal[i] = Array();
		  $(this).children('td').each(function(ii, vv){
		    datasoal[i][ii] = $(this).text();
		  }); 
		});
		console.log(datasoal);
		console.log(datajawaban);

	    var x = 0;
		do {
			if(datajawaban[x]){
		        if(datasoal[x].includes(datajawaban[x])){
							salah++;
							status.push('Nomor ' + x + ' Salah');
						} else {
		                    benar++;
		                    status.push('Nomor ' + x + ' Benar');
		    //                nilai+= 0.2; //saat mendapat point
		                }
		        } else {
		        gadijawab++;
		        status.push('Nomor ' + x + ' Ga Diisi');
		    }
		    x++;
		}
		while(x < 500);
		//console.log('Benar : ' + benar);
		//console.log('Salah : ' + salah);
		console.log(status);
		var datascore = [];
		let scorperklom = 0;
		for (var i = 0; i < 10; i++) {
		
			scorperklom = nilaiArrayS0JLcorrect[i];
			if (nilaiArrayS0JLcorrect[i] >= nilaiArrayS0JLcorrect[i - 1]) {
			    scorperklom = nilaiArrayS0JLcorrect[i] * 2;
			} else {
			  	scorperklom = nilaiArrayS0JLcorrect[i];
			}
			datascore.push(scorperklom);
			scorperklom = 0;
		}
		var multiplyfirstcolumn = datascore[0] * 2;
		datascore.splice(0, 1, multiplyfirstcolumn);
		for (var o = 2; o < 10; o++){
			if (datascore[o] >= datascore[o + 1]){
		  	datascore.splice(0, 1, multiplyfirstcolumn);
			}
		}
		performancescoreS0JL.push(datascore);
		
		var ctxLineChart = document.getElementById("score-chart").getContext("2d");
		lineChart = new Chart(ctxLineChart,
		{
			type: 'line',
			data:
			{
				labels: chartLabels,
				datasets: [
				{
					data: nilaiArrayS0JLcorrect,
					label: 'Jawaban Benar',
					fill: false,
					borderWidth: 2,
					pointRadius: 3,
					pointHoverRadius: 5,
					borderColor: '#1ce633',
					backgroundColor: '#fff',
				},
				{
					data: nilaiArrayS0JLwrong,
					label: 'Jawaban Salah',
					fill: false,
					borderWidth: 2,
					pointRadius: 3,
					pointHoverRadius: 5,
					borderColor: '#f04832',
					backgroundColor: '#fff',
				},
				{
					data: countArrayS0JLanswered,
					label: 'Dijawab',
					fill: false,
					borderWidth: 2,
					pointRadius: 3,
					pointHoverRadius: 5,
					borderColor: '#45aeef',
					backgroundColor: '#fff',
				},
				{
					data: countArrayS0JLnotanswered,
					label: 'Tidak Dijawab',
					fill: false,
					borderWidth: 2,
					pointRadius: 3,
					pointHoverRadius: 5,
					borderColor: '#f0e813',
					backgroundColor: '#fff',
				}]
			},
			options:
			{
				responsive: true,
            	maintainAspectRatio: false,
				scales: scalesOptions,
			}
		});

		var ooo = datascore.reduce((a, b) => a + b, 0);
		//$('#tbnilaiS0JL').val(parseFloat(nilai).toFixed(2)); //Old Scorong System
		nilai = parseFloat(ooo/10).toFixed(2);
		if (nilai > 100) {nilai = 100}
		$('#tbnilaiS0JL').val(nilai);
		$('#tbperformanceS0JL').val(datascore);
		//$('#scoreresultLeft').css('display','unset');
		$('#scoreresultRight').css('display','unset');
		console.log("total :" + nilai);
		console.log("nilai :" + nilai);


	} else if(js == 'S1JL') {
		var datasoal = Array();
		var datajawaban = Array();
		var gadijawab = 0;
		var salah = 0;
		var benar = 0;
		var nilai = 0;
		var status = [];
		//collect data jawaban fro kolom 2
		$('table.tabledijawab > tbody > tr').slice(500,1000).each(function(o){
		    tds1 = $(this).find('td');
				datajawaban[o] = $(tds1[0]).text();
		});

		//collect data soal
		$("table.soalny > tbody > tr.barisss").slice(500,1000).each(function(i, v){
		  datasoal[i] = Array();
		  $(this).children('td').each(function(ii, vv){
		    datasoal[i][ii] = $(this).text();
		  }); 
		});
		console.log(datajawaban);
		console.log(datasoal);
		var x = 0;
		do {
			if(datajawaban[x]){
		        if(datasoal[x].includes(datajawaban[x])){
							salah++;
							status.push('Nomor ' + x + ' Salah');
						} else {
		                    benar++;
		                    status.push('Nomor ' + x + ' Benar');
		    //                nilai+= 0.2; //saat mendapat point
		                }
		        } else {
		        gadijawab++;
		        status.push('Nomor ' + x + ' Ga Diisi');
		    }
		    x++;
		}
		while(x < 500);
		console.log(status);
		if(nilai > 100){nilai = 100}//handling score if > 100 happen
		var datascore = [];
		let scorperklom = 0
		for (var i = 0; i < 10; i++) {
			scorperklom = nilaiArrayS1JLcorrect[i];
			if (nilaiArrayS1JLcorrect[i] >= nilaiArrayS1JLcorrect[i - 1]) {
			    scorperklom = nilaiArrayS1JLcorrect[i] * 2;
			} else {
			  	scorperklom = nilaiArrayS1JLcorrect[i];
			}
			datascore.push(scorperklom);
			scorperklom = 0;
		}
		var multiplyfirstcolumn = datascore[0] * 2;
		datascore.splice(0, 1, multiplyfirstcolumn);
		for (var o = 2; o < 10; o++){
			if (datascore[o] >= datascore[o + 1]){
		  	datascore.splice(0, 1, multiplyfirstcolumn);
			}
		}
		performancescoreS1JL.push(datascore);
			// line chart
		var ctxLineChart = document.getElementById("score-chart").getContext("2d");
		lineChart = new Chart(ctxLineChart,
		{
			type: 'line',
			data:
			{
				labels: chartLabels,
				datasets: [
				{
					data: nilaiArrayS1JLcorrect,
					label: 'Jawaban Benar',
					fill: false,
					borderWidth: 2,
					pointRadius: 3,
					pointHoverRadius: 5,
					borderColor: '#1ce633',
					backgroundColor: '#fff',
				},
				{
					data: nilaiArrayS1JLwrong,
					label: 'Jawaban Salah',
					fill: false,
					borderWidth: 2,
					pointRadius: 3,
					pointHoverRadius: 5,
					borderColor: '#f04832',
					backgroundColor: '#fff',
				},
				{
					data: countArrayS1JLanswered,
					label: 'Dijawab',
					fill: false,
					borderWidth: 2,
					pointRadius: 3,
					pointHoverRadius: 5,
					borderColor: '#45aeef',
					backgroundColor: '#fff',
				},
				{
					data: countArrayS1JLnotanswered,
					label: 'Tidak Dijawab',
					fill: false,
					borderWidth: 2,
					pointRadius: 3,
					pointHoverRadius: 5,
					borderColor: '#f0e813',
					backgroundColor: '#fff',
				}]
			},
			options:
			{
				responsive: true,
            	maintainAspectRatio: false,
				scales: scalesOptions,
			}
		});

		//console.log('Benar : ' + benar);
		//console.log('Salah : ' + salah);
		//console.log('Gadijawab : ' + gadijawab);
		//$('#tbnilaiS1JL').val(parseFloat(nilai).toFixed(2));
		var ooo = datascore.reduce((a, b) => a + b, 0);
		//$('#tbnilaiS0JL').val(parseFloat(nilai).toFixed(2)); //Old Scorong System
		nilai = parseFloat(ooo/10).toFixed(2);
		if (nilai > 100) {nilai = 100}
		$('#tbnilaiS1JL').val(nilai);
		$('#tbperformanceS1JL').val(datascore);
		//$('#scoreresultLeft').css('display','unset');
		$('#scoreresultRight').css('display','unset');
		console.log("total :" + nilai);
		console.log("nilai :" + nilai);

	} else if(js == 'S2JL') {			
		var datasoal = Array();
		var datajawaban = Array();
		var gadijawab = 0;
		var salah = 0;
		var benar = 0;
		var nilai = 0;
		var status = [];
		//collect data jawaban fro kolom 2
		$('table.tabledijawab > tbody > tr').slice(1000,1500).each(function(o){
		    tds2 = $(this).find('td');
				datajawaban[o] = $(tds2[0]).text();
		});

		//collect data soal
		$("table.soalny > tbody > tr.barisss").slice(1000,1500).each(function(i, v){
		  datasoal[i] = Array();
		  $(this).children('td').each(function(ii, vv){
		    datasoal[i][ii] = $(this).text();
		  }); 
		});
		console.log(datasoal);
		console.log(datajawaban);

	    var x = 0;
		do {
			if(datajawaban[x]){
		        if(datasoal[x].includes(datajawaban[x])){
							salah++;
							status.push('Nomor ' + x + ' Salah');
						} else {
		                    benar++;
		                    status.push('Nomor ' + x + ' Benar');
		    //                nilai+= 0.2; //saat mendapat point
		                }
		        } else {
		        gadijawab++;
		        status.push('Nomor ' + x + ' Ga Diisi');
		    }
		    x++;
		}
		while(x < 500);

		console.log(status);

		var datascore = [];
		let scorperklom = 0;
		for (var i = 0; i < 10; i++) {
		
			scorperklom = nilaiArrayS2JLcorrect[i];
			if (nilaiArrayS2JLcorrect[i] >= nilaiArrayS2JLcorrect[i - 1]) {
			    scorperklom = nilaiArrayS2JLcorrect[i] * 2;
			} else {
			  	scorperklom = nilaiArrayS2JLcorrect[i];
			}
			datascore.push(scorperklom);
			scorperklom = 0;
		}
		var multiplyfirstcolumn = datascore[0] * 2;
		if (datascore[1] >= datascore[0]){
		  	datascore.splice(0, 1, multiplyfirstcolumn);
		}
		performancescoreS2JL.push(datascore);

		var ctxLineChart = document.getElementById("score-chart").getContext("2d");
		lineChart = new Chart(ctxLineChart,
		{
			type: 'line',
			data:
			{
				labels: chartLabels,
				datasets: [
				{
					data: nilaiArrayS2JLcorrect,
					label: 'Jawaban Benar',
					fill: false,
					borderWidth: 2,
					pointRadius: 3,
					pointHoverRadius: 5,
					borderColor: '#1ce633',
					backgroundColor: '#fff',
				},
				{
					data: nilaiArrayS2JLwrong,
					label: 'Jawaban Salah',
					fill: false,
					borderWidth: 2,
					pointRadius: 3,
					pointHoverRadius: 5,
					borderColor: '#f04832',
					backgroundColor: '#fff',
				},
				{
					data: countArrayS2JLanswered,
					label: 'Dijawab',
					fill: false,
					borderWidth: 2,
					pointRadius: 3,
					pointHoverRadius: 5,
					borderColor: '#45aeef',
					backgroundColor: '#fff',
				},
				{
					data: countArrayS2JLnotanswered,
					label: 'Tidak Dijawab',
					fill: false,
					borderWidth: 2,
					pointRadius: 3,
					pointHoverRadius: 5,
					borderColor: '#f0e813',
					backgroundColor: '#fff',
				}]
			},
			options:
			{
				responsive: true,
            	maintainAspectRatio: false,
				scales: scalesOptions,
			}
		});
		//console.log('Benar : ' + benar);
		//console.log('Salah : ' + salah);
		//if(nilai > 100){nilai = 100}//handling score if > //100 happen
		//$('#tbnilaiS2JL').val(parseFloat(nilai).toFixed(2)1;
		var ooo = datascore.reduce((a, b) => a + b, 0);
		//$('#tbnilaiS0JL').val(parseFloat(nilai).toFixed(2)); //Old Scorong System
		nilai = parseFloat(ooo/10).toFixed(2);
		if (nilai > 100) {nilai = 100}
		$('#tbnilaiS2JL').val(nilai);
		$('#tbperformanceS2JL').val(datascore);
		//$('#scoreresultLeft').css('display','unset');
		$('#scoreresultRight').css('display','unset');
		console.log("total :" + nilai);
		console.log("nilai :" + nilai);
	} else {
		alert('Error 210421 : cantumkan kode report ini saat melapor')
	}
	$('#score-chart').css('display',''); //fixing not showing chart someti
	$('#JBenar').text('' + benar + '');
	$('#JSalah').text('' + salah + '');
	$('#JTidakDijawab').text('' + gadijawab + '');
	$('#Nilainya').text(nilai);
}