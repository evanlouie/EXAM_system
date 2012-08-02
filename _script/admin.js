$(document).ready(function() {
	var exam_id;
	var section_id;
	var question_id;
	var answer_id;

	function reloadSectionList() {
		exam_id = $('#chosenExam option:selected').val();
		$('#includedSectionList').load('index.php?exam_id=' + exam_id + ' #includedSectionList', function() {
			// $('tr.entry').hover(function() {
			// $(this).find('img').first().show();
			// }, function() {
			// $(this).find('img').first().hide();
			// });
		});
	}

	function reloadCorrectAnswerList() {
		section_id = $("#sectionChosenForSectionQuestionAnswer option:selected").attr('value');
		question_id = $("#questionChosenForSectionQuestionAnswer option:selected").attr('value');
		$('#correctAnswerList').load('index.php?sectionQuestionAnswer=1&section_id=' + section_id + '&question_id=' + question_id + ' #correctAnswerList');
	}

	function reloadIncorrectAnswerList() {
		section_id = $("#sectionChosenForSectionQuestionIncorrectAnswer option:selected").attr('value');
		question_id = $("#questionChosenForSectionQuestionIncorrectAnswer option:selected").attr('value');
		$('#incorrectAnswerList').load('index.php?sectionQuestionIncorrectAnswer=1&section_id=' + section_id + '&question_id=' + question_id + ' #incorrectAnswerList');
	}

	function reloadQuestionList(exam_id, section_id) {
		$('#includedQuestionListContainer').load('index.php?exam_id=' + exam_id + '&section_id=' + section_id + ' #includedQuestionList', function() {
			// $('tr.entry').hover(function() {
			// $(this).find('img').first().show();
			// }, function() {
			// $(this).find('img').first().hide();
			// });
		});
	}

	function hideAllManagers() {
		if (!$('code#maker').is(':hidden')) {
			$('code#maker').slideToggle();
		}
		if (!$('code#examSectionManager').is(':hidden')) {
			$('code#examSectionManager').slideToggle();
		}
		if (!$('code#sectionQuestionManager').is(':hidden')) {
			$('code#sectionQuestionManager').slideToggle();
		};
		if (!$('code#sectionQuestionAnswerManager').is(':hidden')) {
			$('code#sectionQuestionAnswerManager').slideToggle();
		}
		if (!$('code#sectionQuestionIncorrectAnswerManager').is(':hidden')) {
			$('code#sectionQuestionIncorrectAnswerManager').slideToggle();
		}
	}

	function enableClickableHeaders() {
		$('h2#makerHeader').click(function() {
			if (!$('code#examSectionManager').is(':hidden')) {
				$('code#examSectionManager').slideToggle();
			}
			if (!$('code#sectionQuestionManager').is(':hidden')) {
				$('code#sectionQuestionManager').slideToggle();
			};
			if (!$('code#sectionQuestionAnswerManager').is(':hidden')) {
				$('code#sectionQuestionAnswerManager').slideToggle();
			}
			if (!$('code#sectionQuestionIncorrectAnswerManager').is(':hidden')) {
				$('code#sectionQuestionIncorrectAnswerManager').slideToggle();
			}
			$('code#maker').slideToggle();
		});
		$('h2#examSectionManagerHeader').on('click', function() {
			if (!$('code#maker').is(':hidden')) {
				$('code#maker').slideToggle();
			}
			if (!$('code#sectionQuestionManager').is(':hidden')) {
				$('code#sectionQuestionManager').slideToggle();
			};
			if (!$('code#sectionQuestionAnswerManager').is(':hidden')) {
				$('code#sectionQuestionAnswerManager').slideToggle();
			}
			if (!$('code#sectionQuestionIncorrectAnswerManager').is(':hidden')) {
				$('code#sectionQuestionIncorrectAnswerManager').slideToggle();
			}
			$('code#examSectionManager').slideToggle();
		});
		$('h2#sectionQuestionManagerHeader').on('click', function() {
			if (!$('code#maker').is(':hidden')) {
				$('code#maker').slideToggle();
			}
			if (!$('code#examSectionManager').is(':hidden')) {
				$('code#examSectionManager').slideToggle();
			}
			if (!$('code#sectionQuestionAnswerManager').is(':hidden')) {
				$('code#sectionQuestionAnswerManager').slideToggle();
			}
			if (!$('code#sectionQuestionIncorrectAnswerManager').is(':hidden')) {
				$('code#sectionQuestionIncorrectAnswerManager').slideToggle();
			}
			$('code#sectionQuestionManager').slideToggle();
		});
		$('h2#sectionQuestionAnswerManagerHeader').on('click', function() {
			if (!$('code#maker').is(':hidden')) {
				$('code#maker').slideToggle();
			}
			if (!$('code#examSectionManager').is(':hidden')) {
				$('code#examSectionManager').slideToggle();
			}
			if (!$('code#sectionQuestionManager').is(':hidden')) {
				$('code#sectionQuestionManager').slideToggle();
			};
			if (!$('code#sectionQuestionIncorrectAnswerManager').is(':hidden')) {
				$('code#sectionQuestionIncorrectAnswerManager').slideToggle();
			}
			$('code#sectionQuestionAnswerManager').slideToggle();
		});
		$('h2#sectionQuestionIncorrectAnswerManagerHeader').on('click', function() {
			if (!$('code#maker').is(':hidden')) {
				$('code#maker').slideToggle();
			}
			if (!$('code#examSectionManager').is(':hidden')) {
				$('code#examSectionManager').slideToggle();
			}
			if (!$('code#sectionQuestionManager').is(':hidden')) {
				$('code#sectionQuestionManager').slideToggle();
			};
			if (!$('code#sectionQuestionAnswerManager').is(':hidden')) {
				$('code#sectionQuestionAnswerManager').slideToggle();
			}
			$('code#sectionQuestionIncorrectAnswerManager').slideToggle();
		});
	}


	$('#loadSections').click(function() {
		reloadSectionList();
	});
	$('#chosenExam').change(function() {
		reloadSectionList();
	});
	$(document).on('click', '.excludedSection', function() {
		exam_id = $('#chosenExam option:selected').attr('value');
		section_id = $(this).attr('value');
		$.get("esmManager.php?create=1&exam_id=" + exam_id + "&section_id=" + section_id, function() {
			$('#includedSectionList').load('index.php?exam_id=' + exam_id + ' #includedSectionList');
		});
	});
	$(document).on('click', '.includedSection', function() {
		exam_id = $('#chosenExam option:selected').attr('value');
		section_id = $(this).attr('value');
		$.get("esmManager.php?delete=1&exam_id=" + exam_id + "&section_id=" + section_id, function() {
			$('#includedSectionList').load('index.php?exam_id=' + exam_id + ' #includedSectionList');
		});
	});
	$('#loadCorrectAnswers').click(function() {
		reloadCorrectAnswerList();
	});
	$(document).on('change', '#sectionChosenForSectionQuestionAnswer', function() {
		reloadCorrectAnswerList();
	});
	$(document).on('change', '#questionChosenForSectionQuestionAnswer', function() {
		reloadCorrectAnswerList();
	});
	$(document).on('click', '.incorrectAnswer', function() {
		answer_id = $(this).attr('value');
		$.get("sqamManager.php?edit=1&section_id=" + section_id + "&question_id=" + question_id + "&answer_id=" + answer_id + "&status=1", function() {
			$('#correctAnswerList').load('index.php?sectionQuestionAnswer=1&section_id=' + section_id + '&question_id=' + question_id + ' #correctAnswerList');
		});
	});

	$(document).on('change', '#sectionChosenForSectionQuestionIncorrectAnswer', function() {
		reloadIncorrectAnswerList();
	})
	$(document).on('change', '#questionChosenForSectionQuestionIncorrectAnswer', function() {
		reloadIncorrectAnswerList();
	})
	$('#loadIncorrectAnswers').click(function() {
		reloadIncorrectAnswerList();
	});
	$(document).on('click', 'td.includedIncorrectAnswerCell', function() {
		answer_id = $(this).attr('value');
		$.get('qamManager.php?delete=1&section_id=' + section_id + '&question_id=' + question_id + '&answer_id=' + answer_id, function() {
			$('#incorrectAnswerList').load('index.php?sectionQuestionIncorrectAnswer=1&section_id=' + section_id + '&question_id=' + question_id + ' #incorrectAnswerList');
		});
	});
	$(document).on('click', 'input[type="radio"].includedIncorrectAnswer', function() {
		answer_id = $(this).attr('value');
		$.get("sqamManager.php?edit=1&section_id=" + section_id + "&question_id=" + question_id + "&answer_id=" + answer_id + "&status=1", function() {
			$('#correctAnswerList').load('index.php?sectionQuestionAnswer=1&section_id=' + section_id + '&question_id=' + question_id + ' #correctAnswerList');
		});
	});

	$(document).on('click', '.excludedIncorrectAnswer', function() {
		answer_id = $(this).attr('value');
		$.get('qamManager.php?create=1&section_id=' + section_id + '&question_id=' + question_id + '&answer_id=' + answer_id, function() {
			$('#incorrectAnswerList').load('index.php?sectionQuestionIncorrectAnswer=1&section_id=' + section_id + '&question_id=' + question_id + ' #incorrectAnswerList');
		});
	});
	$('#createExam').click(function() {
		var examTitle = $('#newExam').attr('value');
		$.get('examManager.php?create=1&title=' + examTitle);
	});
	$('#createSection').click(function() {
		var sectionTitle = $('#newSection').attr('value');
		$.get('sectionManager.php?create=1&status=1&title=' + sectionTitle);
	});
	$('#createQuestion').click(function() {
		var questionText = $('#newQuestion').attr('value');
		$.get("questionManager.php?create=1&question=" + questionText);
	});
	$('#createAnswer').click(function() {
		var answerText = $('#newAnswer').attr('value');
		$.get('answerManager.php?create=1&answer=' + answerText);
	});
	$(document).on('change', '#chosenExamToEdit', function() {
		exam_id = $('#chosenExamToEdit option:selected').attr('value');
		$('#chosenSectionToEditContainer').load('index.php?exam_id=' + exam_id + ' #chosenSectionToEdit', function() {
			section_id = $('#chosenSectionToEdit option:selected').attr('value');
			reloadQuestionList(exam_id, section_id);
		});
	});
	$(document).on('change', '#chosenSectionToEdit', function() {
		exam_id = $('#chosenExamToEdit option:selected').attr('value');
		section_id = $('#chosenSectionToEdit option:selected').attr('value');
		reloadQuestionList(exam_id, section_id);

	});
	$('#loadQuestions').click(function() {
		exam_id = $('#chosenExamToEdit option:selected').attr('value');
		section_id = $('#chosenSectionToEdit option:selected').attr('value');
		reloadQuestionList(exam_id, section_id);
	});
	$(document).on('click', '.includedQuestion', function() {
		question_id = $(this).attr('value');
		exam_id = $('#chosenExamToEdit option:selected').attr('value');
		section_id = $('#chosenSectionToEdit option:selected').attr('value');
		$.get('sqamManager.php?delete=1&section_id=' + section_id + '&question_id=' + question_id + '&answer_id=1&status=1');
		$.get('esqamManager.php?delete=1&section_id=' + section_id + '&exam_id=' + exam_id + '&question_id=' + question_id);
		$('#includedQuestionListContainer').load('index.php?exam_id=' + exam_id + '&section_id=' + section_id + ' #includedQuestionList');
	});
	$(document).on('click', '.excludedQuestion', function() {
		question_id = $(this).attr('value');
		exam_id = $('#chosenExamToEdit option:selected').attr('value');
		section_id = $('#chosenSectionToEdit option:selected').attr('value');
		$.get('sqamManager.php?create=1&section_id=' + section_id + '&question_id=' + question_id + '&answer_id=1&status=1');
		$.get('esqamManager.php?create=1&section_id=' + section_id + '&exam_id=' + exam_id + '&question_id=' + question_id);
		$('#includedQuestionListContainer').load('index.php?exam_id=' + exam_id + '&section_id=' + section_id + ' #includedQuestionList');
	});

	$('code#maker').hide();
	$('code#examSectionManager').hide();
	$('code#sectionQuestionManager').hide();
	$('code#sectionQuestionAnswerManager').hide();
	$('code#sectionQuestionIncorrectAnswerManager').hide();

	$(document).on('click', 'img.editExamButton', function() {
		section_id = $(this).closest('tr').find('.includedSection').attr('value');
		exam_id = $('#chosenExam').attr('value');
		reloadQuestionList(exam_id, section_id);
		$('#chosenExamToEdit').val(exam_id);
		$('#chosenSectionToEditContainer').load('index.php?exam_id=' + exam_id + ' #chosenSectionToEdit', function() {
			$('#chosenSectionToEdit').val(section_id);
			$('#chosenSectionToEdit').attr('disabled', true);
			$('#chosenExamToEdit').attr('disabled', true);
			$('#loadQuestions').attr('disabled', true);
			$('#sectionQuestionManager').appendTo('#lightboxContent');
			$('#sectionQuestionManager').show();
			$('h2#lightboxHeader').text('Section Manager');
			$("#lightbox, #lightbox-panel").fadeIn(300);
		});
	});

	$(document).on('click', 'img.editEntryButton', function() {
		value = $(this).closest('tr').children().last().attr('value');
		className = $(this).closest('tr').children().last().attr('class');
		currentName = $(this).closest('tr').children().last().text();
		$(this).closest('tr').children().last().replaceWith('<td class="temp" oldclass="' + className + '" value="' + value + '">' + '<input type="text" class="newValue" value="' + currentName + '" size="45">' + '<button class="editText">Edit</button></td>')
	});

	$(document).on('click', 'button.editText', function() {
		text = $(this).closest('td').find('.newValue').val();
		oldclass = $(this).closest('td').attr('oldclass');

		if (oldclass == "includedSection" || oldclass == 'excludedSection') {
			section_id = $(this).closest('td').attr('value');
			$.get('sectionManager.php?edit&section_id=' + section_id + '&title=' + text + '&status=1', function() {
				reloadSectionList();
			});
		}
		if (oldclass == 'includedQuestion' || oldclass == 'excludedQuestion') {
			$.get('questionManager.php?edit&question_id=' + $(this).closest('td').attr('value') + '&question=' + text, function() {
				exam_id = $('#chosenExamToEdit option:selected').attr('value');
				section_id = $('#chosenSectionToEdit option:selected').attr('value');
				reloadQuestionList(exam_id, section_id);
			})
		}
		if (oldclass == 'includedIncorrectAnswerCell' || oldclass == 'excludedIncorrectAnswer') {
			$.get('answerManager.php?edit&answer_id=' + $(this).closest('td').attr('value') + '&answer=' + text, function() {
				reloadIncorrectAnswerList();

			});
		};
	});

	$(document).on('click', 'img.editSectionButton', function() {
		exam_id = $('#chosenExamToEdit').attr('value');
		section_id = $('#chosenSectionToEdit').attr('value');
		question_id = $(this).closest('tr').find('.includedQuestion').attr('value');
		$('#questionChosenForSectionQuestionIncorrectAnswer').val(question_id);
		$('#sectionChosenForSectionQuestionIncorrectAnswer').val(section_id);
		$('#incorrectAnswerList').load('index.php?sectionQuestionIncorrectAnswer=1&section_id=' + section_id + '&question_id=' + question_id + ' #incorrectAnswerList', function() {
			$('#sectionChosenForSectionQuestionIncorrectAnswer').attr('disabled', true);
			$('#questionChosenForSectionQuestionIncorrectAnswer').attr('disabled', true);
			$('#loadIncorrectAnswers').attr('disabled', true);
			//			$('#sectionQuestionManager').appendTo('#sectionQuestionManagerContainer');
			//			$('#sectionQuestionManager').hide();
			$('#sectionQuestionIncorrectAnswerManager').appendTo('#lightboxContent');
			$('#sectionQuestionIncorrectAnswerManager').show();
			$('h2#lightboxHeader').text('Question Manager');
			$('#lightbox, #lightbox-panel').fadeIn(300);
		});
	});

	$("a#show-panel").click(function() {
		$("#lightbox, #lightbox-panel").fadeIn(300);
	});
	$("a#close-panel").click(function() {
		$("#lightbox, #lightbox-panel").fadeOut(300);
		$('#sectionQuestionManager').appendTo('#sectionManager');
		$('#sectionQuestionManager').hide();
		$('#chosenSectionToEdit').attr('disabled', false);
		$('#chosenExamToEdit').attr('disabled', false);
		$('#loadQuestions').attr('disabled', false);

		$('#sectionQuestionIncorrectAnswerManager').hide();
		$('#sectionQuestionIncorrectAnswerManager').appendTo('#questionManager');
		$('#sectionChosenForSectionQuestionIncorrectAnswer').attr('disabled', false);
		$('#questionChosenForSectionQuestionIncorrectAnswer').attr('disabled', false);
		$('#loadIncorrectAnswers').attr('disabled', false);
	});
	enableClickableHeaders();
});
