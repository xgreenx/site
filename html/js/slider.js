$(document).ready(function() {
	var slides = $(".slider .slides").children(".slide"); // Получаем массив всех слайдов
		var width = $(".slider .slides").width(); // Получаем ширину видимой области
		var i = slides.length; // Получаем количество слайдов
		var offset = i * width; // Задаем начальное смещение и ширину всех слайдов
		i--; // уменьшаем кол-во слайдов на один ( для проверки в будущем )
	
		$(".slider .slides").css('width',offset); // Задаем блоку со слайдами ширину всех слайдов
		
		offset = 0; // Обнуляем смещение, так как показывается начала 1 слайд
		$(".slider .next").click(function(){
				// Событие клика на кнопку "следующий слайд"
			if (offset < width * i) {	// Проверяем, дошли ли мы до конца
				offset += width; // Увеличиваем смещение до следующего слайда
				$(".slider .slides").css("transform","translate3d(-"+offset+"px, 0px, 0px)"); // Смещаем блок со слайдами к следующему
				if(offset >= width * i) 
					offset = -width;
			}
		});
	
	
		$(".slider .prev").click(function(){	// Событие клика на кнопку "предыдущий слайд"
			if (offset > 0) { // Проверяем, дошли ли мы до конца
				offset -= width; // Уменьшаем смещение до предыдущего слайда
				$(".slider .slides").css("transform","translate3d(-"+offset+"px, 0px, 0px)"); // Смещаем блок со слайдами к предыдущему
			}
		});
});
