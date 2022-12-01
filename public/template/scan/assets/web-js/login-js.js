var SCREEN_WIDTH = window.innerWidth;
var SCREEN_HEIGHT = window.innerHeight;

var RADIUS = 70;
var RADIUS_SCALE = 1;
var RADIUS_SCALE_MIN = 1;
var RADIUS_SCALE_MAX = 1.5;

var QUANTITY = 8;

var canvas;
var context;
var particles;

var mouseX = SCREEN_WIDTH * 0.5;
var mouseY = SCREEN_HEIGHT * 0.5;
var mouseIsDown = false;

function init() {

  canvas = document.getElementById('world');
  if (canvas && canvas.getContext) {
		context = canvas.getContext('2d');
		
		// Register event listeners
		window.addEventListener('mousemove', documentMouseMoveHandler, false);
		window.addEventListener('mousedown', documentMouseDownHandler, false);
		window.addEventListener('mouseup', documentMouseUpHandler, false);
		document.addEventListener('touchstart', documentTouchStartHandler, false);
		document.addEventListener('touchmove', documentTouchMoveHandler, false);
		window.addEventListener('resize', windowResizeHandler, false);
		
		createParticles();
		windowResizeHandler();
		setInterval(loop, 1000/60);
	}
}

function createParticles() {
	particles = [];
	var webuzo_colors = ["#20336e","#406a1b","#e86d30","#992929","#20336e","#406a1b","#e86d30","#992929"];
	for (var i = 0; i < QUANTITY; i++) {
		var particle = {
			size: 1,
			position: { x: mouseX, y: mouseY },
			offset: { x: 0, y: 0 },
			shift: { x: mouseX, y: mouseY },
			speed: 0.01+Math.random()*0.04,
			targetSize: 1,
			//fillColor: '#' + (Math.random() * 0x404040 + 0xaaaaaa | 0).toString(16),
			fillColor: webuzo_colors[i],
			orbit: RADIUS*.5 + (RADIUS * .5 * Math.random())
		};
		
		particles.push(particle);
	}
}

function documentMouseMoveHandler(event) {
	mouseX = event.clientX - (window.innerWidth - SCREEN_WIDTH) * .5;
	mouseY = event.clientY - (window.innerHeight - SCREEN_HEIGHT) * .5;
}

function documentMouseDownHandler(event) {
	mouseIsDown = true;
}

function documentMouseUpHandler(event) {
	mouseIsDown = false;
}

function documentTouchStartHandler(event) {
	if(event.touches.length == 1) {
		event.preventDefault();

		mouseX = event.touches[0].pageX - (window.innerWidth - SCREEN_WIDTH) * .5;;
		mouseY = event.touches[0].pageY - (window.innerHeight - SCREEN_HEIGHT) * .5;
	}
}

function documentTouchMoveHandler(event) {
	if(event.touches.length == 1) {
		event.preventDefault();

		mouseX = event.touches[0].pageX - (window.innerWidth - SCREEN_WIDTH) * .5;;
		mouseY = event.touches[0].pageY - (window.innerHeight - SCREEN_HEIGHT) * .5;
	}
}

function windowResizeHandler() {
	SCREEN_WIDTH = screen.width;
	SCREEN_HEIGHT = screen.height;
	
	canvas.width = SCREEN_WIDTH;
	canvas.height = SCREEN_HEIGHT;
}

function loop() {
	
	if(mouseIsDown) {
		RADIUS_SCALE += (RADIUS_SCALE_MAX - RADIUS_SCALE) * (0.02);
	}
	else {
		RADIUS_SCALE -= (RADIUS_SCALE - RADIUS_SCALE_MIN) * (0.02);
	}
	
	RADIUS_SCALE = Math.min(RADIUS_SCALE, RADIUS_SCALE_MAX);
	
	context.fillStyle = 'rgba(0,0,0,0.05)';
	//context.fillStyle = '#9e9e9e'
	context.fillRect(0, 0, context.canvas.width, context.canvas.height);
	
	for (i = 0, len = particles.length; i < len; i++) {
		var particle = particles[i];
		
		var lp = { x: particle.position.x, y: particle.position.y };
		
		// Rotation
		particle.offset.x += particle.speed;
		particle.offset.y += particle.speed;
		
		// Follow mouse with some lag
		particle.shift.x += ( mouseX - particle.shift.x) * (particle.speed);
		particle.shift.y += ( mouseY - particle.shift.y) * (particle.speed);
		
		// Apply position
		particle.position.x = particle.shift.x + Math.cos(i + particle.offset.x) * (particle.orbit*RADIUS_SCALE);
		particle.position.y = particle.shift.y + Math.sin(i + particle.offset.y) * (particle.orbit*RADIUS_SCALE);
		
		// Limit to screen bounds
		particle.position.x = Math.max( Math.min( particle.position.x, SCREEN_WIDTH ), 0 );
		particle.position.y = Math.max( Math.min( particle.position.y, SCREEN_HEIGHT ), 0 );
		
		particle.size += ( particle.targetSize - particle.size ) * 0.05;
		
		if( Math.round( particle.size ) == Math.round( particle.targetSize ) ) {
			particle.targetSize = 1 + Math.random() * 7;
		}
		
		context.beginPath();
		context.fillStyle = particle.fillColor;
		//console.log(particle.fillColor);
		context.strokeStyle = particle.fillColor;
		context.lineWidth = particle.size;
		context.moveTo(lp.x, lp.y);
		context.lineTo(particle.position.x, particle.position.y);
		context.stroke();
		context.arc(particle.position.x, particle.position.y, particle.size/2, 0, Math.PI*2, true);
		context.fill();
	}
}
window.onload = init;

$(document).ready(function() {
	function makeid(length) {
		var result           = '';
		var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		var charactersLength = characters.length;
		for ( var i = 0; i < length; i++ ) {
		  	result += characters.charAt(Math.floor(Math.random() * charactersLength));
		}
		return result;
	}

	//console.log(makeid(5));
	
	$("#btn-login").click( function() {

		var username = $("#tbusername").val();
		var password = $("#tbpassword").val();

		if(username.length == "") {
			Swal.fire({
			  type: 'warning',
			  title: 'Oops...',
			  text: 'Username Wajib Diisi !'
		    });
    	}else if(password.length == "") {
	        Swal.fire({
	          type: 'warning',
	          title: 'Oops...',
	          text: 'Password Wajib Diisi !'
	        });

        } else {
        	$('.welcometext').html('<div class="alert alert-warning" role="alert">Memproses</div>');
	      	
	      	$(this).attr('hidden','true');
        	$.ajax({
              url:  baseUrl + "/verification/loginkeun",
              type: "POST",
              data: {username:username,password:password},
              success:function(data){
                if (data == "ok") {
                	$('.welcometext').html('<div class="alert alert-warning" role="alert">Masukan Token peserta anda</div>');
			      	$('.tbusernamenya').css('display','none');
			      	$('.tbpasswordnya').css('display','none');
			      	$('.tbtokenform').css('display','block');
			      	$('#buttonvalidate').css('display','block');
                } else if (data == "admin") {
                	$('.tbtokenform').css('display','none');
			      	$('.tbusernamenya').css('display','none');
			      	$('.tbpasswordnya').css('display','none');
                	$('.welcometext').text('Selamat Datang admin');
					Swal.fire({
						type: 'success',
						title: 'Login Berhasil!',
						text: 'Selamat Datang Admin, anda akan diarahkan dalam 3 detik mohon tunggu.',
						timer: 3000,
						showCancelButton: false,
						showConfirmButton: false
					}).then (function() {
						$('.welcometext').html('<div class="alert alert-warning" role="alert">Memproses</div>');
		      			$('.tbtokenform').css('display','none');
		      			$('#buttonvalidate').css('display','none');
						window.location.href = baseUrl + "admin/Admin_Controller/index";
					});
				} else {
					$('.welcometext').html('<div class="alert alert-danger" role="alert">Login gagal, silahkan hubungi admin</div>');
					$('#btn-login').removeAttr('hidden');
	                  Swal.fire({
	                    type: 'error',
	                    title: 'Login Gagal!',
	                    text: 'Silahkan hubungi hubungi admin'
	                  });
                }
                console.log(data);
              },
              error:function(data){
				Swal.fire({
					type: 'error',
					title: 'Opps!',
					text: 'server error!'
				});
				console.log(data);
              }
          	});
        }
	});

	$("#buttonvalidate").click(function(){
		var username = $("#tbusername").val();
		var password = $("#tbpassword").val();
		var token = $("#tbtoken").val();
		$.ajax({
          url:  baseUrl + "/verification/checktoken",
          type: "POST",
          data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',token:token,username:username,password:password},
          success:function(data){
          	if(data == "peserta"){
				Swal.fire({
					type: 'success',
					title: 'Login Berhasil!',
					text: 'Selamat Datang Peserta, anda akan diarahkan dalam 3 detik mohon tunggu.',
					timer: 3000,
					showCancelButton: false,
					showConfirmButton: false
				})
				.then (function() {
					window.location.href = baseUrl + "peserta/Peserta_Controller/index";
				});                	
			} else if (data == "expired") {
				Swal.fire({
					type: 'error',
					title: 'Token kadaluarsa',
					text: 'Harap hubungi admin untuk token baru'
				});
			} else {
				Swal.fire({
					type: 'error',
					title: 'Login Gagal!',
					text: 'Harap masukan token dengan benar'
				});
			}
			console.log(data);
          }
        })
	});
})