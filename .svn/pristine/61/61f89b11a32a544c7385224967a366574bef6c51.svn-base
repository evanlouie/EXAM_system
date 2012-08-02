function isCorrect(section_id, question_id) {
	$('#' + section_id).find('form.question#' + question_id).closest('code').css("background-color", "#DADADA");
}

function isIncorrect(section_id, question_id) {
	$('#' + section_id).find('form.question#' + question_id).closest('code').css("background-color", "#DADADA");
}

function checkAnswer(exam_id, section_id, question_id, answer_id) {

	var answer = $('answer').text();
	if (answer == 'correct') {
		isCorrect(section_id, question_id);
	} else {
		isIncorrect(section_id, question_id);
	}

}

function answerQuestion(count, size, firstQuestion) {
	if (count > size) {
		//alert(exam_id);

	} else {

		var attempt_id = $('#attempt_id').text();
		var form = $(firstQuestion).find('form');
		var exam_id = $('hidden').attr('examid');
		var section_id = $(firstQuestion).closest('.section').attr('id');
		var question_id = $(form).attr('id');
		var question_text = $(form).find('.questionText').text();
		var answer_id = $('#' + section_id).find('form.question#' + question_id).find('input:checked').val();
		$('#' + section_id).find('form.question#' + question_id).closest('code').css('background-color', '#DADADA');
		if (answer_id != undefined) {
			$('#' + section_id).find('#' + question_id).closest('code.question').find('.answer').load('checkAnswer.php?checkAnswer&exam_id=' + exam_id + '&section_id=' + section_id + '&question_id=' + question_id + '&answer_id=' + answer_id, function() {
				var status = $('#' + section_id).find('#' + question_id).closest('code.question').find('.answer').text();
				$.get('_callbacks/asqam.php?create&attempt_id=' + attempt_id + '&section_id=' + section_id + '&question_id=' + question_id + '&answer_id=' + answer_id);
			});
		} else {
			$.get('_callbacks/asqam.php?create&attempt_id=' + attempt_id + '&section_id=' + section_id + '&question_id=' + question_id);
		}
		answerQuestion(++count, size, $(firstQuestion).next());
	}
}


$(document).ready(function() {
	$('button').click(function() {
		var input = this;
		input.disabled = true;
	});
	$('.answerButton').click(function() {
		size = $(this).closest('.section').find('code.question').first().nextUntil('button').length;
		firstQuestion = $(this).closest('.section').find('.question').first();
		answerQuestion(0, size, firstQuestion);
		$(this).closest('.section').find(':radio').attr('disabled', true);
	});
	$('#submitExam').click(function() {
		var attempt_id = $('#attempt_id').text();
		var exam_id = $('hidden').attr('examid');
		$.get('_callbacks/exam.php?enable&attempt_id=' + attempt_id);
		var count = 0;
		var length = $('code.question').length;
		while (count < length) {
			var question = $('code.question')[count];
			var answer = $(question).find('.answer').text();
			if (answer == 'correct') {
				$(question).css("background-color", "#B7F5B7");
			} else {
				$(question).css("background-color", "#F8A7A7");
			}
			count++;
		}
		$.get('_callbacks/attempt.php?attempt_id=' + attempt_id + '&outOf=' + length);
		$.get('_callbacks/aemManager.php?create&attempt_id=' + attempt_id + '&exam_id=' + exam_id);
		var questionList = $('code.question');
	});
});