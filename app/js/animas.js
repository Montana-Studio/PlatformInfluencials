//Animate SVG's
function success(){
	var icoHandLike = SVG('ico-handLike').size('100%','100%').viewbox(0, 0, 150, 150).addClass('likeHand')
	var muneca = icoHandLike.group().hide().front().addClass('grupoMune')
	var mano = icoHandLike.group().hide().back().addClass('grupoHand')
	
	function animaMune(){
		//Animate SVG's
		//PI-Like
		
		var mune = muneca.path('M40.401,133.314c0,1.332-0.218,1.55-1.564,1.55H13.761c-1.534,0-1.668-0.253-1.668-1.55V76.338c0-0.896,0.188-1.277,0.262-1.346c0.074-0.069,0.435-0.233,1.301-0.203c0.035,0,0.069,0,0.109,0h25.077c0.04,0,0.074,0,0.114,0c0.787-0.025,1.91,0.124,1.974,0.183c0.074,0.069,0.267,0.455,0.267,1.366l-0.792,55.157v1.821h-0.004V133.314z').addClass('coloGreen')
		var somMune = muneca.path('M13.785,135.289h25.423c1.361,0,1.583-0.035,1.583-1.366l0.792-1.728l-0.792-29.524c-4.508,2.86-10.559,3.325-15.789,3.325h3.241c-10.663,1.361-14.617-5.066-16.2-13.033v41.145C12.044,135.398,12.232,135.289,13.785,135.289z').addClass('coloGreen-sombra')
		var muneSolo = muneca.path('M40.401,133.314c0,1.332-0.218,1.55-1.564,1.55H13.761c-1.534,0-1.668-0.253-1.668-1.55V76.338c0-0.896,0.188-1.277,0.262-1.346c0.074-0.069,0.435-0.233,1.301-0.203c0.035,0,0.069,0,0.109,0h25.077c0.04,0,0.074,0,0.114,0c0.787-0.025,1.91,0.124,1.974,0.183c0.074,0.069,0.267,0.455,0.267,1.366l-0.792,55.157v1.821h-0.004V133.314z').fill('none').stroke({ color: '#134A78', opacity: 1, width: 7, linecap:'round' })
		
		muneca.show()

		muneca
			.scale(1, 0.1)
			.opacity(0)
			.animate(1000,SVG.easing.elastic)
			.scale(1, 1)
			.opacity(1)
			.after(function(){
				this
					.animate(300)
					.opacity(0)
			})
	}

	function animaMano(){
		
		var hand = mano.path('M52.079,74.997c-1.677,1.213-4.409,2.312-5.992,3.267v51.55c3.959,2.51,9.337,3.864,14.79,4.656H119.6c0.01,0.001,0.021,0.003,0.03,0.004h1.084c1.634,0,2.854-0.554,4.077-1.781l0.51-0.52c0.752-0.99,1.158-2.197,1.242-3.662c-0.016-1.594-0.544-2.801-1.752-4.008c-1.732-1.732-2.514-2.36-2.736-2.524c-1.371-0.698-2.062-2.315-1.563-3.819c0.524-1.578,2.167-2.465,3.756-2.078c0.241-0.06,0.489-0.094,0.747-0.094c1.439,0,2.688-0.49,3.811-1.49l0.4-0.479c0.016-0.015,0.025-0.03,0.04-0.045c0.815-0.944,1.267-2.128,1.366-3.612c-0.1-1.603-0.629-2.811-1.672-3.785c-0.069-0.063-0.14-0.134-0.198-0.207c-0.485-0.55-1.029-0.931-1.707-1.203c-1.455-0.584-2.267-2.143-1.905-3.666c0.361-1.524,1.781-2.559,3.346-2.431l1.143,0.095c1.554-0.025,2.746-0.534,3.855-1.644l0.029-0.03c1.084-1.257,1.613-2.548,1.613-3.943c0-1.608-0.51-2.836-1.643-3.979c-0.882-0.881-1.936-1.371-3.094-1.583c-1.499-0.282-2.73-1.588-2.73-3.112v-0.43c0-1.655,1.426-3.032,3.08-3.151l1.564-0.108c0.074-0.005,0.188-0.01,0.262-0.01c1.479,0,2.682-0.455,3.633-1.391c0.939-1.019,1.449-2.191,1.568-3.662c-0.084-0.811-0.089-2.25-0.089-5.933c-0.233-1.084-0.673-1.821-1.425-2.573c-0.866-0.865-2.643-1.231-5.146-1.231H88.146c-1.283,0-2.435-0.866-2.924-2.05c-0.49-1.182-0.219-2.592,0.688-3.497c2.646-2.647,4.211-5.884,4.66-9.585c0.08-0.866,0.193-5.205,0.199-13.79l-2.736-18.536c-0.203-0.96-0.653-1.776-1.371-2.494c-1.004-1.004-1.955-1.391-3.286-1.326c-0.099,0.006-0.203,0.006-0.302,0c-1.336-0.068-2.355,0.332-3.206,1.247c-0.025,0.024-0.05,0.054-0.074,0.079c-1.004,1.004-1.346,1.959-1.282,3.286c0,0.049,0.049,0.104,0.049,0.153v0.108c0,0.193-0.063,0.386-0.099,0.574l-3.667,19.812c-0.025,0.144-0.074,0.287-0.119,0.426c-5.191,15.666-12.781,27.127-22.588,34.211').addClass('coloGrey')
		var handSom = mano.path('M66.671,118.268c-10.228-9.471-16.814-29.08-14.592-43.242c-1.677,1.212-4.409,2.311-5.992,3.266v51.55c3.959,2.51,9.337,3.864,14.79,4.656h58.744c-6.66-0.792-13.617-2.078-19.694-3.137c-11.084-2.375-24.543-5.176-33.251-13.094H66.671z').addClass('coloGrey-sombra')
		var handSolo = mano.path('M82.789,15.1c0.094,0,0.188,0.002,0.285,0.007c0.049,0.003,0.1,0.004,0.15,0.004s0.102-0.001,0.151-0.004c0.095-0.004,0.187-0.007,0.277-0.007c1.188,0,2.076,0.4,3.009,1.333c0.718,0.718,1.168,1.534,1.371,2.494l2.736,18.536c-0.006,8.585-0.119,12.924-0.199,13.79c-0.449,3.701-2.014,6.938-4.66,9.585c-0.907,0.905-1.178,2.315-0.688,3.497c0.488,1.184,1.641,2.05,2.924,2.05h42.949c2.504,0,4.28,0.366,5.146,1.231c0.752,0.752,1.191,1.489,1.425,2.573c0,3.683,0.005,5.122,0.089,5.933c-0.119,1.471-0.629,2.644-1.568,3.662c-0.951,0.936-2.153,1.391-3.633,1.391c-0.074,0-0.188,0.005-0.262,0.011l-1.564,0.107c-1.653,0.119-3.08,1.496-3.08,3.15v0.431c0,1.524,1.231,2.83,2.73,3.112c1.158,0.212,2.212,0.701,3.094,1.582c1.133,1.144,1.644,2.371,1.644,3.979c0,1.396-0.529,2.687-1.613,3.943l-0.028,0.03c-1.109,1.109-2.302,1.619-3.855,1.644l-1.143-0.095c-0.088-0.007-0.176-0.011-0.263-0.011c-1.459,0-2.743,1.003-3.084,2.441c-0.362,1.522,0.45,3.082,1.905,3.666c0.678,0.272,1.222,0.653,1.707,1.203c0.058,0.073,0.129,0.144,0.197,0.207c1.043,0.974,1.572,2.182,1.672,3.784c-0.098,1.484-0.551,2.668-1.365,3.613c-0.016,0.015-0.023,0.029-0.04,0.045l-0.399,0.479c-1.123,1-2.373,1.49-3.812,1.49c-0.259,0-0.507,0.033-0.747,0.094c-0.25-0.061-0.502-0.09-0.75-0.09c-1.329,0-2.564,0.839-3.006,2.168c-0.499,1.504,0.191,3.121,1.562,3.818c0.223,0.164,1.004,0.793,2.736,2.524c1.208,1.207,1.736,2.414,1.752,4.008c-0.084,1.466-0.49,2.673-1.242,3.662l-0.51,0.521c-1.223,1.227-2.443,1.781-4.077,1.781h-1.084c-0.009-0.002-0.021-0.004-0.03-0.005H60.877c-5.453-0.792-10.831-2.146-14.79-4.655V78.264c1.583-0.955,6.001-3.261,6.001-3.261c7.613-5.5,16.464-15.73,22.588-34.211c0.045-0.139,0.094-0.282,0.119-0.426l3.667-19.812c0.036-0.188,0.099-0.381,0.099-0.574v-0.108c0-0.049-0.049-0.104-0.049-0.153c-0.063-1.327,0.278-2.282,1.282-3.286c0.024-0.025,0.049-0.055,0.074-0.079C80.657,15.505,81.592,15.1,82.789,15.1 M82.789,8.1c-3.109,0-5.867,1.181-7.979,3.416c-0.027,0.028-0.053,0.056-0.08,0.084c-2.196,2.25-3.279,4.962-3.223,8.069L67.972,38.77c-5.715,17.159-13.731,25.916-19.596,30.275c-1.253,0.658-4.456,2.351-5.905,3.225l-3.384,2.042v3.952v51.551v3.851l3.252,2.062c4.302,2.727,10.037,4.582,17.532,5.671l0.5,0.072h0.506h57.971l0.022,0.005h0.76h1.084c3.455,0,6.495-1.292,9.035-3.84l0.021-0.021l0.021-0.022l0.51-0.521l0.307-0.312l0.266-0.349c1.599-2.104,2.493-4.627,2.657-7.498l0.014-0.234l-0.002-0.234c-0.026-2.636-0.796-5.021-2.293-7.116c0.776-0.447,1.517-0.981,2.212-1.601l0.387-0.344l0.332-0.398l0.13-0.156l0.049-0.045l0.237-0.293c1.794-2.107,2.804-4.687,2.999-7.669l0.03-0.446l-0.028-0.447c-0.128-2.061-0.655-3.915-1.573-5.548c0.851-0.522,1.65-1.158,2.4-1.908l0.083-0.083l0.08-0.085l0.096-0.104l0.12-0.136c2.198-2.549,3.312-5.414,3.312-8.516c0-2.838-0.835-5.368-2.486-7.545c0.516-0.365,1.005-0.775,1.466-1.229l0.122-0.119l0.115-0.125c2.011-2.181,3.155-4.819,3.4-7.843l0.052-0.644l-0.066-0.643c-0.052-0.501-0.052-2.79-0.052-5.212v-0.745l-0.157-0.729c-0.504-2.342-1.589-4.32-3.318-6.049c-2.944-2.942-7.172-3.282-10.096-3.282H95.406c1.087-2.269,1.801-4.718,2.113-7.289l0.012-0.099l0.01-0.1c0.136-1.473,0.224-7.002,0.229-14.43v-0.517l-0.075-0.511l-2.736-18.536l-0.031-0.214l-0.045-0.212c-0.485-2.293-1.586-4.31-3.27-5.995C89.368,9.239,86.69,8.1,83.653,8.1c-0.14,0-0.282,0.002-0.426,0.007C83.08,8.102,82.934,8.1,82.789,8.1L82.789,8.1z').addClass('coloBlue-lines')
		
		mano.show()

		mano
			.opacity(0)
			.rotate(45, 100, 50)
			.animate(800, SVG.easing.elastic,'.2s')
			.opacity(1)
			.rotate(45, 50, 50)
			.after(function(){
				this
					.animate(300)
					.opacity(0)
			})
	}

	animaMune();
	animaMano();
	setInterval(function(){
		animaMune();
		animaMano();
	},2800);
}

function warning(){
	var warningIconPi = SVG('icon-warning').viewbox(0, 0,200, 200).addClass('warning-svg')
	var set = warningIconPi.set()
	var group = warningIconPi.group()

	var polygon = warningIconPi.polygon('30.551,29.544 1.252,29.544 14.994,3.245 ').stroke('#134A78').fill('none').stroke({ width: 2 }).attr({ 'stroke-linejoin': 'round'})
	var polygonFondo = warningIconPi.polygon('30.551,29.544 1.252,29.544 14.994,3.245 ').stroke('none').fill('#E4E6E8').stroke({ width: 0 })
	var exclamacionOne = warningIconPi.path('M15.518,22.7c0.681,0,1.099-0.474,1.123-1.058l0.354-8.645c0.025-0.584-0.43-1.057-1.014-1.057h-0.971c-0.584,0-1.027,0.472-0.988,1.056l0.404,8.647C14.424,22.284,15.095,22.7,15.518,22.7z').attr({fill:'#00497B'})
	var exclamacionTwo = warningIconPi.circle(1.262).attr({fill:'#00497B'})

	var trianguloWarning = warningIconPi.group().add(polygonFondo).add(polygon)
	var warningExclamacion =  warningIconPi.group().add(exclamacionOne).add(exclamacionTwo)
	var warningComplete = warningIconPi.group().add(trianguloWarning).add(warningExclamacion)

	warningExclamacion
		.scale (5,5)
	warningComplete
		.translate(20,15)

	function animacionWrning(){
		
		trianguloWarning
		 	.scale (1,1)
			.attr({opacity:'0'})
			.animate(1200, SVG.easing.elastic,2000)
			.attr({opacity:'1'})
			.scale (5,5)

		exclamacionTwo
			.scale(2.5,2.5)
			.translate(14,-24)
			.attr({opacity:'0'})
			.animate(1000, SVG.easing.bounce,2400)
			.translate(14,24)
			.attr({opacity:'1'})

		exclamacionOne
			.attr({opacity:'0'})
			.rotate(90, 10, 30)
			.animate(800, SVG.easing.swingTo, 3200)
			.attr({opacity:'1'})
			.rotate(90, 10, 00)

		warningComplete
			.attr({opacity:'1'})
			.animate(1000, SVG.easing.swingTo, 13000)
			.attr({opacity:'0'})	
	}

	animacionWrning();
	setInterval(function(){
		animacionWrning();
	},5500);
}

function deleteElem(){
	var icoTrash = SVG('ico-trash').size('100%','100%').viewbox(50, 10.468, 29.875, 30.032).addClass('trash')
	//PI-Trash
	var tapa = icoTrash.group().addClass('grupoTapa')
	var tarr = icoTrash.group().addClass('grupoTarr')
	var trashis = icoTrash.group().back()
	//Manga
	var manga1 = tapa.path('M59.495,15.308v-1.401c0-1.533,0.745-2.278,2.278-2.278h6.18c0.595,0,1.097,0.127,1.493,0.378c0.538,0.383,0.785,0.998,0.785,1.9v1.401H59.495z').addClass('coloGrey')
	var manga2 = tapa.path('M62.548,12.228c0.004,0,0.007,0.001,0.01,0.001h5.396c0.479,0,0.874,0.096,1.173,0.285c0.34,0.243,0.506,0.698,0.506,1.393v0.801h-9.537v-0.801c0-1.192,0.486-1.678,1.679-1.678h0.762c0.004,0,0.009,0,0.011-0.001C62.547,12.228,62.548,12.228,62.548,12.228 M62.548,11.028h-0.151l-0.005,0.001h-0.618c-1.856,0-2.879,1.022-2.879,2.878v0.801v1.2h1.2h9.537h1.2v-1.2v-0.801c0-1.094-0.34-1.891-1.009-2.369l-0.027-0.02L69.768,11.5c-0.494-0.312-1.104-0.471-1.814-0.471h-5.278l-0.003,0L62.548,11.028L62.548,11.028z').addClass('coloBlue-lines')
	var radio = tapa.line(52.738, 15.468, 76.988, 15.468).fill('none').stroke({color:'#134A78',width:1.2, linecap:'round',miterlimit:10})

	//Tarro
	var tarro = tarr.path('M56.711,39.479c-0.456,0-1.516-0.162-1.516-1.671V15.605h19.336V37.8c-0.035,1.464-0.965,1.68-1.516,1.68H56.711z').addClass('coloGrey')
	var tarro2 = tarr.path('M73.932,16.205V37.8c-0.017,0.675-0.248,1.08-0.916,1.08H56.711c-0.685,0-0.916-0.403-0.916-1.071V16.205H73.932 M75.132,15.005h-1.2H55.795h-1.2v1.2v21.604c0,1.675,1.093,2.271,2.116,2.271h16.305c0.996,0,2.075-0.592,2.115-2.251l0.001-21.624V15.005L75.132,15.005z').addClass('coloBlue-lines')
	var tarroSom = tarr.path('M57.268,36.542V16.205h-1.473v21.793c0,0.681,0.073,0.882,0.768,0.882h16.511c0.677,0,0.858-0.202,0.858-0.89v-0.551H58.184C57.489,37.439,57.268,37.225,57.268,36.542z').addClass('coloGrey-sombra')

	var lineTarr = tarr.line(60.363, 34.668, 60.363, 19.668).fill('none').stroke({color:'#134A78',width:1.2, linecap:'round',miterlimit:10})
	var lineTarr2 = tarr.line(69.363, 34.668, 69.363, 19.668).fill('none').stroke({color:'#134A78',width:1.2, linecap:'round',miterlimit:10})
	var lineTarr3 = tarr.line(64.863, 34.668, 64.863, 19.668).fill('none').stroke({color:'#134A78',width:1.2, linecap:'round',miterlimit:10})
	
	//Basurita
	var trashisMove = trashis.rect(6,6).cx(50).cy(5).addClass('coloGreen')

	function animaTrash(){
		tapa
			.rotate(0,76.988,15.468)
			.animate(300,'>')
			.rotate(45,76.988,15.468)
			.after(function(){
				tarr
					.rotate(0,150,50)
					.animate(600,SVG.easing.bounce,'.6s')
					.rotate(-2,150,50).after(function(){
						this
							.animate(300,'>')
							.rotate(-2,150,50);
						tapa
							.animate(300,'>')
							.rotate(45,76.988,15.468);
					});
			});

		trashisMove
			.opacity(0)
			.rotate(0,30,40)
			.animate(800,'<','.4s')
			.opacity(1)
			.rotate(35,100,30);
	}

	animaTrash();
	setInterval(function(){
		animaTrash();
	},2800);
}

function powerinfluencer(){
	var powerAnimationPI = SVG('icon-pi-animado').size(150,150).viewbox(0, 0,200, 200).addClass('socialNetwork-iconPI') 
	var set = powerAnimationPI.set()
	var group = powerAnimationPI.group()

	var gradient = powerAnimationPI.gradient('linear', function(stop) {
	  stop.at({ offset: 0, color: '#4afc97' })
	  stop.at({ offset: 1, color: '#128a76' })
	})
	var gradientFondo = powerAnimationPI.gradient('linear', function(stop) {
	  stop.at({ offset: 0, color: '#165975' })
	  stop.at({ offset: 1, color: '#1f9e75' })
	})

	var Forma3Front = powerAnimationPI.path('M23.438,2.31c-0.66-0.194-1.341-0.29-2.038-0.271c-0.763,0.02-1.5,0.176-2.203,0.446c0.718,0.233,1.407,0.584,2.058,1.041c3.153,2.211,6.259,5.933,6.283,12.302c0.025,6.489-2.404,11.486-5.623,12.617c-0.75,0.263-1.637,0.847-2.449,0.986c0.883,0.372,1.91,0.512,2.673,0.492c0.697-0.018,1.372-0.151,2.021-0.379c4.212-1.482,7.245-7.141,7.068-13.813C31.051,9.057,27.723,3.567,23.438,2.31z').fill({ color: gradient })
	var Forma3Back = powerAnimationPI.path('M16.37,16.123c-0.144-5.45,1.854-10.223,4.885-12.597c-0.651-0.456-1.34-0.808-2.058-1.041c-4.116,1.58-7.059,7.17-6.885,13.746c0.174,6.576,3.409,12.002,7.603,13.362c0.704-0.27,1.374-0.658,2-1.148C18.763,26.233,16.515,21.573,16.37,16.123z').fill({ color: gradientFondo })
	var Forma1Back = powerAnimationPI.path('M23.053,27.815c-0.574-0.1-4.016-0.677-5.521-0.958c-1.296-0.242-7.73-1.452-7.89-1.506c-1.261-0.36-1.501-0.567-1.904-1.733c-0.066-0.192-3.491-10.162-3.939-11.443c-0.007-0.02-0.012-0.04-0.019-0.06C3.371,10.9,3.519,9.815,4.29,8.825c-0.043,0.019-0.085,0.039-0.127,0.06c-0.82,0.915-1.638,1.831-2.46,2.745c-0.284,0.315-0.5,0.641-0.654,0.977c-0.369,0.805-0.374,1.673-0.043,2.621c0.008,0.024,0.017,0.049,0.025,0.073c0.191,0.546,3.344,9.787,3.747,10.954c0.12,0.346,0.273,0.657,0.458,0.931c0.345,0.511,0.806,0.894,1.389,1.134c0.576,0.207,12.537,2.42,12.683,2.448c0.791,0.15,1.496,0.065,2.123-0.234c0.051-0.024,0.532-0.305,0.672-0.461c0.556-0.621,2.081-2.603,2.038-2.555C23.918,27.616,23.627,27.915,23.053,27.815z').fill({ color: gradientFondo })
	var Forma2Back = powerAnimationPI.path('M23.553,28.976c-0.036-0.02-3.833-2.254-5.112-3.095c-1.102-0.724-6.568-4.327-6.695-4.438c-0.7-0.611-1.051-1.4-1.086-2.334c-0.005-0.146,0.707-10.722,0.789-12.076c0.001-0.021,0.004-0.041,0.005-0.062c0.093-1.28,0.602-2.197,1.695-2.811c-0.327,0.027-0.319,0.042-0.365,0.045c-1.265,0.503-3.765,1.912-4.037,2.162c-0.652,0.6-0.992,1.399-1.053,2.401C7.692,8.794,7.69,8.82,7.689,8.845c-0.035,0.577-0.78,12.262-0.715,12.587c0.121,0.605,0.398,1.136,0.843,1.583c0.105,0.106,10.628,7.077,10.751,7.159c0.671,0.444,1.355,0.638,2.048,0.604c0.057-0.003,0.709-0.11,0.901-0.192c1.603-0.678,2.896-1.597,2.937-1.625C24.397,28.99,23.98,29.212,23.553,28.976z').fill({ color: gradientFondo })
	var Forma1Front = powerAnimationPI.path('M18.485,10.802c-0.185-0.055-0.378-0.101-0.581-0.137C16.488,10.414,6.883,8.748,6.182,8.658c-1.555-0.2-2.087,0.199-2.177,0.301c-0.143,0.163-1.616,1.851-2.426,2.774c-0.28,0.319-0.483,0.764-0.633,1.102c0.533-0.862,1.655-0.806,2.571-0.663c0.048,0.007,10.947,1.87,11.723,2.007c1.511,0.268,2.547,1.059,3.065,2.603c1.167,3.478,2.396,6.936,3.681,10.372c0.025,0.068,0.047,0.135,0.069,0.202c0.023,0.068,0.043,0.136,0.063,0.203c0.012,0.041,0.023,0.082,0.034,0.122c0.187,0.722,0.273,1.369-0.006,2.02c-0.175,0.427-0.428,0.605-0.665,0.809c0.051-0.025,0.282-0.155,0.477-0.297c0.504-0.367,2.056-2.47,2.126-2.55c0.009-0.01,1.239-2.228,0.553-4.035c-1.302-3.429-2.507-6.888-3.673-10.366C20.513,11.924,19.683,11.159,18.485,10.802z').fill({ color: gradient })
	var Forma2Front = powerAnimationPI.path('M25.474,11.484c-0.15-0.122-9.916-6.362-10.519-6.733c-0.613-0.377-1.656-0.688-2.124-0.564c-0.149,0.04-2.243,1.012-3.31,1.621c-0.8,0.457-1.059,0.856-1.059,0.856c0.905-0.532,2.759,0.35,2.801,0.375c1.018,0.627,9.25,5.878,9.912,6.305c1.29,0.831,1.94,1.961,1.821,3.585c-0.268,3.658-0.474,7.323-0.614,10.989c-0.058,1.523-0.109,1.869-0.78,2.439c-0.193,0.167-0.598,0.325-0.919,0.413c0.057-0.003,0.327-0.043,0.555-0.109c0.28-0.081,0.631-0.151,0.918-0.29c0.603-0.292,1.99-1.185,2.001-1.192c1.418-0.926,1.975-1.693,2.033-3.49c0.119-3.666,0.35-7.322,0.618-10.98C26.911,13.303,26.441,12.277,25.474,11.484z').fill({ color: gradient })
	
	var IconLogotipoPower = powerAnimationPI.group().add(Forma3Back).add(Forma3Front).add(Forma2Back).add(Forma1Back).add(Forma1Front).add(Forma2Front)

	Forma1Front
		.attr({opacity:'1'})

	IconLogotipoPower
		.scale (5,5)
		.translate(10,45)
		.attr({opacity:'1'})
	
	Forma3Front
	 	.rotate(44, 22, 20)
	 	.translate(26,-9)

	 Forma3Back
	 	.rotate(44, 22, 20)
	 	.translate(26,-9)

	Forma2Front
	 	.rotate(24, 25, 10)
	 	.translate(13,-10) 

	 Forma2Back
	 	.rotate(24, 25, 10)
	 	.translate(13,-10)	 	 	
	
	Forma1Front
		.translate(-3,-1)
	 	.rotate(-6, 25, 30)	

	 Forma1Back
	 	.translate(-3,-1)
	 	.rotate(-6, 25, 30)		

	function animatePowerIcon() {

		IconLogotipoPower
			.attr({opacity:'1'})	
			.animate(600, '>', 13400)
			.attr({opacity:'0'})

		Forma3Front
	 		.rotate(44, 22, 30)	
	 		.attr({opacity:'0'})
	 		.animate(2500, SVG.easing.elastic ,2000)
	 		.rotate(40, 22, 30)	
	 		.attr({opacity:'1'}).after(function() {
		  		this.animate(600, '=',7500).rotate(10, 22, 30).attr({opacity:'0'})
		  	})

	 	Forma3Back
	 		.rotate(44, 22, 30)	
	 		.attr({opacity:'0'})
	 		.animate(2500, SVG.easing.elastic ,2000)
	 		.rotate(40, 22, 30)	
	 		.attr({opacity:'1'}).after(function() {
		  		this.animate(600, '=',7500).rotate(10, 22, 30).attr({opacity:'0'})
		  	})

		Forma2Front
	 		.rotate(24, 25, 30)
	 		.attr({opacity:'0'})
	 		.animate(3500, SVG.easing.elastic ,2400)
	 		.rotate(20, -10, 0)
	 		.attr({opacity:'1'}).after(function() {
		  		this.animate(600, '=',5800).rotate(0, 22, 30).attr({opacity:'0'})
		  	})

	 	Forma2Back
	 		.rotate(24, 25, 30)
	 		.attr({opacity:'0'})
	 		.animate(3500, SVG.easing.elastic ,2400)
	 		.rotate(20, -10, 0)	
	 		.attr({opacity:'1'}).after(function() {
		  		this.animate(600, '=',5800).rotate(0, 22, 30).attr({opacity:'0'})
		  	})

	 	Forma1Front
	 		.rotate(24, 25, 30)
	 		.attr({opacity:'0'})
	 		.animate(3500, SVG.easing.elastic ,2700)
	 		.rotate(20, -10, 0)
	 		.attr({opacity:'1'}).after(function() {
		  		this.animate(400, '=',5500).rotate(0, 22, 30).attr({opacity:'0'})
		  	})

	 	Forma1Back
	 		.rotate(24, 25, 30)
	 		.attr({opacity:'0'})
	 		.animate(3500, SVG.easing.elastic ,2700)
	 		.rotate(20, -10, 0)
	 		.attr({opacity:'1'}).after(function() {
		  		this.animate(400, '=',5500).rotate(0, 22, 30).attr({opacity:'0'})
		  	}) 
	}

	animatePowerIcon();
	setInterval(function(){
		animatePowerIcon();
	},14000);
}