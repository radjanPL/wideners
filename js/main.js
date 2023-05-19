window.onload = function(){

	const toTopButton = document.getElementById('scrollup');
	const readAlsoWidget = document.getElementById('read-also');

	hamburgerMenuToggle();
	takeMeToTheTop();
	showTakeMeToTheTop();

	if (document.body.contains(readAlsoWidget)) { 
		readAlso(); 
	}

	function hamburgerMenuToggle() {

		const mainMenu = document.querySelector('.navbar__menu');
		const hamburgerMenu = document.querySelector('.navbar__hamburger');

		hamburgerMenu.addEventListener('click', function(e){
			e.preventDefault();

			if (hamburgerMenu.classList.contains('open')) {
				hamburgerMenu.classList.remove('open');
				mainMenu.classList.remove('visible');
			} else {
				hamburgerMenu.classList.add('open');
				mainMenu.classList.add('visible');
			}
		})
	}


	function takeMeToTheTop() {

		toTopButton.addEventListener('click', (e) => {
			e.preventDefault();

			scrollToSmoothly(0, 100);
		})

	}

	function scrollToSmoothly(pos, time) {

		var currentPos = window.pageYOffset;
		var start = null;
		if(time == null) time = 500;
		pos = +pos, time = +time;
		window.requestAnimationFrame(function step(currentTime) {
			start = !start ? currentTime : start;
			var progress = currentTime - start;
			if (currentPos < pos) {
				window.scrollTo(0, ((pos - currentPos) * progress / time) + currentPos);
			} else {
				window.scrollTo(0, currentPos - ((currentPos - pos) * progress / time));
			}
			if (progress < time) {
				window.requestAnimationFrame(step);
			} else {
				window.scrollTo(0, pos);
			}
		});
	}


	function showTakeMeToTheTop() {

		let scrollpos = window.scrollY;
		const header = document.getElementById('top');
		const header_height = header.offsetHeight;

		const add_class_on_scroll = () => toTopButton.classList.add('shown');
		const remove_class_on_scroll = () => toTopButton.classList.remove('shown');

		window.addEventListener('scroll', function() { 
			scrollpos = window.scrollY;

			if (scrollpos >= header_height) { add_class_on_scroll() }
			else { remove_class_on_scroll() }

		  });
	}

	function readAlso() {

		const closeButton = document.querySelector('#read-also .close');
		const footer = document.querySelector('.footer');
		const showReadAlsoWidget = () => readAlsoWidget.classList.add('shown');

		const onceShowReadAlsoWidget = () => {

			if(onceShowReadAlsoWidget.done) return;
			showReadAlsoWidget();
			onceShowReadAlsoWidget.done = true;
		};


		function elementInView(element)	{

			let contentViewTop = window.scrollY;
			let windowHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
			let contentViewBottom = contentViewTop + windowHeight;			
			let scrolltop = element.offsetTop;
			let elementBottom = scrolltop + element.offsetHeight;

			return ((elementBottom <= contentViewBottom) && (scrolltop >= contentViewTop));
		}

		window.addEventListener('scroll', () => {
			if (elementInView(footer)) {
				onceShowReadAlsoWidget();
			}
		})

		closeButton.addEventListener('click', (e) => {
			e.preventDefault();
			readAlsoWidget.remove();
		})
	}
}